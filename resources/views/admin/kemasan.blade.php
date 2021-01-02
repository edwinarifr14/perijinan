@extends('layouts.admin')

@section('title', 'List Kemasan Produk')

@section('content')
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Data Kemasan Produk
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="data-kemasan" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kode Kemasan</th>
                        <th>Deskripsi Kemasan</th>
                        <th>Satuan Dalam Gram</th>
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

<div class="modal fade" id="action-modal" tabindex="-1" role="dialog" aria-labelledby="action-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Dialog Aksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-edit" action="#" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="nama" class="col-form-label">Kode Kemasan:</label>
                        <input type="text" class="form-control" id="kode" name="kode">
                    </div>
                    <p class="text-danger">{{ $errors->first('kode') }}</p>
                    <div class="form-group">
                        <label for="deskripsi" class="col-form-label">Deskripsi Kemasan:</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="gram" class="col-form-label">Satuan Dalam Gram:</label>
                        <input type="number" class="form-control" id="gram" name="gram">
                    </div>
                    <p class="text-danger">{{ $errors->first('gram') }}</p>
                </form>
            </div>
            <div class="modal-footer">
                <form id="form-delete" class="mr-auto" action="#" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="button" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus data ini ?') ? $('#form-delete').submit() : false">Hapus</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="$('#form-edit').submit()">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function openAction(res) {
    var idURL = "{{ url('/kemasan') }}/" + res.kemasan_id;
    $('#action-modal').modal();
    $('#form-delete').attr('action', idURL);
    $('#form-edit').attr('action', idURL);
    for (var key in res) {
        $('#'+key.replace(/kemasan_/g, ''))
            .val(res[key]);
    }
}

$(document).ready(function() {
    var table = $('#data-kemasan').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('/kemasan/data') }}",
        columns: [
            { 'data': 'kemasan_id' },
            { 'data': 'kemasan_kode' },
            { 'data': 'kemasan_deskripsi' },
            { 'data': 'kemasan_gram' },
            { 'data': 'action' }
        ]
    });
});
</script>
@endsection
