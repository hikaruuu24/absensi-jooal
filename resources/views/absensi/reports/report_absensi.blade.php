@extends('layouts.app')

@section('breadcumb')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">{{ ($breadcumb ?? '') }}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">home</li>
                    <li class="breadcrumb-item">/</li>
                    <li class="breadcrumb-item active"><a
                            href="{{ route('dashboard.index') }}">{{ ($breadcumb ?? '') }}</a></li>
                </ol>
            </div>

        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('laporan-absensi.index')}}">
                            Laporan Absensi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('laporan-aktivitas.index')}}">
                            Laporan Aktivitas
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content p-3">
                    <div class="tab-pane active" id="all-order" role="tabpanel">
                            <div class="row">
                                <div class="col-xl col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Periode :</label>
                                        <select class="form-select" id="datepicker-select">
                                            <option value="tanggal">Tanggal</option>
                                            <option value="bulan">Bulan</option>
                                            <option value="tahun">Tahun</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl col-sm-6">
                                    <div class="mb-3 select-tanggal">
                                        <label class="form-label">Tanggal :</label>
                                        <input type="text" class="form-control" id="datepicker-tanggal" autocomplete="off" 
                                            placeholder="Pilih tanggal" data-date-format="dd M, yyyy"
                                            data-date-orientation="bottom auto" data-provide="datepicker" value="{{ date('d M, Y') }}"
                                            data-date-autoclose="true">
                                    </div>
                                    <div class="mb-3 select-bulan d-none" >
                                        <label class="form-label">Bulan :</label>
                                        <div class="position-relative" id="datepicker4">
                                            <input type="text" class="form-control" id="datepicker-bulan" data-date-container='#datepicker4' 
                                                data-provide="datepicker" data-date-format="MM yyyy" placeholder="Pilih bulan" value="{{ date('M Y') }}"
                                                data-date-min-view-mode="1">
                                        </div>
                                    </div>
                                    <div class="mb-3 select-tahun d-none">
                                        <label class="form-label">Tahun :</label>
                                        <div class="position-relative" id="datepicker5">
                                            <input type="text" class="form-control" id="datepicker-tahun" data-provide="datepicker" 
                                                data-date-container='#datepicker5' data-date-format="yyyy" placeholder="Pilih tahun" value="{{ date('Y') }}"
                                                data-date-min-view-mode="2">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Pegawai :</label>
                                        <select class="form-select" id="pegawai">
                                            <option disabled selected>Pilih Pegawai</option>
                                            @foreach ($users as $data)
                                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xl col-sm-3 align-self-end">
                                    <div class="mb-3">
                                        <button onclick="generateReport()" class="btn btn-primary w-md">Generate</button>
                                    </div>
                                </div>
                            </div>

                        <div class="table-responsive mt-2">
                            <table class="table table-hover datatable dt-responsive nowrap" id="laporanAbsensi"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th scope="col">No. </th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Jam Masuk</th>
                                        <th scope="col">Jam Keluar</th>
                                        <th scope="col">Latitude</th>
                                        <th scope="col">Longitude</th>
                                        <th scope="col">Foto</th>
                                    </tr>

                                </thead>

                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script>
    function generateReport() {
        var datepickerSelect = $('#datepicker-select').val();
        var pegawai = $('#pegawai').val();
        var date;
        if (datepickerSelect == 'tanggal') {
            date = $('#datepicker-tanggal').val();
        } else if (datepickerSelect == 'bulan') {   
            date = $('#datepicker-bulan').val();
        } else if (datepickerSelect == 'tahun') {
            date = $('#datepicker-tahun').val();
        }

        //axios get data with swal
        axios.get('/generate-laporan-absensi', {
            params: {
                date: date,
                datepickerSelect: datepickerSelect,
                pegawai: pegawai
            }
        })
        .then(function (response) {

            var table = $('#laporanAbsensi').DataTable();
            table.clear().draw();
            response.data.data.forEach(element => {
                table.row.add([
                    // nomor
                    table.rows().count() + 1,
                    element.tanggal,
                    element.nama,
                    element.jam_masuk,
                    element.jam_keluar,
                    element.latitude,
                    element.longitude,
                    '<img src="images/'+element.foto+'" width="100px" height="100px">'
                ]).draw();
            });

            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Laporan berhasil di generate',
                showConfirmButton: false,
                timer: 1500
            })
        })
        .catch(function (error) {
            console.log(error);
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Laporan gagal di generate',
                showConfirmButton: false,
                timer: 1500
            })
        });


    }

$('#datepicker-select').on('change', function() {
    if (this.value == 'tanggal') {
        $('.select-tanggal').removeClass('d-none');
        $('.select-bulan').addClass('d-none');
        $('.select-tahun').addClass('d-none');
    } else if (this.value == 'bulan') {
        $('.select-tanggal').addClass('d-none');
        $('.select-bulan').removeClass('d-none');
        $('.select-tahun').addClass('d-none');
    } else if (this.value == 'tahun') {
        $('.select-tanggal').addClass('d-none');
        $('.select-bulan').addClass('d-none');
        $('.select-tahun').removeClass('d-none');
    }
});
</script>
@endsection
