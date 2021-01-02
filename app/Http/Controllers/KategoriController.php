<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Mockery\Exception;
use App\Models\Kategori;

class KategoriController extends Controller {

    public function add(Request $req) {
      $messages = [
    'required' => 'Tabel :attribute wajib diisi'
];
      $this->validate($req,[
        'nama' => 'required'
        ],$messages);
        try {
            $kategori = new Kategori();
            $kategori->kategori_nama = trim($req->nama);
            $kategori->kategori_deskripsi = trim($req->deskripsi ?: 'Tidak Ada Deskripsi');
            $kategori->save();
            $req->session()->flash('msg', [
                'success' => true,
                'msg' => 'Berhasil menambahkan kategori produk!'
            ]);
        } catch (Exception $ex) {
            $req->session()->flash('msg', [
                'success' => false,
                'msg' => "Gagal menambahkan kategori produk!, {$ex->getMessage()}"
            ]);
        }
        return redirect('/admin/kategori/add');
    }

    public function update(Request $req, $id) {
        try {
            $kategori = Kategori::find($id);
            $kategori->kategori_nama = trim($req->nama);
            $kategori->kategori_deskripsi = trim($req->deskripsi ?: 'Tidak Ada Deskripsi');
            $kategori->save();
            $req->session()->flash('msg', [
                'success' => true,
                'msg' => "Kategori dengan id: '{$id}' berhasil di ubah!"
            ]);
        } catch (Exception $ex) {
            $req->session()->flash('msg', [
                'success' => false,
                'msg' => "Kategori dengan id: '{$id}' gagal diubah!, {$ex->getMessage()}"
            ]);
        }
        return redirect('/admin/kategori');
    }

    public function delete(Request $req, $id) {
        try {
            Kategori::find($id)->delete();
            $req->session()->flash('msg', [
                'success' => true,
                'msg' => "Kategori dengan id: '{$id}' berhasil dihapus!"
            ]);
        } catch (Exception $ex) {
            $req->session()->flash('msg', [
                'success' => false,
                'msg' => "Kategori dengan id: '{$id}' gagal dihapus!, {$ex->getMessage()}"
            ]);
        }
        return redirect('/admin/kategori');
    }

    public function datatables() {
        return Datatables::of(Kategori::getAll())
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

    public function addPage() {
        return view('admin.addkategori');
    }

    public function listPage() {
        return view('admin.kategori');
    }


}
