@extends('layouts.admin')

@section('title', 'Laporan')

@section('content')
<div class="card">
    <div class="card-header">Laporan</div>
        <form action="{{ url('/admin/laporanPage') }}" method="POST">
            @csrf
            <div class="card-body">
                <!-- <div class="form-row">
                    <div class="form-group col-12 col-sm-12 col-md-12 col-lg-6 col-xl-5">
                        <label for="level">Bulan</label>
                        <div class="input-group">
                            <select class="form-control dynamic" name="bulan" id="bulan" data-dependent="diteruskan">
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                            </select>
                        </div>
                        <p class="text-danger">{{ $errors->first('bulan') }}</p>
                    </div>
                </div> -->
                <!-- <div class="form-row">
                    <div class="form-group col-12 col-sm-12 col-md-12 col-lg-6 col-xl-5">
                        <label for="kontak">Tahun</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-phone"></i>
                                </span>
                            </div>
                            <input class="form-control" type="number" id="tahun" name="tahun"/>
                        </div>
                        <p class="text-danger">{{ $errors->first('tahun') }}</p>
                    </div>
                </div> -->
                <div class="form-row">
                    <div class="form-group col-12 col-sm-12 col-md-12 col-lg-6 col-xl-5">
                        <label for="kontak">Mulai</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-calendar"></i>
                                </span>
                            </div>
                            <input class="datepicker form-control" type="text" id="mulai" name="mulai"/>
                        </div>
                        <p class="text-danger">{{ $errors->first('mulai') }}</p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12 col-sm-12 col-md-12 col-lg-6 col-xl-5">
                        <label for="kontak">Akhir</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-calendar"></i>
                                </span>
                            </div>
                            <input class="datepicker form-control" type="text" id="akhir" name="akhir"/>
                        </div>
                        <p class="text-danger">{{ $errors->first('akhir') }}</p>
                    </div>
                </div>

                
  
                        <script type="text/javascript">
                        $.fn.datepicker.dates['en'] = {
                            days: ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"],
                            daysShort: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
                            daysMin: ["Mi", "Se", "Se", "Ra", "Ka", "Ju", "Sa"],
                            months: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
                            monthsShort: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
                            today: "Today",
                            clear: "Clear",
                            format: "mm/dd/yyyy",
                            titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
                            weekStart: 0
                        };
                        
                            $('.datepicker').datepicker({
                                format: 'dd-mm-yyyy'
                            });
                            $( document ).ready(function() {
                                $('input').attr('autocomplete','off');
                            });
                        </script> 
                
                
            </div>
            <div class="card-footer">
                <button class="btn btn-primary">
                    <i class="fas fa-angle-double-right"></i>
                    <span>Selanjutnya</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection