@extends('layouts.admin')

@section('title', 'Data Admin')

@section('content')
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Data Admin
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="data-admin" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Kontak</th>
                        <th>Level</th>
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
                        <label for="username" class="col-form-label">Username:</label>
                        <input type="text" class="form-control" id="username" name="username">
                    </div>
                    <p class="text-danger">{{ $errors->first('username') }}</p>
                    <div class="form-group">
                        <label for="nama" class="col-form-label">Nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                    </div>
                    <p class="text-danger">{{ $errors->first('nama') }}</p>
                    <div class="form-group">
                        <label for="kontak" class="col-form-label">Kontak:</label>
                        <input type="number" class="form-control" id="kontak" name="kontak">
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-form-label">Ganti Password:</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="level" class="col-form-label">Level:</label>
                        <select id="level" name="level" class="custom-select d-block w-100" required>
                            <option disabled>--Pilih Level Admin--</option>
                                <option value="1">Super Admin</option>
                                <option value="2">Admin Kabid</option>
                                <option value="3">Admin Kasi Usaha</option>
                                <option value="4">Admin Non Usaha</option>
                                <option value="5">Admin Aris</option>
                                <option value="6">Admin Rifki</option>
                                <option value="7">Admin CS</option>
                        </select>
                    </div>
                    <p class="text-danger">{{ $errors->first('level') }}</p>
                    <input type="hidden" name="fromadmin" value="true" />
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
    var idURL = "{{ url('/admin') }}/" + res.admin_id;
    $('#action-modal').modal();
    $('#form-delete').attr('action', idURL);
    $('#form-edit').attr('action', idURL);
    for (var key in res) {
        $('#'+key.replace(/admin_/g, ''))
            .val(res[key]);
    }
}

$(document).ready(function() {
    var table = $('#data-admin').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('/admin/data') }}",
        columns: [
            { 'data': 'admin_id' },
            { 'data': 'admin_username' },
            { 'data': 'admin_nama' },
            { 'data': 'admin_kontak' },
            { 'data': 'admin_level' },
            { 'data': 'action' },
        ]
    });
});
</script>
@endsection
