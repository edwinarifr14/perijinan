@extends('layouts.admin')

@section('title', 'List Kategori Produk')

@section('content')
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Data Kategori Produk
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="data-kategori" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Kategori</th>
                        <th>Deskripsi Kategori</th>
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
                        <label for="nama" class="col-form-label">Nama Kategori:</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                    </div>
                    <p class="text-danger">{{ $errors->first('namas') }}</p>
                    <div class="form-group">
                        <label for="deskripsi" class="col-form-label">Deskripsi Kategori:</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
                    </div>
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
    var idURL = "{{ url('/kategori') }}/" + res.kategori_id;
    $('#action-modal').modal();
    $('#form-delete').attr('action', idURL);
    $('#form-edit').attr('action', idURL);
    for (var key in res) {
        $('#'+key.replace(/kategori_/g, ''))
            .val(res[key]);
    }
}

$(document).ready(function() {
    var table = $('#data-kategori').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('/kategori/data') }}",
        columns: [
            { 'data': 'kategori_id' },
            { 'data': 'kategori_nama' },
            { 'data': 'kategori_deskripsi' },
            { 'data': 'action' }
        ]
    });
});
</script>
@endsection
