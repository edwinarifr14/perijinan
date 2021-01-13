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
                        <th>NIK</th>
                        <th>Jenis</th>
                        <th>Waktu Masuk</th>
                        <th>Waktu Selesai</th>
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
                        <input type="text" class="form-control" id="pemohon" name="pemohon">
                    </div>
                    <p class="text-danger">{{ $errors->first('pemohon') }}</p>
                    <div class="form-group">
                        <label for="nama" class="col-form-label">Alamat:</label>
                        <input type="text" class="form-control" id="alamat" name="alamat">
                    </div>
                    <p class="text-danger">{{ $errors->first('alamat') }}</p>
                    <div class="form-group">
                        <label for="kontak" class="col-form-label">NIK:</label>
                        <input type="number" class="form-control" id="NIK" name="NIK">
                    </div>
                    <p class="text-danger">{{ $errors->first('nik') }}</p>
                    <div class="form-group">
                        <label for="kontak" class="col-form-label">Kontak:</label>
                        <input type="number" class="form-control" id="no_hp" name="no_hp">
                    </div>
                    <p class="text-danger">{{ $errors->first('no_hp') }}</p>
                    <div class="form-group">
                        <label for="nama" class="col-form-label">Jenis Permohonan:</label>
                        <input type="text" class="form-control" id="jenis" name="jenis">
                    </div>
                    <p class="text-danger">{{ $errors->first('jenis') }}</p>
                    <div class="form-group">
                        <label for="alamat" class="col-form-label">Peninjauan Lapangan:</label>
                          <div class="col-md-14 form-inline">
                          @if(session('login')['level'] === 1 ||session('login')['level'] === 7)
                          <select class="form-control col-md-12" name="status_peninjauan" id="status_peninjauan">
                          @else
                          <select disabled class="form-control col-md-12" name="status_peninjauan" id="status_peninjauan">
                          @endif
                          <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                          </select>
                          <!-- </div>
                          <div class="col-md-12 form-group"> -->
                          </div>
                          
                          </div>
                          <div class="form-group">
                    </div>
                    <p class="text-danger">{{ $errors->first('peninjauan') }}</p>
                    <div class="form-group">
                        <label for="alamat" class="col-form-label">Status:</label>
                          <div class="col-md-14 form-inline">
                          @if(session('login')['level'] === 1 ||session('login')['level'] === 7)
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
                          @if(session('login')['level'] === 1 ||session('login')['level'] === 7)
                          <select class="form-control col-md-12" name="diteruskan" id="diteruskan">
                          <option value="-">-</option>
                          <option value="Kabid">Kabid</option>
                            <option value="Kasi Usaha">Kasi Usaha</option>
                            <option value="Non Usaha">Non Usaha</option>
                            <option value="Aris">Aris</option>
                            <option value="Rifki">Rifki</option>
                            <option value="Selesai">Selesai</option>
                          </select>
                          @else
                          <select  disabled class="form-control col-md-12" name="diteruskan" id="diteruskan">
                          <option value="-">-</option>
                          <option value="Kabid">Kabid</option>
                            <option value="Kasi Usaha">Kasi Usaha</option>
                            <option value="Non Usaha">Non Usaha</option>
                            <option value="Aris">Aris</option>
                            <option value="Rifki">Rifki</option>
                            <option value="Selesai">Selesai</option>
                          </select>
                          @endif
                          
                          
                          </div>
                          <div class="form-group">
                    </div>
                    <div class="form-group">
                        <label for="alamat" class="col-form-label">Proses:</label>
                          <div class="col-md-14 form-inline">
                          @if(session('login')['level'] === 1 ||session('login')['level'] === 7)
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
                    <p class="text-danger">{{ $errors->first('diteruskan') }}</p>
                    <div class="form-group">
                        <label for="nama" class="col-form-label">Waktu Masuk:</label>
                        <input disabled type="text" class="form-control" id="masuk" name="masuk">
                    </div>
                    <div class="form-group">
                        <label for="nama" class="col-form-label">Waktu Selesai:</label>
                        <input disabled type="text" class="form-control" id="waktu" name="waktu">
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
        serverSide: true,
        ajax: "{{ url('/admin/permohonan/data') }}",
        columns: [
            { 'data': 'permohonan_id' },
            { 'data': 'permohonan_pemohon' },
            { 'data': 'permohonan_NIK' },
            { 'data': 'permohonan_jenis' },
            { 'data': 'permohonan_masuk' },
            { 'data': 'permohonan_waktu' },
            { 'data': 'permohonan_status' },
            { 'data': 'permohonan_diteruskan' },
            { 'data': 'action' },
        ]
    });
});
</script>
@endsection
