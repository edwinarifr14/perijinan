<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;
use App\Models\Pelanggan;
use App\Models\Kemasan;
use GuzzleHttp\Client;
use App\Models\Produk;
use App\Province;
use App\City;
use Illuminate\Support\Facades\DB;

class PelangganController extends Controller {

    public function profilPage(Request $req) {
        $user = Pelanggan::find($req->session()->get('login')['id']);
        $province = Province::all();
        $city = City::select('name','id')->where('id_province',$user->pelanggan_province)->get();
        return view('app.userprofile', compact('user', 'province','city'));
    }

    public function city(Request $request)
    {
      $city = City::select('name','id')->where('id_province',$request->id)->get();
      return response()->json($city);
    }

    public function saldoPage(Request $req) {
      $loginSession = $req->session()->get('login');
      $pelangganId = $loginSession['id'];
      $pelanggan = Pelanggan::find($req->session()->get('login')['id']);

      $transaksi = Transaksi::where('transaksi_pelanggan',$pelangganId)->where('transaksi_deskripsi','top up')->
      where(function ($query) {
      $query->where('transaksi_bayar','Belum Dibayar')->orWhere('transaksi_bayar','Tidak Valid');
    })->first();

      if($transaksi){
        return view('app.confTopUp',['transaksi' => $transaksi,'user' => $pelanggan]);
      }else{

        return view('app.usersaldo', [
            'user' => $pelanggan
        ]);
      }


    }

    public function register(Request $req) {

      $messages = [
        'alpha' => 'Hanya huruf pada kolom nama',
    'min' => 'Kontak harus diisi minimal 10 dan maximal 13',
    'max' => 'Kontak harus diisi minimal 10 dan maximal 13',
    'required' => 'Tabel :attribute wajib diisi',
    'email' => 'Isi dengan alamat email yang benar'
];
      $this->validate($req,[
        'nama' => 'alpha|required',
           'kontak' => 'required|min:10|max:13',
           'email' => 'required|email',
           'password' => 'required',
           'provinsi' => 'required',
           'kota' => 'required',
           'alamat' => 'required'
        ],$messages);
        try {
            $pelanggan = new Pelanggan();
            $pelanggan->pelanggan_email = trim($req->email);
            $pelanggan->pelanggan_password = Hash::make($req->password);
            $pelanggan->pelanggan_nama = trim($req->nama);
            $pelanggan->pelanggan_kontak = trim($req->kontak);
            $pelanggan->pelanggan_alamat = trim($req->alamat);
            $pelanggan->pelanggan_city = trim($req->kota);
            $pelanggan->pelanggan_province = trim($req->provinsi);
            $pelanggan->save();
            $req->session()->flash('msg', [
                'success' => true,
                'msg' => 'Register Berhasil, Silahkan Login dengan akun anda!'
            ]);
            return redirect('/login');
        } catch (QueryException $ex) {
            if ((int) $ex->getCode() === 23000) {
                $req->session()->flash('msg', [
                    'success' => false,
                    'msg' => "Email '{$req->email}' sudah digunakan!"
                ]);
            } else throw new Exception($ex->getMessage());
        } catch (Exception $ex) {
            $req->session()->flash('msg', [
                'success' => false,
                'msg' => "Register Gagal, {$ex->getMessage()}"
            ]);
        }
        return redirect('/register');
    }


    public function buangProdukDariKeranjang(Request $req, $keranjang_id) {
        try {
          $a=Keranjang::find($keranjang_id);
          Keranjang::find($keranjang_id)->delete();
            // Keranjang::destroy($id);
            $req->session()->flash('msg', [
                'success' => true,
                'msg' => 'Berhasil menghapus produk dari keranjang'


            ]);
        } catch (Exception $ex) {
            $req->session()->flash('msg', [
                'success' => false,
                'msg' => 'Terjadi error.. Gagal menghapus produk dari keranjang'
            ]);
        }
        return redirect()->back();
    }

    public function simpanProdukKeKeranjang(Request $req, $id) {
        try {
            $loginSession = $req->session()->get('login');
            $pelangganId = $loginSession['id'];
            $p = Produk::find($id);
            $checkProduk = Keranjang::where('keranjang_pelanggan',$pelangganId)->where('keranjang_produk',$id)->first();
            // jika sudah ada produk ini dalam keranjang,
            // maka update keranjang_jumlah berdasarkan $req->keranjang_jumlah

            if ($p->pemilik === $pelangganId) {
              $req->session()->flash('msg', [
                  'success' => false,
                  'msg' => 'Tidak dapat memasukkan produk milik sendiri ke dalam keranjang'
              ]);
            }elseif($checkProduk) {
                if ($p->produk_stok === $checkProduk->keranjang_jumlah) {
                    $req->session()->flash('msg', [
                        'success' => false,
                        'msg' => 'Keranjang tidak dapat menampung produk ini lagi'
                    ]);
                }elseif($p->produk_stok < ($checkProduk->keranjang_jumlah + $req->keranjang_jumlah)) {
                  $jml = ($p->produk_stok - $checkProduk->keranjang_jumlah);
                  $checkProduk->keranjang_jumlah += $jml;
                  $checkProduk->save();
                  $req->session()->flash('msg', [
                      'success' => true,
                      'msg' => 'Keranjang tidak dapat menampung sesuai permintaan. Stok tidak mencukupi'
                  ]);
                }else {
                  $checkProduk->keranjang_jumlah += $req->keranjang_jumlah;
                  $checkProduk->save();
                  $req->session()->flash('msg', [
                      'success' => true,
                      'msg' => 'Berhasil menambahkan produk ke keranjang'
                  ]);
                }

            } else {
                $k = new Keranjang();
                $k->keranjang_produk = $id;
                $k->keranjang_pelanggan = $pelangganId;
                $k->keranjang_jumlah = $req->keranjang_jumlah;
                $k->save();
                $req->session()->flash('msg', [
                    'success' => true,
                    'msg' => 'Berhasil menambahkan produk ke keranjang'
                ]);
            }

        }catch(Exception $ex) {
            $req->session()->flash('msg', [
                'success' => false,
                'msg' => 'Terjadi error.. Gagal menambahkan produk ke keranjang'
            ]);
        }

        return redirect()->back();

    }

    public function keranjang(Request $req){
        $loginSession = $req->session()->get('login');
        $pelangganId = $loginSession['id'];
        $keranjang = DB::table('keranjang')
        ->join('produk', 'produk.produk_id', '=', 'keranjang_produk')
        ->where('keranjang.keranjang_pelanggan', '=', $pelangganId)
        ->select('keranjang.keranjang_jumlah','produk.produk_stok','keranjang.keranjang_id')
        ->get();

        for ($i=0; $i < count($keranjang) ; $i++) {
          if ($keranjang[$i]->produk_stok < $keranjang[$i]->keranjang_jumlah) {
            try {
              $affected = DB::table('keranjang')
                  ->where('keranjang_id', $keranjang[$i]->keranjang_id)
                  ->update(['keranjang_jumlah' => $keranjang[$i]->produk_stok]);
              $req->session()->flash('msg', [
                  'success' => true,
                  'msg' => 'Sebagian jumlah produk disesuaikan dengan produk stok. Stok tidak mencukupi'
              ]);
            } catch (Exception $ex) {
              $req->session()->flash('msg', [
                  'success' => false,
                  'msg' => 'Terjadi error..'
              ]);
            }
          }
        }





        // if ($keranjang->produk_stok < $keranjang->keranjang_jumlah) {
        //
        //
        // }

        if ($loginSession['pelanggan']) {
            $totalProduk = 0; $totalHarga = 0;
            $pelangganId = $loginSession['id'];
            $productsInCart = Keranjang::productInCarts($pelangganId);
            foreach ($productsInCart->toArray() as $p) {
                $totalHarga += $p->produk_harga * $p->keranjang_jumlah;
                $totalProduk++;
            }
            return \view("app.cart",[
                'produk' => sizeof($productsInCart) > 0 ? $productsInCart : false,
                'totalharga' => $totalHarga,
                'totalproduk' => $totalProduk
            ]);
        }
        return redirect('/login');
    }

    public function deleteAccountPage(Request $req) {
        return view('app.deleteaccount');
    }

    private function loginSession(Request $req, $dataPelanggan){
        $req->session()->put('login',[
            'pelanggan' => true,
            'id' => $dataPelanggan->pelanggan_id,
            'nama' => $dataPelanggan->pelanggan_nama,
            'email' => $dataPelanggan->pelanggan_email
        ]);
    }

    public function update(Request $req, $id){
      $messages = [
        'alpha' => 'Hanya huruf pada kolom nama',
    'min' => 'Kontak harus diisi minimal 10 dan maximal 13',
    'max' => 'Kontak harus diisi minimal 10 dan maximal 13',
    'required' => 'Tabel :attribute wajib diisi',
    'email' => 'Isi dengan alamat email yang benar'
];
      $this->validate($req,[
        'nama' => 'alpha|required',
           'kontak' => 'required|min:10|max:13',
           'email' => 'required|email',
           'provinsi' => 'required',
           'kota' => 'required',
           'alamat' => 'required'
        ],$messages);
        try {
            $pelanggan = Pelanggan::find($id);
            $pelanggan->pelanggan_nama = trim($req->nama);
            $pelanggan->pelanggan_kontak = trim($req->kontak);
            $pelanggan->pelanggan_alamat = trim($req->alamat);
            $pelanggan->pelanggan_email = trim($req->email);
            $pelanggan->pelanggan_city = trim($req->kota);
            $pelanggan->pelanggan_province = trim($req->provinsi);

            if ($req->password)
                $pelanggan->pelanggan_password = Hash::make($req->password);

            $pelanggan->save();

            $req->session()->flash('msg', [
                'success' => true,
                'msg' => $req->fromadmin ? 'Update data Pelanggan berhasil!' : 'Update profil berhasil!'
            ]);

        } catch (QueryException $ex) {
            if ((int) $ex->getCode() === 23000) {
                $req->session()->flash('msg', [
                    'success' => false,
                    'msg' => "Email '{$req->email}' sudah digunakan!"
                ]);
            } else throw new Exception($ex->getMessage());
        } catch(Exception $ex){
            $req->session()->flash('msg', [
                'success' => false,
                'msg' => $req->fromadmin ? "Terjadi kesalahan, update data pelanggan gagal, {$ex->getMessage()}" : 'Terjadi kesalahan, Update profil gagal!'
            ]);
        }

        return redirect()->back();
    }

    public function delete(Request $req, $id){
        try {
          DB::table('transaksi')->where('transaksi_pelanggan',$id)
          ->where(function ($query) {
          $query->where('transaksi_bayar','Belum Dibayar');})->delete();
            Pelanggan::find($id)->delete();
            DB::table('keranjang')->where('keranjang_pelanggan',$id)->delete();


            if (!$req->fromadmin) {
                $req->session()->flush();
                $req->session()->flash('msg',[
                    'success' => true,
                    'msg' => 'Hapus akun berhasil'
                ]);
                return redirect('/login');
            } else {
                $req->session()->flash('msg',[
                    'success' => true,
                    'msg' => 'Delete Pelanggan berhasil'
                ]);
            }
        } catch (Exception $ex) {
            $req->session()->flash('msg',[
                'success' => false,
                'msg' => $req->fromadmin ? "Terjadi error, delete Pelanggan Gagal: {$ex->getMessage()}" : 'Terjadi kesalahan, Hapus akun gagal!'
            ]);
        }
        return redirect()->back();
    }

    public function auth(Request $req) {
    //   $messages = [
    //     'required' => 'Tabel :attribute wajib diisi',
    //     'email' => 'Mohon isi dengan email yang valid'
    // ];
    //
    //     $this->validate($req, [
    //         'email' => 'required|email',
    //         'nama' => 'required'
    //     ],$messages);
        try{
            $dataPelanggan = Pelanggan::check($req->email);
            if($dataPelanggan && Hash::check($req->password , $dataPelanggan->pelanggan_password)) {
                $this->loginSession($req , $dataPelanggan);
                return redirect('/');
            }
            throw new Exception("Password atau Username salah");
        }catch(Exception $ex){
            $req->session()->flash('msg',[
                'success'=>false,
                'msg'=>$ex->getMessage()
            ]);
            return redirect('/login');
        }
    }

    public function ongkirPage(Request $req) {
      $loginSession = $req->session()->get('login');
      $pelangganId = $loginSession['id'];
    // $keranjang = Keranjang::where('keranjang_pelanggan',$pelangganId)->get();
    $alamat = trim($req->alamatpengiriman);
    $kota = trim($req->kota);
    $provinsi = trim($req->provinsi);

    $kota1 = City::select('name')->where('id',$kota)->first();
    $provinsi1 = Province::select('name')->where('id',$provinsi)->first();

    $produk = DB::table('keranjang')
    ->join('produk', 'produk.produk_id', '=', 'keranjang.keranjang_produk')
    ->join('kemasan', 'kemasan.kemasan_id', '=', 'produk.produk_kemasan')
    ->where('keranjang.keranjang_pelanggan', '=', $pelangganId)
    ->get();

    $alamatpenjual = DB::table('keranjang')
    ->join('produk', 'produk.produk_id', '=', 'keranjang.keranjang_produk')
    ->join('pelanggan', 'pelanggan.pelanggan_id', '=', 'produk.pemilik')
    ->join('city', 'city.id', '=', 'pelanggan.pelanggan_city')
    ->join('province', 'province.id', '=', 'city.id_province')
    ->where('keranjang.keranjang_pelanggan', '=', $pelangganId)
    ->select('city.name as city','province.name as province','pelanggan.pelanggan_alamat')
    ->get();


    $origin = DB::table('keranjang')
    ->join('produk', 'produk.produk_id', '=', 'keranjang.keranjang_produk')
    ->join('pelanggan', 'pelanggan.pelanggan_id', '=', 'produk.pemilik')
    ->join('city', 'city.id', '=', 'pelanggan.pelanggan_city')
    ->where('keranjang.keranjang_pelanggan', '=', $pelangganId)
    ->select('city.id')
    ->get();

    $weight = DB::table('keranjang')
    ->join('produk', 'produk.produk_id', '=', 'keranjang.keranjang_produk')
    ->join('kemasan', 'kemasan.kemasan_id', '=', 'produk.produk_kemasan')
    ->where('keranjang.keranjang_pelanggan', '=', $pelangganId)
    ->selectRaw('kemasan.kemasan_gram * keranjang_jumlah as berat')
    ->get();

    $harga = DB::table('keranjang')
    ->join('produk', 'produk.produk_id', '=', 'keranjang.keranjang_produk')
    ->where('keranjang.keranjang_pelanggan', '=', $pelangganId)
    ->select('keranjang.keranjang_jumlah', 'produk.produk_harga')
    ->get();


    for ($i=0; $i < count($harga) ; $i++) {
      $totalHarga[] = $harga[$i]->keranjang_jumlah * $harga[$i]->produk_harga;
    }

    $total = array_sum($totalHarga);




    $client = new Client();



    for($i = 0; $i < count($weight); $i++){




    try{
      $response = $client->request('POST','https://api.rajaongkir.com/starter/cost',
        [
          'body' => 'origin='.$origin[$i]->id.'&destination='.trim($req->kota).'&weight='.$weight[$i]->berat.'&courier=jne',
          'headers' => [
            'key' => '01b297c03ed339ba85c02f251227179c',
            'content-type' => 'application/x-www-form-urlencoded',
          ]
        ]
      );
    }catch(RequestException $e){
      var_dump($e->getResponse()->getBody()->getContents());
    }
    $json = $response->getBody()->getContents();
    $jne[] = json_decode($json, true);







    try{
      $response = $client->request('POST','https://api.rajaongkir.com/starter/cost',
        [
          'body' => 'origin='.$origin[$i]->id.'&destination='.trim($req->kota).'&weight='.$weight[$i]->berat.'&courier=pos',
          'headers' => [
            'key' => '01b297c03ed339ba85c02f251227179c',
            'content-type' => 'application/x-www-form-urlencoded',
          ]
        ]
      );
    }catch(RequestException $e){
      var_dump($e->getResponse()->getBody()->getContents());
    }
    $json = $response->getBody()->getContents();
    $pos[] = json_decode($json, true);


    try{
      $response = $client->request('POST','https://api.rajaongkir.com/starter/cost',
        [
          'body' => 'origin='.$origin[$i]->id.'&destination='.trim($req->kota).'&weight='.$weight[$i]->berat.'&courier=tiki',
          'headers' => [
            'key' => '01b297c03ed339ba85c02f251227179c',
            'content-type' => 'application/x-www-form-urlencoded',
          ]
        ]
      );
    }catch(RequestException $e){
      var_dump($e->getResponse()->getBody()->getContents());
    }
    $json = $response->getBody()->getContents();
    $tiki[] = json_decode($json, true);

    }


      return view('app.ongkir', compact('produk','jne','pos','tiki','total','alamat','kota1','provinsi1','alamatpenjual'));
    }

    public function alamatPembelian(Request $req) {
      $loginSession = $req->session()->get('login');
      $pelangganId = $loginSession['id'];

      $keranjang = DB::table('keranjang')
      ->join('produk', 'produk.produk_id', '=', 'keranjang.keranjang_produk')
      ->where('keranjang.keranjang_pelanggan', '=', $pelangganId)
      ->where('keranjang.keranjang_jumlah', '<', 10)
      ->first();

      if ($keranjang) {
        $req->session()->flash('msg', [
            'success' => false,
            'msg' => 'Ada jumlah produk yang kurang dari minimum pembelian. Minimum pembelian adalah 10'
        ]);
        return redirect('/user/keranjang');
      }else {
        $province = Province::all();
        $pelanggan = DB::table('province')
        ->join('pelanggan', 'pelanggan.pelanggan_province', '=', 'province.id')
        ->join('city', 'city.id', '=', 'pelanggan.pelanggan_city')
        ->where('pelanggan.pelanggan_id', '=', $pelangganId)
        ->select('city.name as city','province.name as province','pelanggan.pelanggan_nama','pelanggan_alamat')
        ->first();

        return view('app.alamatpembelian',compact('pelanggan','province'));
      }





    }



}
