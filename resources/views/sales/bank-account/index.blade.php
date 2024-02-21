@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-6">
        <h4 class="page-title">Bank Account</h4>
        <div class="card">
            <div class="card-body">
                <form action="{{route('bank-account.update', $bank->id)}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_bank">Nama Bank</label>
                        <input id="nama_bank" name="nama_bank" type="text" class="form-control" placeholder="Nama Bank" value="{{$bank->nama_bank}}">
                    </div>
                    <div class="mb-3">
                        <label for="no_rekening">Nomor Rekening</label>
                        <input id="no_rekening" name="no_rekening" type="text" class="form-control" value="{{$bank->no_rekening}}"
                            placeholder="Nomor Rekening">
                    </div>
                    <div class="mb-3">
                        <label for="atas_nama">Atas Nama</label>
                        <input id="atas_nama" name="atas_nama" type="text" class="form-control" value="{{$bank->atas_nama}}"
                            placeholder="Atas nama">
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
    </div>
</div>

@endsection
```
