<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Upload;
use Yajra\DataTables\DataTables;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Transaksi;
use Illuminate\Support\Str;
use Mockery\Exception;

class TransaksiController extends Controller {
  private $upload;

  public function __construct() {
      $this->upload = new Upload('images/bukti');
  }


    public function addSaldo(Request $req){
      $random = mt_rand(1000000000,9999999999);
      $loginSession = $req->session()->get('login');
      $pelangganId = $loginSession['id'];
      try{
        $transaksi = new Transaksi();
        $transaksi->transaksi_id=$random;
        $transaksi->transaksi_pelanggan = $pelangganId;
        $transaksi->transaksi_to = 'admin';
        $transaksi->transaksi_nominal = trim($req->nominal);
        $transaksi->transaksi_bank=trim($req->bank);
        $transaksi->transaksi_deskripsi='top up';
        $transaksi->save();
        $req->session()->flash('msg', [
            'success' => true,
            'msg' => 'Permintaan Top Up berhasil dilakukan!'
        ]);
        return redirect('/user/saldo');
      }catch (Exception $ex) {
          $req->session()->flash('msg', [
              'success' => false,
              'msg' => "Top Up Gagal, {$ex->getMessage()}"
          ]);
      }
      return redirect('/user/saldo');
    }

    public function confSaldo(Request $req){
      $messages = [
        'required' => 'Kolom :attribute wajib diisi',
        'image' => 'Upload file gambar',
        'mimes' => 'Format file hanya jpg,png,jpeg'
    ];
      $this->validate($req, [
          'gambar' => 'required|image|mimes:jpg,png,jpeg'
      ],$messages);
      try {

        $loginSession = $req->session()->get('login');
        $pelangganId = $loginSession['id'];
          $transaksi = Transaksi::where('transaksi_pelanggan',$pelangganId)->where('transaksi_deskripsi','top up')
          ->where(function ($query) {
          $query->where('transaksi_bayar','Belum Dibayar')->orWhere('transaksi_bayar','Tidak Valid');
        })->first();
          if ($req->file('gambar')) {
              $this->upload->delete($transaksi->gambar);
              $transaksi->gambar = $this->upload->image($req->file('gambar'));
          }
          $transaksi->transaksi_bayar = 'Belum Dibayar';
          $transaksi->save();
          $req->session()->flash('msg', [
              'success' => true,
              'msg' => "Update transaksi berhasil!"
          ]);
      } catch (Exception $ex) {
          $req->session()->flash('msg', [
              'success' => true,
              'msg' => "Terjadi kesalahan, transaksi gagal diupdate!"
          ]);
      }
      return redirect('/user/saldo');
    }

    public function updateTopUp(Request $req, $id){
      if ($req->has('konfirmasi')) {
        try {
            $transaksi = Transaksi::find($id);
            $transaksi->transaksi_bayar = 'Sudah Dibayar';



            $transaksi->save();

            $pelanggan = Pelanggan::find($transaksi->transaksi_pelanggan);
            $pelanggan->saldo += $transaksi->transaksi_nominal;
            $pelanggan->save();

            $req->session()->flash('msg', [
                'success' => true,
                'msg' => $req->fromadmin ? 'Update data Top Up berhasil!' : 'Update Top Up berhasil!'
            ]);


        } catch(Exception $ex){
            $req->session()->flash('msg', [
                'success' => false,
                'msg' => $req->fromadmin ? "Terjadi kesalahan, update data Top Up gagal, {$ex->getMessage()}" : 'Terjadi kesalahan, Update top Up gagal!'
            ]);
        }
        return redirect('/admin/datatopup');
      } else if ($req->has('tolak')) {
        try {
            $transaksi = Transaksi::find($id);
            $transaksi->transaksi_bayar = 'Tidak Valid';



            $transaksi->save();

            $req->session()->flash('msg', [
                'success' => true,
                'msg' => $req->fromadmin ? 'Update data Top Up berhasil!' : 'Update Top Up berhasil!'
            ]);


        } catch(Exception $ex){
            $req->session()->flash('msg', [
                'success' => false,
                'msg' => $req->fromadmin ? "Terjadi kesalahan, update data Top Up gagal, {$ex->getMessage()}" : 'Terjadi kesalahan, Update top Up gagal!'
            ]);
        }
        return redirect('/admin/datatopup');
      }


}

}
