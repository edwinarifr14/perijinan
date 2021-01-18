<!DOCTYPE html>
<html>
<head>
	<title>Laporan Permohonan</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 7pt;
		}
	</style>
	<center>
		<h5>Laporan Permohonan</h4>
	</center>

	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Pemohon</th>
				<th>Alamat</th>
				<th>Permohonan</th>
				<th>Proses</th>
				<th>Status</th>
				<th>Masuk</th>
				<th>Operator</th>
				<th>Selesai</th>
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
				<td>{{$d->permohonan_diteruskan}}</td>
				<td>{{$d->permohonan_status}}</td>
				<td>{{$d->permohonan_masuk}}</td>
				<td>{{$d->permohonan_masuk_operator}}</td>
				<td>{{$d->permohonan_selesai}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>

</body>
</html>