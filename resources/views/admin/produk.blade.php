@extends('layouts.admin')

@section('title', 'Data Produk')

@section('content')
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Data Produk
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="data-produk" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Gambar Produk</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Kemasan</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Deskripsi</th>
                        <th>Pemilik</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer small text-muted"></div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    var table = $('#data-produk').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('/produk/data') }}",
        columns: [
            { 'data': 'produk_id' },
            { 'data': 'produk_gambar' },
            { 'data': 'produk_nama' },
            { 'data': 'kategori.kategori_nama' },
            { 'data': 'kemasan.kemasan_kode' },
            { 'data': 'produk_harga' },
            { 'data': 'produk_stok' },
            { 'data': 'produk_deskripsi' },
            { 'data': 'pemilik' },
            { 'data': 'action' }
        ]
    });
});
</script>
@endsection
