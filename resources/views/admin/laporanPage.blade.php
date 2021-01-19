<!DOCTYPE html>
<html>
<head>
	<title>Laporan Permohonan</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

	<div class="container">
		<center>
		<br/>
			<h4>Laporan Permohonan</h4>
			<h5>Tanggal {{date('d-m-Y', strtotime($mulai))}} Sampai Tanggal {{date('d-m-Y', strtotime($akhir))}}</h5>
		</center>
		<br/>
        <form action="{{ url('/admin/laporan/laporan_cetak') }}" method="POST">
            @csrf
            
            <input hidden value="{{$mulai}}" class="form-control" type="text" id="mulai" name="mulai"/>
			<input hidden value="{{$akhir}}" class="form-control" type="text" id="mulai" name="akhir"/>

			<a href="{{ url('/admin/laporan') }}" class="btn btn-secondary">Kembali</a>
                <button class="btn btn-primary">
                    <i class="fas fa-angle-double-right"></i>
                    <span>Cetak</span>
                </button>
				
            
        </form>

		<!-- <a href="/admin/laporan/laporan_cetak" class="btn btn-primary" target="_blank">CETAK PDF</a> -->
		<table class='table table-bordered'>
			<thead>
				<tr>
					<th>No</th>
					<th>Pemohon</th>
					<th>Alamat</th>
					<th>Permohonan</th>
					<th>Status</th>
					<th>Masuk</th>
					<th>Operator</th>
					<th>Selesai</th>
					<th>Lama</th>
					
					
				</tr>
			</thead>
			<tbody>
				@php $i=1 @endphp
				@foreach($data as $d)
				<tr>
					<td>{{ $i++ }}</td>
					<td>{{$d->permohonan_pemohon}}</td>
					<td>{{$d->permohonan_alamat}}</td>
					<td>{{$d->permohonan_jenis}}</td>
					<td>{{$d->permohonan_status}}</td>
					<td>{{date('d-m-Y H:i', strtotime($d->permohonan_masuk))}}</td>
					@if($d->permohonan_masuk_operator)
					<td>{{date('d-m-Y H:i', strtotime($d->permohonan_masuk_operator))}}</td>
					@else
					<td></td>
					@endif

					@if($d->permohonan_selesai)
					<td>{{date('d-m-Y H:i', strtotime($d->permohonan_selesai))}}</td>
					@else
					<td></td>
					@endif

					@if($d->permohonan_selesai)
						@if(\Carbon\Carbon::parse( $d->permohonan_masuk )->diffInDays( $d->permohonan_selesai) === 0)
						<td>1 hari</td>
						@else
						<td>{{\Carbon\Carbon::parse( $d->permohonan_masuk )->diffInDays( $d->permohonan_selesai )}} hari</td>
						@endif
					@else
					<td></td>
					@endif



				</tr>
				@endforeach
			</tbody>
		</table>

	</div>

</body>
</html>