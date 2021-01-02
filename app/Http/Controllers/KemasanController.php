<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Mockery\Exception;
use App\Models\Kemasan;

class KemasanController extends Controller {

    public function add(Request $req) {
      $messages = [
    'required' => 'Tabel :attribute wajib diisi'
];
      $this->validate($req,[
        'kode' => 'required',
        'satuan' => 'required'
        ],$messages);
        try {
            $kemasan = new Kemasan();
            $kemasan->kemasan_kode = trim(strtoupper($req->kode));
            $kemasan->kemasan_gram = trim($req->satuan);
            $kemasan->kemasan_deskripsi = trim($req->deskripsi ?: 'Tidak Ada Deskripsi');
            $kemasan->save();
            $req->session()->flash('msg', [
                'success' => true,
                'msg' => 'Berhasil menambahkan kemasan produk!'
            ]);
        } catch (Exception $ex) {
            $req->session()->flash('msg', [
                'success' => false,
                'msg' => "Gagal menambahkan kemasan produk!, {$ex->getMessage()}"
            ]);
        }
        return redirect('/admin/kemasan/add');
    }

    public function update(Request $req, $id) {
      $messages = [
    'required' => 'Tabel :attribute wajib diisi'
];
      $this->validate($req,[
        'kode' => 'required',
        'gram' => 'required'
        ],$messages);
        try {
            $kemasan = Kemasan::find($id);
            $kemasan->kemasan_kode = trim(strtoupper($req->kode));
            $kemasan->kemasan_deskripsi = trim($req->deskripsi ?: 'Tidak Ada Deskripsi');
            $kemasan->kemasan_gram = trim($req->gram);
            $kemasan->save();
            $req->session()->flash('msg', [
                'success' => true,
                'msg' => "Kemasan dengan id: '{$id}' berhasil di ubah!"
            ]);
        } catch (Exception $ex) {
            $req->session()->flash('msg', [
                'success' => false,
                'msg' => "Kemasan dengan id: '{$id}' gagal diubah!, {$ex->getMessage()}"
            ]);
        }
        return redirect('/admin/kemasan');
    }

    public function delete(Request $req, $id) {
        try {
            Kemasan::find($id)->delete();
            $req->session()->flash('msg', [
                'success' => true,
                'msg' => "Kemasan dengan id: '{$id}' berhasil dihapus!"
            ]);
        } catch (Exception $ex) {
            $req->session()->flash('msg', [
                'success' => false,
                'msg' => "Kemasan dengan id: '{$id}' gagal dihapus!, {$ex->getMessage()}"
            ]);
        }
        return redirect('/admin/kemasan');
    }

    public function datatables() {
        return Datatables::of(Kemasan::getAll())
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
        return view('admin.addkemasan');
    }

    public function listPage() {
        return view('admin.kemasan');
    }


}
