<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Yajra\DataTables\DataTables;
use Mockery\Exception;
use App\Models\Admin;
use App\Province;
use App\City;
use App\Bidang;
use App\Permohonan;
use Carbon\Carbon;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use App\Models\Pesanan;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
      public function index() {

        $tahun = DB::table('permohonan')
        ->select(DB::raw('YEAR(permohonan_waktu) as tahun'))
        ->orderBy('permohonan_waktu','desc')
        ->first();

        if($tahun){
            for ($i=1; $i < 13 ; $i++) {
                $permohonan[] = DB::table('permohonan')
                ->select('permohonan_id')
                ->whereYear('permohonan_waktu', $tahun->tahun)
                ->whereMonth('permohonan_waktu', $i)
                ->count();
              }
      
              $totalthn = DB::table('permohonan')
              ->select('permohonan_id')
              ->whereYear('permohonan_waktu', $tahun->tahun)
              ->count();

              $tahunn=$tahun->tahun;
      
        }else{
            for ($i=1; $i < 13 ; $i++) {
                $permohonan[] = 0;
              }
              $tahunn = Carbon::now('+07:00')->format('Y');
              $totalthn = 0;
        }

        
        $total = DB::table('permohonan')
        ->select('permohonan_id')
        ->count();

        // dd($penjualan);
        return view('admin.dashboard', compact('permohonan', 'total','tahunn','totalthn'));
    }

    public function list() {
        return view('admin.dataadmin');
    }

    public function register() {
        return view('admin.registeradmin');
    }

    public function settings(Request $req) {
        return view('admin.settings', [
            'currentdata' => Admin::find($req->session()->get('login')['id'])
        ]);
    }

    public function listPermohonan(Request $req) {
    //   $user = Pelanggan::find($req->session()->get('login')['id']);
      /* $province = Province::all();
      $city = City::select('name','id')->where('id_province',$user->pelanggan_province)->get(); */
        return view('admin.datapermohonan');
    }

    public function diteruskan(Request $request)
    {
      $bidang = Bidang::select('nama','bidang_id')->where('peninjauan',$request->id)->get();
      return response()->json($bidang);
    }

    public function tambahPermohonan(Request $req) {
    //   $transaksi = Transaksi::where('transaksi_deskripsi','top up')->get();
        /* $tess = Bidang::select('nama')->get();
        $tes=Admin::find($req->session()->get('login')['id']); */
        return view('admin.tambahpermohonan');
        // return print($tes);
    }

    public function detailPelanggan(Request $req) {
        return "Hello World";
    }

    public function delete(Request $req, $id) {
        try {
            Admin::find($id)->delete();
            $req->session()->flash('msg', [
                'success' => true,
                'msg' => 'Delete Admin berhasil!'
            ]);
        } catch (Exception $ex) {
            $req->session()->flash('msg', [
                'success' => false,
                'msg' => "Terjadi Error, delete Admin gagal: {$ex->getMessage()}"
            ]);
        }
        return redirect('/admin/dataadmin');
    }

    public function update(Request $req, $id) {
      $messages = [
        'alpha' => 'Hanya huruf pada kolom nama',
    'min' => 'Kontak harus diisi minimal 10 dan maximal 13',
    'max' => 'Kontak harus diisi minimal 10 dan maximal 13',
    'required' => 'Tabel :attribute wajib diisi'
];
      $this->validate($req,[
        'username' => 'required',
        'nama' => 'required',
        'level' => 'required'
        ],$messages);
        try {
            $admin = Admin::find($id);
            if ($req->fromadmin)
                $admin->admin_level = (int) $req->level;
            if ($req->password)
                $admin->admin_password = Hash::make($req->password);
            $admin->admin_username = trim($req->username);
            $admin->admin_nama = trim($req->nama);
            $admin->admin_kontak = trim($req->kontak);
            $admin->save();

            if ($req->session()->get('login')['id'] === $admin->admin_id)
                $this->loginSession($req, $admin);
            $req->session()->flash('msg', [
                'success' => true,
                'msg' => 'Update data Admin berhasil!'
            ]);
        } catch (QueryException $ex) {
            if ((int) $ex->getCode() === 23000) {
                $req->session()->flash('msg', [
                    'success' => false,
                    'msg' => "Username '{$req->username}' sudah digunakan!"
                ]);
            } else throw new Exception($ex->getMessage());
        } catch (Exception $ex) {
            $req->session()->flash('msg', [
                'success' => false,
                'msg' => "Terjadi error.. Update data admin gagal, {$ex->getMessage()}"
            ]);
        }
        return redirect()->back();
    }

    public function datatables() {
        return Datatables::of(Admin::getAll())
            ->addColumn('action', function($data) {
                return '
                    <button
                        type="button"
                        class="btn btn-sm btn-primary"
                        onclick="openAction('.str_replace('"', '\'', json_encode($data)).')"
                    >
                        <i class="fa fa-eye"></i>
                    </button>
                ';
            })
            ->rawColumns(['action'])
            ->make();
    }

    public function datatablesPermohonan() {
        return Datatables::of(Permohonan::all())
            ->addColumn('action', function($data) {
                return '
                    <button
                        type="button"
                        class="btn btn-sm btn-primary"
                        onclick="openAction('.str_replace('"', '\'', json_encode($data)).')"
                    >
                        <i class="fa fa-eye"></i>
                    </button>
                ';
            })
            ->rawColumns(['action'])
            ->make();
    }

    public function auth(Request $req) {
      $messages = [
    'required' => 'Tabel :attribute wajib diisi'
];
      $this->validate($req,[
        'username' => 'required',
           'password' => 'required'
        ],$messages);
        try {
            $data = Admin::check($req->username);
            if ($data && Hash::check($req->password, $data->admin_password)) {
                $this->loginSession($req, $data);
                return redirect('/admin');
            }
            throw new Exception('Password atau Username salah');
        } catch (Exception $ex) {
            $req->session()->flash('msg', [
                'success' => false,
                'msg' => $ex->getMessage()
            ]);
            return redirect('/admin/login');
        }
    }

    public function add(Request $req) {
      $messages = [
        'alpha' => 'Hanya huruf pada kolom nama',
    'min' => 'Kontak harus diisi minimal 10 dan maximal 13',
    'max' => 'Kontak harus diisi minimal 10 dan maximal 13',
    'required' => 'Tabel :attribute wajib diisi'
];
      $this->validate($req,[
        'username' => 'required',
        'nama' => 'required',
           'level' => 'required',
           'password' => 'required'
        ],$messages);
        try {
            $admin = new Admin();
            $admin->admin_username = trim($req->username);
            $admin->admin_nama = trim($req->nama);
            $admin->admin_kontak = trim($req->kontak);
            $admin->admin_level = (int) $req->level;
            $admin->admin_password = Hash::make($req->password);
            $admin->save();
            $req->session()->flash('msg', [
                'success' => true,
                'msg' => 'Admin berhasil ditambahkan'
            ]);
        } catch (QueryException $ex) {
            if ((int) $ex->getCode() === 23000) {
                $req->session()->flash('msg', [
                    'success' => false,
                    'msg' => "Username '{$req->username}' sudah digunakan!"
                ]);
            } else throw new Exception($ex->getMessage());
        } catch (Exception $ex) {
            $req->session()->flash('msg', [
                'success' => false,
                'msg' => "Register Admin gagal, {$ex->getMessage()}"
            ]);
        }
        return redirect('/admin/registeradmin');
    }

    public function login(Request $req) {
        if ($req->session()->get('login')['admin'])
            return redirect('/admin');
        return view('admin.login');
    }

    private function loginSession(Request $req, $data) {
        $req->session()->put('login', [
            'admin' => true,
            'id' => $data->admin_id,
            'nama' => $data->admin_nama,
            'level' => $data->admin_level
        ]);
    }

    public function konfTopUp($id) {
        return view('admin.conftopup', [
            'transaksi' => Transaksi::find($id)
        ]);
    }

    public function datatablesPesanan() {
        return Datatables::of(Pesanan::all())
            ->make();
    }

    public function addPermohonan(Request $req) {/* 
        $tes=Admin::find($req->session()->get('login')['id']); */
        $messages = [
          'alpha' => 'Hanya huruf pada kolom nama',
      'min' => 'Jumlah karakter tidak sesuai',
      'max' => 'Jumlah karakter tidak sesuai',
      'required' => 'Tabel :attribute wajib diisi'
  ];
        $this->validate($req,[
            'pemohon' => 'required',
            'alamat' => 'required',
             'nik' => 'required|min:16|max:16',
             'jenis' => 'required',
             'peninjauan' => 'required',
             'kontak' => 'required|min:10|max:13'
          ],$messages);

            $data1 = trim($req->pemohon);
            $data2 = trim($req->alamat);
            $data3 = trim($req->nik);
            $data4 = trim($req->kontak);
            $data5 = trim($req->jenis);
            $data6 = trim($req->peninjauan);

          /* try {
              $admin = new Permohonan();
              $admin->permohonan_penerima = $tes->admin_nama;
              $admin->permohonan_pemohon = trim($req->pemohon);
              $admin->permohonan_alamat = trim($req->alamat);
              $admin->permohonan_NIK = trim($req->nik);
              $admin->permohonan_no_hp = trim($req->kontak);
              $admin->permohonan_jenis = trim($req->jenis);
              $admin->permohonan_status_peninjauan = trim($req->peninjauan);
              $admin->permohonan_status = trim($req->status);
              $admin->permohonan_diteruskan = trim($req->diteruskan);
              if($req->status == 'Dikembalikan'){
                  $admin->permohonan_proses = '-';
              }
              $admin->save();
              $req->session()->flash('msg', [
                  'success' => true,
                  'msg' => 'Permohonan berhasil ditambahkan'
              ]);
          } catch (QueryException $ex) {
              if ((int) $ex->getCode() === 23000) {
                  $req->session()->flash('msg', [
                      'success' => false,
                      'msg' => "Username '{$req->username}' sudah digunakan!"
                  ]);
              } else throw new Exception($ex->getMessage());
          } catch (Exception $ex) {
              $req->session()->flash('msg', [
                  'success' => false,
                  'msg' => "Permohonan gagal, {$ex->getMessage()}"
              ]);
          } */
          return view('admin.tambahpermohonan2',compact('data1', 'data2', 'data3','data4', 'data5', 'data6'));
      }

      public function addPermohonan2(Request $req) {
        $tes=Admin::find($req->session()->get('login')['id']);
        $messages = [
          'alpha' => 'Hanya huruf pada kolom nama',
      'min' => 'Jumlah karakter tidak sesuai',
      'max' => 'Jumlah karakter tidak sesuai',
      'required' => 'Tabel :attribute wajib diisi'
  ];
        $this->validate($req,[
            'pemohon' => 'required',
            'alamat' => 'required',
             'nik' => 'required|min:16|max:16',
             'jenis' => 'required',
             'peninjauan' => 'required',
             'kontak' => 'required|min:10|max:13'
          ],$messages);

            /* $data1 = trim($req->pemohon);
            $data2 = trim($req->alamat);
            $data3 = trim($req->nik);
            $data4 = trim($req->kontak);
            $data5 = trim($req->jenis);
            $data6 = trim($req->peninjauan); */

          try {
              $admin = new Permohonan();
              $admin->permohonan_penerima = $tes->admin_nama;
              $admin->permohonan_pemohon = trim($req->pemohon);
              $admin->permohonan_alamat = trim($req->alamat);
              $admin->permohonan_NIK = trim($req->nik);
              $admin->permohonan_no_hp = trim($req->kontak);
              $admin->permohonan_jenis = trim($req->jenis);
              $admin->permohonan_status_peninjauan = trim($req->peninjauan);
              $admin->permohonan_status = trim($req->status);
              if($req->diteruskan1){
                $admin->permohonan_diteruskan = trim($req->diteruskan1);
                if($req->status == 'Dikembalikan'){
                    $admin->permohonan_diteruskan = '-';
                }
              }else{
                $admin->permohonan_diteruskan = trim($req->diteruskan2);
                if($req->status == 'Dikembalikan'){
                    $admin->permohonan_diteruskan = '-';
                }
              }
              
              $admin->save();
              $req->session()->flash('msg', [
                  'success' => true,
                  'msg' => 'Permohonan berhasil ditambahkan'
              ]);
          } catch (QueryException $ex) {
              if ((int) $ex->getCode() === 23000) {
                  $req->session()->flash('msg', [
                      'success' => false,
                      'msg' => "Username '{$req->username}' sudah digunakan!"
                  ]);
              } else throw new Exception($ex->getMessage());
          } catch (Exception $ex) {
              $req->session()->flash('msg', [
                  'success' => false,
                  'msg' => "Permohonan gagal, {$ex->getMessage()}"
              ]);
          }
          return redirect('/admin/tambahpermohonan');
      }
      
      public function permohonanupdate(Request $req, $id){
        $tes=Admin::find($req->session()->get('login')['id']); 
        $tess= Permohonan::find($id);
        $date = Carbon::now('+07:00');
        $messages = [
          'alpha' => 'Hanya huruf pada kolom nama',
      'min' => 'Jumlah tidak sesuai',
      'max' => 'Jumlah tidak sesuai',
      'required' => 'Tabel :attribute wajib diisi'
  ];
        $this->validate($req,[
             'pemohon' => 'required',
             'alamat' => 'required',
             'NIK' => 'required',
             'status_peninjauan' => 'required',
             'no_hp' => 'required'
          ],$messages);
          
          if($tes->admin_nama === $tess->permohonan_diteruskan){
            try {
                $admin = Permohonan::find($id);
                
                  $admin->permohonan_pemohon = trim($req->pemohon);
                  $admin->permohonan_alamat = trim($req->alamat);
                  $admin->permohonan_NIK = trim($req->NIK);
                  $admin->permohonan_no_hp = trim($req->no_hp);
                  $admin->permohonan_jenis = trim($req->jenis);
                  $admin->permohonan_status_peninjauan = trim($req->status_peninjauan);
                  $admin->permohonan_status = trim($req->status);
                  $admin->permohonan_waktu = $date;
                  if($req->status=='Diterima'){
                        $admin->permohonan_diteruskan = trim($req->diteruskan);
                        $admin->save();
                  } elseif($req->status=='Dikembalikan'){
                    $admin->permohonan_diteruskan = '-';
                    $admin->save();
                  }
                  
                
    
                if ($req->session()->get('login')['id'] === $admin->admin_id)
                    $this->loginSession($req, $admin);
                $req->session()->flash('msg', [
                    'success' => true,
                    'msg' => 'Update data Permohonan berhasil!'
                ]);
            } catch (QueryException $ex) {
                if ((int) $ex->getCode() === 23000) {
                    $req->session()->flash('msg', [
                        'success' => false,
                        'msg' => "Username '{$req->username}' sudah digunakan!"
                    ]);
                } else throw new Exception($ex->getMessage());
            } catch (Exception $ex) {
                $req->session()->flash('msg', [
                    'success' => false,
                    'msg' => "Terjadi error.. Update datagagal, {$ex->getMessage()}"
                ]);
            }
            
          
        }else{
            $req->session()->flash('msg', [
                'success' => false,
                'msg' => "Terjadi error.. Update data gagal"
            ]);
        }
        return redirect()->back();

      }

      public function permohonandelete(Request $req, $id) {
        try {
            Permohonan::find($id)->delete();
            $req->session()->flash('msg', [
                'success' => true,
                'msg' => 'Delete Permohonan berhasil!'
            ]);
        } catch (Exception $ex) {
            $req->session()->flash('msg', [
                'success' => false,
                'msg' => "Terjadi Error, delete Permohonan gagal: {$ex->getMessage()}"
            ]);
        }
        return redirect()->back();
    }

}
