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
                <!-- Tab panes -->
                <div class="row">
                    <div class="col-lg-6"></div>
                    <div class="col-lg-6">
                        <div class="text-end">
                            <a href="{{route('quotation.create')}}" class="btn btn-primary">Tambah data</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table table-hover datatable dt-responsive nowrap" id="laporanAktivitas"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th scope="col">No. </th>
                                <th scope="col">Quotation</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Nomor Telepon</th>
                                <th scope="col">Email</th>
                                <th scope="col">Action</th>
                            </tr>

                        </thead>

                        <tbody>
                            @foreach ($quotations as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->no_quotation}}</td>
                                    <td>{{$item->customer}}</td>
                                    <td>{{$item->alamat}}</td>
                                    <td>{{$item->no_telepon}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>
                                        <a href="{{route('quotation.show', $item->id)}}" class="btn btn-info">Detail</a>
                                        <a href="{{route('quotation.edit', $item->id)}}" class="btn btn-warning">Edit</a>
                                        <a href="javascript:void(0)" onclick="modalDelete('Quotation', '{{$item->no_quotation}}', '{{route('quotation.destroy', $item->id)}}', '{{route('quotation.index')}}')" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script>
</script>
@endsection
