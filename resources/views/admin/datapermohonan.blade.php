@extends('layouts.admin')

@section('title', 'Data Permohonan')

@section('content')
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Data Permohonan
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
            <table class="table table-bordered" id="data-pelanggan" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Kontak</th>
                        <th>Alamat</th>
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
                        <label for="email" class="col-form-label">Email:</label>
                        <input type="text" class="form-control" id="email" name="email">
                    </div>
                    <p class="text-danger">{{ $errors->first('email') }}</p>
                    <div class="form-group">
                        <label for="nama" class="col-form-label">Nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                    </div>
                    <p class="text-danger">{{ $errors->first('nama') }}</p>
                    <div class="form-group">
                        <label for="kontak" class="col-form-label">Kontak:</label>
                        <input type="number" class="form-control" id="kontak" name="kontak">
                    </div>
                    <p class="text-danger">{{ $errors->first('kontok') }}</p>
                        <div class="form-group">
                        <label for="alamat" class="col-form-label">Alamat:</label>
                          <div class="col-md-14 form-inline">
                          <select class="form-control col-md-6" name="provinsi" id="provinsi">
                              <option disabled selected>--Provinsi Asal--</option>
                              @foreach ($province as $p)
                                  <option value="{{ $p->id }}">{{ $p->name }}</option>
                              @endforeach
                          </select>
                          <!-- </div>
                          <div class="col-md-12 form-group"> -->
                          <select class="form-control col-md-6" name="kota" id="kota">
                              @foreach ($city as $c)
                              <option value="{{ $c->id }}">{{ $c->name }}</option>
                              @endforeach
                          </select>
                          </div>
                          <p class="text-danger">{{ $errors->first('provinsi') }}</p>
                          <p class="text-danger">{{ $errors->first('kota') }}</p>
                          </div>
                          <div class="form-group">

                        <input type="alamat" class="form-control" id="alamat" name="alamat">
                    </div>
                    <p class="text-danger">{{ $errors->first('alamat') }}</p>
                    <div class="form-group">
                        <label for="password" class="col-form-label">Reset Password:</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <input type="hidden" name="fromadmin" value="true" />
                </form>
            </div>
            <div class="modal-footer">
                <form id="form-delete" class="mr-auto" action="#" method="POST">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="fromadmin" value="true" />
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
$(document).ready(function() {
    $('#provinsi').val('{{ $user->pelanggan_province }}')
    $('#kota').val('{{ $user->pelanggan_city }}')
})
function openAction(res) {
    var idURL = "{{ url('/user/') }}/" + res.pelanggan_id;
    $('#action-modal').modal();
    $('#form-delete').attr('action', idURL);
    $('#form-edit').attr('action', idURL);
    for (var key in res) {
        $('#'+key.replace(/pelanggan_/g, ''))
            .val(res[key]);
    }
}

$(document).ready(function() {
    var table = $('#data-pelanggan').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('/admin/pelanggan/data') }}",
        columns: [
            { 'data': 'pelanggan_id' },
            { 'data': 'pelanggan_nama' },
            { 'data': 'pelanggan_email' },
            { 'data': 'pelanggan_kontak' },
            { 'data': 'pelanggan_alamat' },
            { 'data': 'action' },
        ]
    });
});
</script>
@endsection
