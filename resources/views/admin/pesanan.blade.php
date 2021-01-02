@extends('layouts.admin')

@section('title', 'Data Penjualan')

@section('content')
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Data Penjualan
    </div>
    <div class="card-body">
      @if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
        <div class="table-responsive">
            <table class="table table-bordered" id="data-pesanan" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ID Pembeli</th>
                        <th>ID Penjual</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Status</th>
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
    var table = $('#data-pesanan').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('/admin/pesanan/data') }}",
        columns: [
            { 'data': 'pesanan_id' },
            { 'data': 'pesanan_pelanggan' },
            { 'data': 'pesanan_penjual' },
            { 'data': 'pesanan_produk' },
            { 'data': 'pesanan_harga' },
            { 'data': 'pesanan_status' },
        ]
    });
});
</script>
@endsection
