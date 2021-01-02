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
use App\Models\Pelanggan;
use App\Models\Transaksi;
use App\Models\Pesanan;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
      public function index() {

        $tahun = DB::table('pesanan')
        ->select(DB::raw('YEAR(pesanan_waktu) as tahun'))
        ->orderBy('pesanan_waktu','desc')
        ->first();

        for ($i=1; $i < 13 ; $i++) {
          $penjualan[] = DB::table('pesanan')
          ->select('pesanan_id')
          ->where('pesanan_status', 'sukses')
          ->whereYear('pesanan_waktu', $tahun->tahun)
          ->whereMonth('pesanan_waktu', $i)
          ->count();
        }

        $totalthn = DB::table('pesanan')
        ->select('pesanan_id')
        ->where('pesanan_status', 'sukses')
        ->whereYear('pesanan_waktu', $tahun->tahun)
        ->count();

        $total = DB::table('pesanan')
        ->select('pesanan_id')
        ->where('pesanan_status', 'sukses')
        ->count();

        // dd($penjualan);
        return view('admin.dashboard', compact('penjualan', 'total','tahun','totalthn'));
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

    public function listPelanggan(Request $req) {
      $user = Pelanggan::find($req->session()->get('login')['id']);
      $province = Province::all();
      $city = City::select('name','id')->where('id_province',$user->pelanggan_province)->get();
        return view('admin.datapelanggan',compact('user','province','city'));
    }


    public function listTopUp(Request $req) {
      $transaksi = Transaksi::where('transaksi_deskripsi','top up')->get();

        return view('admin.datatopup',['transaksi'=>$transaksi]);
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
        'nama' => 'alpha|required',
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

    public function datatablesPelanggan() {
        return Datatables::of(Pelanggan::all())
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
        'nama' => 'alpha|required',
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

}
