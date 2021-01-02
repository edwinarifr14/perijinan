<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Pesanan;
use App\Models\Keranjang;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Input;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller {
  public function listPage() {
      return view('admin.pesanan');
  }

  public function addpesanan(Request $req) {
    $loginSession = $req->session()->get('login');
    $pelangganId = $loginSession['id'];
    $pelanggan = Pelanggan::find($pelangganId);
    $saldo = $pelanggan->saldo;
    $total = trim($req->tot);
    if ($saldo < $total ) {
      $req->session()->flash('msg', [
          'success' => false,
          'msg' => 'Maaf, saldo anda tidak mencukupi untuk melakukan pemesanan ini'
      ]);



    }else {
      $produk = DB::table('keranjang')
      ->join('produk', 'produk.produk_id', '=', 'keranjang.keranjang_produk')
      ->join('kemasan', 'kemasan.kemasan_id', '=', 'produk.produk_kemasan')
      ->where('keranjang.keranjang_pelanggan', '=', $pelangganId)
      ->get();

      for ($i=0; $i < count($produk) ; $i++) {
        DB::table('pesanan')
            ->insert(array(
                array('pesanan_pelanggan'=>$pelangganId, 'pesanan_penjual'=>trim($req->penjual[$i]),
              'pesanan_produk'=>trim($req->idbarang[$i]), 'pesanan_jumlah'=>trim($req->jumlahbarang[$i]),
            'pesanan_tujuan'=>trim($req->alamatpengiriman), 'pesanan_dari'=>trim($req->alamatpenjual[$i]),
            'pesanan_harga' => trim($req->hargabarang[$i]) + trim($req->ongkir[$i])),
            ));
      }
      $req->session()->flash('msg', [
          'success' => true,
          'msg' => 'Pemesanan berhasil dilakukan'
      ]);
      $id = DB::table('keranjang')
      ->join('produk', 'produk.produk_id', '=', 'keranjang.keranjang_produk')
      ->join('kemasan', 'kemasan.kemasan_id', '=', 'produk.produk_kemasan')
      ->where('keranjang.keranjang_pelanggan', '=', $pelangganId)
      ->get();

      for ($i=0; $i < count($produk) ; $i++) {
        $p = Produk::find($id[$i]->produk_id);
        $p->produk_stok -= $id[$i]->keranjang_jumlah;
        $p->save();
        Keranjang::find($id[$i]->keranjang_id)->delete();
        }
        $pelanggan = Pelanggan::find($pelangganId);
        $pelanggan->saldo -= $total;
        $pelanggan->save();
    }


    // dd($total);

      return redirect('/user/keranjang');
  }

  public function pesananPage(Request $req) {
    $loginSession = $req->session()->get('login');
    $pelangganId = $loginSession['id'];
    $pemesanan = DB::table('pesanan')
    ->join('produk', 'produk.produk_id', '=', 'pesanan.pesanan_produk')
    ->join('pelanggan', 'pelanggan_id', '=', 'produk.pemilik')
    ->where('pesanan.pesanan_pelanggan', '=', $pelangganId)
    ->orderBy('pesanan_status','DESC')
    ->get();

    // dd($pemesanan);
      return view('app.pesanan',compact('pemesanan'));
  }

  public function PenjualanPage(Request $req) {
    $loginSession = $req->session()->get('login');
    $pelangganId = $loginSession['id'];
    $pemesanan = DB::table('pelanggan')
    ->join('pesanan', 'pesanan.pesanan_pelanggan', '=', 'pelanggan.pelanggan_id')
    ->join('produk', 'produk_id', '=', 'pesanan.pesanan_produk')
    ->where('pesanan.pesanan_penjual', '=', $pelangganId)
    ->orderBy('pesanan_status','DESC')
    ->get();

    // dd($pemesanan);
      return view('app.jualan',compact('pemesanan'));
  }

  public function sukses(Request $req, $id) {
    $p = Pesanan::find($id);
    $harga = $p->pesanan_harga;
    $p->pesanan_status = "sukses";
    $p->save();
    $penjual = Pelanggan::find($p->pesanan_penjual);
    $penjual->saldo += $harga;
    $penjual->save();
    $req->session()->flash('msg', [
        'success' => true,
        'msg' => 'Status pemesanan berhasil diubah'
    ]);
    // dd($harga);
      return redirect('/user/pesanan');
  }

  public function pengemasan(Request $req, $id) {
    $p = Pesanan::find($id);
    $p->pesanan_status = "pengemasan";
    $p->save();
    $req->session()->flash('msg', [
        'success' => true,
        'msg' => 'Status penjualan berhasil diubah'
    ]);
    // dd($harga);
      return redirect('/user/penjualan');
  }

  public function pengiriman(Request $req, $id) {
    $p = Pesanan::find($id);
    $p->pesanan_status = "pengiriman";
    $p->save();
    $req->session()->flash('msg', [
        'success' => true,
        'msg' => 'Status penjualan berhasil diubah'
    ]);
    // dd($harga);
      return redirect('/user/penjualan');
  }

}
