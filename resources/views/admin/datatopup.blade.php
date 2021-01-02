@extends('layouts.admin')

@section('title', 'Data Top Up')

@section('content')
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Data Top Up
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="data-produk" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Id Pelanggan</th>
                        <th>Nominal</th>
                        <th>Bank</th>
                        <th>Waktu</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    @foreach($transaksi as $t)
                    <tr>
                      <td>{{$t->transaksi_id}}</td>
                      <td>{{$t->transaksi_pelanggan}}</td>
                      <td>{{$t->transaksi_nominal}}</td>
                      <td>{{$t->transaksi_bank}}</td>
                      <td>{{$t->transaksi_waktu}}</td>
                      <td>{{$t->transaksi_bayar}}</td>
                      <td>
                        <a
                        href="/admin/saldo/{{$t->id}}"
                        class="btn btn-sm btn-primary">
                        <i class="fa fa-eye"></i></a></td>
                      </tr>
                      @endforeach


                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer small text-muted"></div>
</div>
@endsection
