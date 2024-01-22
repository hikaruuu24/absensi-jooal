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
<div class="container-fluid">
    <div class="checkout-tabs">
        <div class="row">
            <div class="col-xl-2 col-sm-3">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-absensi-tab" data-bs-toggle="pill" href="#v-pills-shipping"
                        role="tab" aria-controls="v-pills-shipping" aria-selected="true">
                        <i class="bx bx-dialpad-alt d-block check-nav-icon mt-4 mb-2"></i>
                        <p class="fw-bold mb-4">Absensi</p>
                    </a>
                    <a class="nav-link" id="v-laporan-aktifitas-tab" data-bs-toggle="pill" href="#v-pills-payment"
                        role="tab" aria-controls="v-pills-payment" aria-selected="false">
                        <i class="bx bxs-report d-block check-nav-icon mt-4 mb-2"></i>
                        <p class="fw-bold mb-4">Laporan Aktivitas</p>
                    </a>
                    <a class="nav-link d-none" id="v-rencana-aktifitas-tab" data-bs-toggle="pill" href="#v-pills-confir" role="tab"
                        aria-controls="v-pills-confir" aria-selected="false">
                        <i class="far fa-calendar-alt d-block check-nav-icon mt-4 mb-2"></i>
                        <p class="fw-bold mb-4">Rencana Aktifitas</p>
                    </a>
                </div>
            </div>
            <div class="col-xl-10 col-sm-9">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-shipping" role="tabpanel"
                                aria-labelledby="v-pills-shipping-tab">
                                <div>
                                    <h4 class="card-title">Absensi Pegawai</h4>
                                    <p class="card-title-desc">Isi informasi di bawah</p>
                                    @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{session('success')}}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @elseif(session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{session('error')}}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @endif
                                    @if (!$lastAbsensi)
                                        @php
                                            $status = false
                                        @endphp
                                        <div class="alert alert-danger" role="alert">
                                            Anda belum melakukan absen masuk dan keluar hari ini
                                        </div>
                                    @else
                                        @if ($lastAbsensi->tipe_absen1 != null && $lastAbsensi->tipe_absen2 != null)
                                        @php
                                            $status = true
                                        @endphp
                                        <div class="alert alert-success" role="alert">
                                            Anda sudah melakukan absen masuk dan keluar hari ini
                                        </div>
                                        @elseif($lastAbsensi->tipe_absen1 == 'masuk' && $lastAbsensi->tipe_absen2 == null)
                                        @php
                                            $status = false
                                        @endphp
                                            <div class="alert alert-success" role="alert">
                                                Anda sudah melakukan absen masuk hari ini
                                            </div>
                                            <div class="alert alert-warning" role="alert">
                                                Anda belum melakukan absen keluar hari ini
                                            </div>
                                        @endif
                                    @endif
                                    
                                    <form action="{{route('absensi.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div id="here-maps" class="form-group mb-3">
                                            <label for="" class="form-lokasi">Pin Lokasi</label>
                                            <div style="height: 21.5rem;" class="form-lokasi" id="mapContainer"></div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label for="billing-phone" class="col-md-2 col-form-label form-latitude">Latitude</label>
                                            <div class="col-md-10">
                                                <input type="number" readonly class="form-control form-latitude @error('latitude') is-invalid @enderror" id="latitude" name="latitude" step="any"
                                                    placeholder="Masukan latitude">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label for="billing-address"
                                                class="col-md-2 col-form-label form-longitude">Longitude</label>
                                            <div class="col-md-10">
                                                <input type="number" readonly class="form-control form-longitude @error('longitude') is-invalid @enderror" id="longitude" name="longitude" step="any"
                                                    placeholder="Masukan longitude">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label for="billing-name" class="col-md-2 col-form-label">Tipe Absen</label>
                                            <div class="col-md-10">
                                                <select class="form-select @error('tipe_absen') is-invalid @enderror" name="tipe_absen" id="tipe_absen" required>
                                                    <option disabled selected>--- Pilih Absensi ---</option>
                                                    @if (!$lastAbsensi)
                                                        <option value="masuk">Masuk</option>
                                                        <option disabled value="keluar">Keluar</option>
                                                    @else
                                                        @if ($lastAbsensi->tipe_absen1 != null && $lastAbsensi->tipe_absen2 == null)
                                                            <option disabled value="masuk">Masuk</option>
                                                            <option value="keluar">Keluar</option>
                                                        @endif
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label class="col-md-2 col-form-label form-foto">Upload Foto</label>
                                            <div class="col-md-10">
                                                <input type="file" class="form-control form-foto @error('foto') is-invalid @enderror" name="foto" id="foto">
                                            </div>
                                        </div>
                                        
                                        <div class="row mt-4">
                                            <div class="col-sm-6">
                                            </div> <!-- end col -->
                                            <div class="col-sm-6">
                                                <div class="text-end">
                                                    <button {{$status == true ? 'disabled' : ''}} type="submit" class="btn btn-success">
                                                        <i class="mdi mdi-content-save me-1"></i> Save Changes</button>
                                                </div>
                                            </div> <!-- end col -->
                                        </div> <!-- end row -->
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-payment" role="tabpanel"
                                aria-labelledby="v-pills-payment-tab">
                                <div>
                                    <h4 class="card-title">Laporan Aktivitas</h4>
                                    <p class="card-title-desc">Isi informasi di bawah</p>

                                    <form action="{{route('laporan-aktifitas.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="tanggal">Tanggal</label>
                                                    <input id="tanggal" name="tanggal" type="date"
                                                        value="{{date('Y-m-d')}}" class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nama_perusahaan">Nama Restoran</label>
                                                    <input id="nama_perusahaan" name="nama_perusahaan" type="text"
                                                        class="form-control" placeholder="Nama Restoran">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="no_hp">Nomor HP</label>
                                                    <input id="no_hp" name="nomor_hp" type="number" class="form-control"
                                                        placeholder="Nomor HP">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email">Email</label>
                                                    <input id="email" name="email" type="email" class="form-control"
                                                        placeholder="Email">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="source_hunting">Source Hunting</label>
                                                    <input id="source_hunting" name="source_hunting" type="text"
                                                        class="form-control" placeholder="Source Hunting">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label class="control-label">Whatsapp</label>

                                                    <select class="form-select" name="whatsapp">
                                                        <option value="ada">Ada</option>
                                                        <option value="tidak ada">Tidak ada</option>
                                                    </select>

                                                </div>
                                                <div class="mb-3">
                                                    <label for="respon">Respon</label>
                                                    <input id="respon" name="respon" type="text"
                                                        class="form-control" placeholder="Respon">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="kebutuhan">Kebutuhan</label>
                                                    <textarea class="form-control" id="kebutuhan" name="kebutuhan" rows="5"
                                                        placeholder="Kebutuhan"></textarea>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-sm-6">
                                            </div> <!-- end col -->
                                            <div class="col-sm-6">
                                                <div class="text-end">
                                                    <button type="submit" class="btn btn-success">
                                                        <i class="mdi mdi-content-save me-1"></i> Save Changes</button>
                                                </div>
                                            </div> <!-- end col -->
                                        </div> <!-- end row -->
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-confir" role="tabpanel"
                                aria-labelledby="v-pills-confir-tab">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#all-order" role="tab">
                                Status Absensi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#processing" role="tab">
                                Laporan Aktivitas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{(Auth::user()->getRoleNames()[0] != 'Admin') ? 'd-none' : ''}}" data-bs-toggle="tab" href="#list-absen" role="tab">
                                Daftar Absensi Semua Pegawai
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{(Auth::user()->getRoleNames()[0] != 'Admin') ? 'd-none' : ''}}" data-bs-toggle="tab" href="#list-laporan-aktivitas" role="tab">
                                Laporan Aktivitas Semua Pegawai
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-3">
                        <div class="tab-pane" id="processing" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mt-4">
                                        <div class="table-responsive">
                                            <table id="HistoryTable" class="table table-hover dt-responsive nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Tanggal</th>
                                                        <th>Nama Restoran</th>
                                                        <th>Nomor HP</th>
                                                        <th>Email</th>
                                                        <th>Src. Hunting</th>
                                                        <th>Whatsapp</th>
                                                        <th>Respon</th>
                                                        <th>Kebutuhan</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($laporan_aktifitas as $data)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{date('Y-m-d', strtotime($data->tanggal))}}</td>
                                                            <td>{{$data->nama_perusahaan}}</td>
                                                            <td>{{$data->nomor_hp}}</td>
                                                            <td>{{$data->email}}</td>
                                                            <td>{{$data->source_hunting}}</td>
                                                            <td>{{$data->whatsapp}}</td>
                                                            <td>{{$data->respon}}</td>
                                                            <td>{{$data->kebutuhan}}</td>
                                                            <td>
                                                                <a href="javascript:void(0);" onclick="showModal({{$data->id}})" class="btn btn-warning btn-sm">Edit</a>
                                                                @if (auth()->user()->can('laporan-aktifitas-delete'))
                                                                    <a href="javascript:void(0);" class="btn btn-danger btn-sm" onclick="modalDelete('Laporan Aktifitas', '{{ $data->nama_perusahaan }}', 'laporan-aktifitas/' + {{ $data->id }}, '/absensi/')">Delete</a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @include('absensi.edit_laporan_aktifitas')
                                                    @endforeach
                                                    
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane active" id="all-order" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mt-4">
                                        <div class="table-responsive">
                                            <table id="departementTable" class="table table-hover dt-responsive nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama</th>
                                                        <th>Tanggal</th>
                                                        <th>Jam Masuk</th>
                                                        <th>Jam Keluar</th>
                                                        <th>Latitude</th>
                                                        <th>Longitude</th>
                                                        <th>Foto</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @foreach ($absensi as $data)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{auth()->user()->name}}</td>
                                                        <td>{{date('Y-m-d', strtotime($data->tanggal))}}</td>
                                                        <td>{{$data->jam_masuk}}</td>
                                                        <td>{{$data->jam_keluar}}</td>
                                                        <td>{{$data->latitude}}</td>
                                                        <td>{{$data->longitude}}</td>
                                                        <td><img src="{{asset('images/'. $data->foto)}}" class="img-fluid" style="max-width: 80px" alt=""></td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="list-absen" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mt-4">
                                        <div class="table-responsive">
                                            <table id="daftarAbsensi" class="table table-hover dt-responsive nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama</th>
                                                        <th>Tanggal</th>
                                                        <th>Jam Masuk</th>
                                                        <th>Jam Keluar</th>
                                                        <th>Latitude</th>
                                                        <th>Longitude</th>
                                                        <th>Foto</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @foreach ($absensi_all as $data)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$data->user->name}}</td>
                                                        <td>{{date('Y-m-d', strtotime($data->tanggal))}}</td>
                                                        <td>{{$data->jam_masuk}}</td>
                                                        <td>{{$data->jam_keluar}}</td>
                                                        <td>{{$data->latitude}}</td>
                                                        <td>{{$data->longitude}}</td>
                                                        <td><img src="{{asset('images/'. $data->foto)}}" class="img-fluid" style="max-width: 80px" alt=""></td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="list-laporan-aktivitas" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mt-4">
                                        <div class="table-responsive">
                                            <table id="daftarAktivitas" class="table table-hover dt-responsive nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Tanggal</th>
                                                        <th>Nama Pegawai</th>
                                                        <th>Nama Restoran</th>
                                                        <th>Nomor HP</th>
                                                        <th>Email</th>
                                                        <th>Src. Hunting</th>
                                                        <th>Whatsapp</th>
                                                        <th>Respon</th>
                                                        <th>Kebutuhan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($laporan_aktifitas_all as $data)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{date('Y-m-d', strtotime($data->tanggal))}}</td>
                                                            <td>{{$data->user->name}}</td>
                                                            <td>{{$data->nama_perusahaan}}</td>
                                                            <td>{{$data->nomor_hp}}</td>
                                                            <td>{{$data->email}}</td>
                                                            <td>{{$data->source_hunting}}</td>
                                                            <td>{{$data->whatsapp}}</td>
                                                            <td>{{$data->respon}}</td>
                                                            <td>{{$data->kebutuhan}}</td>
                                                        </tr>
                                                    @endforeach
                                                    
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div> <!-- container-fluid -->


<!-- Modal -->

@endsection

@section('script')
<script>
    window.action = "submit"
    window.hereApiKey = "{{ env('HERE_API_KEY') }}"

</script>
<script src="{{ asset('js/here.js') }}"></script>
<script>
    function showModal(id) {
        $('#exampleModalScrollable_' + id).modal('show')
    }

    $('#tipe_absen').change(function () {
        if ($(this).val() == 'keluar') {
            $('.form-lokasi').addClass('d-none')
            $('.form-foto').addClass('d-none')
            $('.form-latitude').addClass('d-none')
            $('.form-longitude').addClass('d-none')
        }
    })

    $('#v-absensi-tab').click(function () {
        $('.nav-link').removeClass('active');
        $('.tab-pane').removeClass('active');

        $('#v-laporan-aktifitas-tab').attr('aria-selected', false);
        $('#v-laporan-aktifitas-tab').removeClass('active');
        $('#v-absensi-tab').attr('aria-selected', true);
        $('#v-absensi-tab').addClass('active');

        $('#all-order').addClass('active')
        $('.nav-link[href="#all-order"]').addClass('active');
    })

    $('#v-laporan-aktifitas-tab').click(function () {
        $('.nav-link').removeClass('active');
        $('.tab-pane').removeClass('active');

        $('#v-absensi-tab').attr('aria-selected', false);
        $('#v-absensi-tab').removeClass('active');
        $('#v-laporan-aktifitas-tab').attr('aria-selected', true);
        $('#v-laporan-aktifitas-tab').addClass('active');

        $('#processing').addClass('active')
        $('.nav-link[href="#processing"]').addClass('active');
    })

</script>

@endsection
