<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Upload;
use Illuminate\Validation\Rule;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Kemasan;
use DB;
use App\Models\Pelanggan;
use Mockery\Exception;

class ProdukController extends Controller {

    private $upload;

    public function __construct() {
        $this->upload = new Upload('images/produk');
    }

    public function addPage() {
        return view('admin.addproduk', [
            'kategori' => Kategori::all(),
            'kemasan' => Kemasan::all()
        ]);
    }

    public function editPage($id) {
        return view('admin.updateproduk', [
            'produk' => Produk::find($id),
            'kategori' => Kategori::all(),
            'kemasan' => Kemasan::all()
        ]);
    }

    public function listPage() {
        return view('admin.produk');
    }

    public function detailProduk($produk_id){
        $produk = Produk::with(['kemasan', 'kategori'])->find($produk_id);
        $user = DB::table('pelanggan')
          ->join('produk', function ($join) use ($produk) {
              $join->on('pelanggan.pelanggan_id', '=', 'produk.pemilik')
                   ->where('pelanggan.pelanggan_id', '=',$produk->pemilik);
          })->select('pelanggan.pelanggan_nama')
          ->first();

          $city = DB::table('produk')
      ->join('pelanggan', 'pelanggan.pelanggan_id', '=', 'produk.pemilik')
      ->join('city', 'city.id', '=', 'pelanggan.pelanggan_city')
      ->where('produk.produk_id', '=', $produk_id)
      ->select('city.name')
      ->first();
        return view('app.detail', compact('user', 'produk', 'city')
        );
    }

    public function update(Request $req, $id) {
      $messages = [
        'required' => 'Kolom :attribute wajib diisi',
        'alpha' => 'asd',
        'image' => 'Upload file gambar',
        'mimes' => 'Format file hanya jpg,png,jpeg'
    ];

        $this->validate($req, [
          'nama' => 'required|alpha',
            'kategori' => ['required',Rule::notIn(['--Pilih Kategori Produk--'])],
            'kemasan' => ['required',Rule::notIn(['--Pilih Kemasan Produk--'])],
            'harga' => 'required',
            'nama' => 'required',
            'gambar' => 'image|mimes:jpg,png,jpeg'
        ],$messages);
        try {
            $produk = Produk::find($id);
            $produk->produk_nama = trim($req->nama);
            $produk->produk_kategori = (int) $req->kategori;
            $produk->produk_kemasan = (int) $req->kemasan;
            $produk->produk_harga = (double) $req->harga;
            $produk->produk_stok = (int) $req->stok;
            $produk->produk_deskripsi = trim($req->deskripsi ?: 'Tidak ada deskripsi');
            if ($req->file('gambar')) {
                $this->upload->delete($produk->produk_gambar);
                $produk->produk_gambar = $this->upload->image($req->file('gambar'));
            }
            $produk->save();
            $req->session()->flash('msg', [
                'success' => true,
                'msg' => "Update data produk dengan id: '{$id}' berhasil!"
            ]);
        } catch (Exception $ex) {
            $req->session()->flash('msg', [
                'success' => true,
                'msg' => "Terjadi kesalahan, data produk dengan id: '{$id}' gagal diupdate!"
            ]);
        }
        return redirect('/admin/produk');
    }

    public function delete(Request $req, $id) {
        try {
            $produk = Produk::find($id);
            $this->upload->delete($produk->produk_gambar);
            $produk->delete();
            $req->session()->flash('msg', [
                'success' => true,
                'msg' => 'Hapus Produk berhasil!'
            ]);
        } catch (Exception $ex) {
            $req->session()->flash('msg', [
                'success' => false,
                'msg' => "Terjadi Error, Hapus produk gagal: {$ex->getMessage()}"
            ]);
        }
        return redirect('/admin/produk');
    }

    public function add(Request $req) {
        $this->validate($req, [
            'gambar' => 'required|image|mimes:jpg,png,jpeg'
        ]);
        try {
            $produk = new Produk();
            $uploadedPath = $this->upload->image($req->file('gambar'));
            $produk->produk_nama = trim($req->nama);
            $produk->produk_kategori = (int) $req->kategori;
            $produk->produk_kemasan = (int) $req->kemasan;
            $produk->produk_harga = (double) $req->harga;
            $produk->produk_stok = (int) $req->stok;
            $produk->produk_deskripsi = trim($req->deskripsi ?: 'Tidak ada deskripsi');
            $produk->produk_gambar = $uploadedPath;
            $produk->pemilik = 'admin';
            $produk->save();
            $req->session()->flash('msg', [
                'success' => true,
                'msg' => 'Berhasil menambahkan produk!'
            ]);
        } catch (Exception $ex) {
            $req->session()->flash('msg', [
                'success' => false,
                'msg' => 'Terjadi kesalahan, menambahkan produk gagal'
            ]);
        }
        return redirect('/admin/produk/add');
    }

    public function datatables() {
        return Datatables::of(Produk::getAll())
            ->editColumn('produk_gambar', function($data) {
                return '
                    <img src="'.url('/uploads/images/produk/'
                    .$data->produk_gambar)
                    .'" class="img-thumbnail mx-auto d-block" alt="'
                    .$data->produk_nama
                    .'" width="125" height="125" onerror="this.setAttribute(\'src\', \''.url('/assets/img/no image2.jpg').'\')" />
                ';
            })
            ->addColumn('action', function($data) {
                return '
                    <a
                        href="'.url('/admin/produk/'.$data->produk_id).'"
                        class="btn btn-sm btn-primary"
                    >
                        <i class="fa fa-edit"></i>
                    </a>
                    <form style="display: inline-block" id="form-delete" class="mr-auto" action="'
                    .url('/produk/'.$data->produk_id).'" method="POST">'
                        .method_field('DELETE')
                        .csrf_field()
                        .'<button type="button" class="btn btn-sm btn-danger" onclick="return confirm(\'Anda yakin ingin menghapus data ini ?\') ? $(\'#form-delete\').submit() : false">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                ';
            })
            ->rawColumns(['produk_gambar', 'action'])
            ->make();
    }


    //user

    public function listPageUser(Request $req) {
      $loginSession = $req->session()->get('login');
      $pelangganId = $loginSession['id'];
      $produk = Produk::where('pemilik',$pelangganId)->get();
        return view('app.produkku',['produk' => $produk]);
    }

    public function datatablesUser() {
        return Datatables::of(Produk::getAll())
            ->editColumn('produk_gambar', function($data) {
                return '
                    <img src="'.url('/uploads/images/produk/'
                    .$data->produk_gambar)
                    .'" class="img-thumbnail mx-auto d-block" alt="'
                    .$data->produk_nama
                    .'" width="125" height="125" onerror="this.setAttribute(\'src\', \''.url('/assets/img/no image2.jpg').'\')" />
                ';
            })
            ->addColumn('action', function($data) {
                return '
                    <a
                        href="'.url('/user/produkku/'.$data->produk_id).'"
                        class="btn btn-sm btn-primary"
                    >
                        <i class="fa fa-edit"></i>
                    </a>
                    <form style="display: inline-block" id="form-delete" class="mr-auto" action="'
                    .url('/user/produk/'.$data->produk_id).'" method="POST">'
                        .method_field('DELETE')
                        .csrf_field()
                        .'<button type="button" class="btn btn-sm btn-danger" onclick="return confirm(\'Anda yakin ingin menghapus data ini ?\') ? $(\'#form-delete\').submit() : false">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                ';
            })
            ->rawColumns(['produk_gambar', 'action'])
            ->make();
    }

    public function editPageUser($id) {
        return view('app.updateprodukku', [
            'produk' => Produk::find($id),
            'kategori' => Kategori::all(),
            'kemasan' => Kemasan::all()
        ]);
    }

    public function updateUser(Request $req, $id) {
      $messages = [
        'required' => 'Kolom :attribute wajib diisi',
        'alpha' => 'asd',
        'image' => 'Upload file gambar',
        'mimes' => 'Format file hanya jpg,png,jpeg'
    ];

        $this->validate($req, [
          'nama' => 'required|alpha',
            'kategori' => 'required',
            'kemasan' => 'required',
            'harga' => 'required',
            'nama' => 'required',
            'gambar' => 'image|mimes:jpg,png,jpeg'
        ],$messages);
        try {
            $produk = Produk::find($id);
            $produk->produk_nama = trim($req->nama);
            $produk->produk_kategori = (int) $req->kategori;
            $produk->produk_kemasan = (int) $req->kemasan;
            $produk->produk_harga = (double) $req->harga;
            $produk->produk_stok = (int) $req->stok;
            $produk->produk_deskripsi = trim($req->deskripsi ?: 'Tidak ada deskripsi');
            if ($req->file('gambar')) {
                $this->upload->delete($produk->produk_gambar);
                $produk->produk_gambar = $this->upload->image($req->file('gambar'));
            }
            $produk->save();
            $req->session()->flash('msg', [
                'success' => true,
                'msg' => "Update data produk dengan id: '{$id}' berhasil!"
            ]);
        } catch (Exception $ex) {
            $req->session()->flash('msg', [
                'success' => true,
                'msg' => "Terjadi kesalahan, data produk dengan id: '{$id}' gagal diupdate!"
            ]);
        }
        return redirect('/user/produkku');
    }


    public function deleteUser(Request $req, $id) {
        try {
            $produk = Produk::find($id);
            $this->upload->delete($produk->produk_gambar);
            $produk->delete();
            $req->session()->flash('msg', [
                'success' => true,
                'msg' => 'Hapus Produk berhasil!'
            ]);
        } catch (Exception $ex) {
            $req->session()->flash('msg', [
                'success' => false,
                'msg' => "Terjadi Error, Hapus produk gagal: {$ex->getMessage()}"
            ]);
        }
        return redirect('/user/produkku');
    }

public function edit(Produk $produk)
{
  return view('app.updateprodukku',compact('produk'));
}


public function addPageUser() {
    return view('app.addproduk', [
        'kategori' => Kategori::all(),
        'kemasan' => Kemasan::all()
    ]);
}

public function addUser(Request $req) {
  $loginSession = $req->session()->get('login');
  $pelangganId = $loginSession['id'];
  $messages = [

    'alpha' => 'Hanya huruf pada kolom nama',
    'required' => 'Kolom :attribute wajib diisi',
    'image' => 'Upload file gambar',
    'mimes' => 'Format file hanya jpg,png,jpeg'
];

    $this->validate($req, [
      'nama' => 'alpha|required',
        'kategori' => ['required',Rule::notIn(['--Pilih Kategori Produk--'])],
        'kemasan' => ['required',Rule::notIn(['--Pilih Kemasan Produk--'])],
        'harga' => 'required',
        'nama' => 'required',
        'gambar' => 'required|image|mimes:jpg,png,jpeg'
    ],$messages);


    try {
        $produk = new Produk();
        $uploadedPath = $this->upload->image($req->file('gambar'));
        $produk->produk_nama = trim($req->nama);
        $produk->produk_kategori = (int) $req->kategori;
        $produk->produk_kemasan = (int) $req->kemasan;
        $produk->produk_harga = (double) $req->harga;
        $produk->produk_stok = (int) $req->stok;
        $produk->produk_deskripsi = trim($req->deskripsi ?: 'Tidak ada deskripsi');
        $produk->produk_gambar = $uploadedPath;
        $produk->pemilik = $pelangganId;
        $produk->save();
        $req->session()->flash('msg', [
            'success' => true,
            'msg' => 'Berhasil menambahkan produk!'
        ]);
    } catch (Exception $ex) {
        $req->session()->flash('msg', [
            'success' => false,
            'msg' => 'Terjadi kesalahan, menambahkan produk gagal'
        ]);
    }
    return redirect('/user/produkku/tambah');
}


}
