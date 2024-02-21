@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h4 class="page-title">Quotation</h4>
        <div class="card">
            <div class="card-body">
                <form action="{{route('quotation.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="quotation">Quotation</label>
                                <input id="quotation" name="no_quotation" type="text" class="form-control" readonly
                                    placeholder="Auto Generate">
                            </div>
                            <div class="mb-3">
                                <label for="customer">Customer</label>
                                <input id="customer" name="customer" type="text" class="form-control"
                                    placeholder="Customer">
                            </div>
                            <div class="mb-3">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control" name="alamat" id="alamat"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="alamat">Produk</label>
                                <select class="form-select" name="produk" id="">
                                    <option value="POS &A">POS &A</option>
                                    <option value="Website">Website</option>
                                    <option value="Media Release">Media Release</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="no_telepon">No. Telp</label>
                                <input id="no_telepon" name="no_telepon" type="text" class="form-control"
                                    placeholder="No. Telp">
                            </div>
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input id="email" name="email" type="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="mb-3">
                                <label for="atas_nama">Notes</label>
                                <textarea class="form-control" rows="6" name="notes" id="notes"></textarea>
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
    </div>
</div>

@endsection
```
