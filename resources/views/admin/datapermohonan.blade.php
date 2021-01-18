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
                        <th>No</th>
                        <th>Pemohon</th>
                        <th>Jenis</th>
                        <th>Masuk</th>
                        <th>Operator</th>
                        <th>Selesai</th>
                        <th>Keterangan</th>
                        <th>Proses</th>
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
                        <label for="email" class="col-form-label">Penerima:</label>
                        <input disabled type="text" class="form-control" id="penerima" name="penerima">
                    </div>
                    <p class="text-danger">{{ $errors->first('penerima') }}</p>
                    <div class="form-group">
                        <label for="nama" class="col-form-label">Pemohon:</label>
                        @if(session('login')['level'] === 1||session('login')['level'] === 3)
                        <input type="text" class="form-control" id="pemohon" name="pemohon">
                        @else
                        <input disabled type="text" class="form-control" id="pemohon" name="pemohon">
                        @endif
                    </div>
                    <p class="text-danger">{{ $errors->first('pemohon') }}</p>
                    <div class="form-group">
                        <label for="nama" class="col-form-label">Alamat:</label>
                        @if(session('login')['level'] === 1||session('login')['level'] === 3)
                        <input type="text" class="form-control" id="alamat" name="alamat">
                        @else
                        <input disabled type="text" class="form-control" id="alamat" name="alamat">
                        @endif
                    </div>
                    <p class="text-danger">{{ $errors->first('alamat') }}</p>
                    <div class="form-group">
                        <label for="kontak" class="col-form-label">NIK:</label>
                        @if(session('login')['level'] === 1||session('login')['level'] === 3)
                        <input type="number" class="form-control" id="NIK" name="NIK">
                        @else
                        <input disabled type="number" class="form-control" id="NIK" name="NIK">
                        @endif
                    </div>
                    <p class="text-danger">{{ $errors->first('nik') }}</p>
                    <div class="form-group">
                        <label for="kontak" class="col-form-label">Kontak:</label>
                        @if(session('login')['level'] === 1||session('login')['level'] === 3)
                        <input type="number" class="form-control" id="no_hp" name="no_hp">
                        @else
                        <input disabled type="number" class="form-control" id="no_hp" name="no_hp">
                        @endif
                    </div>
                    <p class="text-danger">{{ $errors->first('no_hp') }}</p>
                    <div class="form-group">
                        <label for="nama" class="col-form-label">Jenis Permohonan:</label>
                        @if(session('login')['level'] === 1||session('login')['level'] === 3)
                        <input type="text" class="form-control" id="jenis" name="jenis">
                        @else
                        <input disabled type="text" class="form-control" id="jenis" name="jenis">
                        @endif
                    </div>
                    <p class="text-danger">{{ $errors->first('jenis') }}</p>
                    <p class="text-danger">{{ $errors->first('peninjauan') }}</p>
                    <div class="form-group">
                        <label for="alamat" class="col-form-label">Status:</label>
                          <div class="col-md-14 form-inline">
                          @if(session('login')['level'] === 1 ||session('login')['level'] === 3)
                          <select class="form-control col-md-12" name="status" id="status">
                          @else
                          <select disabled class="form-control col-md-12" name="status" id="status">
                          @endif
                          <option value="Diterima">Diterima</option>
                                <option value="Dikembalikan">Dikembalikan</option>
                          </select>
                          <!-- </div>
                          <div class="col-md-12 form-group"> -->
                          </div>
                          
                          </div>
                          <div class="form-group">
                    </div>
                    <p class="text-danger">{{ $errors->first('status') }}</p>
                    <div class="form-group">
                        <label for="alamat" class="col-form-label">Diteruskan:</label>
                          <div class="col-md-14 form-inline">
                          @if(session('login')['level'] === 1)
                          <select class="form-control col-md-12" name="diteruskan" id="diteruskan">
                          @else
                          <select disabled class="form-control col-md-12" name="diteruskan" id="diteruskan">
                          @endif
                          <option value="-">-</option>
                          <option value="Kabid">Kabid</option>
                            <option value="Operator">Operator</option>
                            <option value="Selesai">Selesai</option>
                          </select>
                          
                          <!-- </div>
                          <div class="col-md-12 form-group"> -->
                          </div>
                          
                          </div>
                          <div class="form-group">
                    </div>
                    <p class="text-danger">{{ $errors->first('diteruskan') }}</p>
                    <div class="form-group">
                        <label for="alamat" class="col-form-label">Proses:</label>
                          <div class="col-md-14 form-inline">
                          @if(session('login')['level'] === 1 ||session('login')['level'] === 3)
                          <select disabled class="form-control col-md-12" name="proses" id="proses">
                          @else
                          <select class="form-control col-md-12" name="proses" id="proses">
                          @endif
                          <option value="Sedang Dalam Proses">Sedang Dalam Proses</option>
                                <option value="Selesai">Selesai</option>
                          </select>
                          
                          <!-- </div>
                          <div class="col-md-12 form-group"> -->
                          </div>
                          
                          </div>
                          <div class="form-group">
                    </div>
                    <div class="form-group">
                        <label for="nama" class="col-form-label">Masuk:</label>
                        <input disabled type="text" class="form-control" id="masuk" name="masuk">
                    </div>
                    <div class="form-group">
                        <label for="nama" class="col-form-label">Masuk Operator:</label>
                        <input disabled type="text" class="form-control" id="masuk_operator" name="masuk_operatr">
                    </div>
                    <div class="form-group">
                        <label for="nama" class="col-form-label">Selesai:</label>
                        <input disabled type="text" class="form-control" id="selesai" name="selesai">
                    </div>
                    
                
                    <p class="text-danger">{{ $errors->first('diteruskan') }}</p>
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

function openAction(res) {
    var idURL = "{{ url('/admin/permohonan/') }}/" + res.permohonan_id;
    $('#action-modal').modal();
    $('#form-delete').attr('action', idURL);
    $('#form-edit').attr('action', idURL);
    for (var key in res) {
        $('#'+key.replace(/permohonan_/g, ''))
            .val(res[key]);
    }
}

$(document).ready(function() {
    var table = $('#data-pelanggan').DataTable({
        processing: true,
        "defaultContent": "-",
        "targets": "_all",
        serverSide: true,
        ajax: "{{ url('/admin/permohonan/data') }}",
        columns: [
            { "data": null,"sortable": false, 
                render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
                }   },
            { 'data': 'permohonan_pemohon' },
            { 'data': 'permohonan_jenis' },
            { 'data': 'permohonan_masuk' },
            { 'data': 'permohonan_masuk_operator'},
            { 'data': 'permohonan_selesai' },
            { 'data': 'permohonan_status' },
            { 'data': 'permohonan_diteruskan' },
            { 'data': 'action' },
        ]
    });
});
</script>
@endsection
