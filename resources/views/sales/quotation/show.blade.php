@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h4 class="page-title">Quotation</h4>
        @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="quotation">Quotation</label>
                            <input disabled id="quotation" name="no_quotation" type="text" class="form-control"
                                value="{{ $quotation->no_quotation }}" placeholder="Quotation">
                        </div>
                        <div class="mb-3">
                            <label for="customer">Customer</label>
                            <input disabled id="customer" name="customer" type="text" class="form-control"
                                value="{{ $quotation->customer }}" placeholder="Customer">
                        </div>
                        <div class="mb-3">
                            <label for="alamat">Alamat</label>
                            <textarea disabled class="form-control" name="alamat"
                                id="alamat">{{$quotation->alamat}}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="no_telepon">No. Telp</label>
                            <input disabled id="no_telepon" name="no_telepon" type="text" class="form-control"
                                value="{{ $quotation->no_telepon }}" placeholder="No. Telp">
                        </div>
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input disabled id="email" name="email" type="email" class="form-control"
                                placeholder="Email" value="{{$quotation->email}}">
                        </div>
                        <div class="mb-3">
                            <label for="atas_nama">Notes</label>
                            <textarea disabled class="form-control" name="notes"
                                id="notes">{{$quotation->notes}}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive mt-3">
                            <table class="table table-hover datatable dt-responsive nowrap" id="detailQuotation"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th scope="col">No. </th>
                                        <th scope="col">Item</th>
                                        <th scope="col">Amount (Rp)</th>
                                        <th scope="col">Markup (%)</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Action</th>
                                    </tr>

                                </thead>

                                <tbody>
                                    @foreach ($detailQuotations as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->item}}</td>
                                            <td>{{$item->amount}}</td>
                                            <td>{{$item->markup}}%</td>
                                            <td>{{$item->description}}</td>
                                            <td>
                                                <a href="javascript:void(0)" onclick="modalDelete('Detail Quotation', '{{$item->item}}', '{{route('detail-quotation.destroy', $item->id)}}', '{{route('quotation.show', $quotation->id)}}')" class="btn btn-danger">Hapus</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="row mt-4">
                    <div class="col-sm-6">
                    </div> <!-- end col -->
                    <div class="col-sm-6">
                        <div class="text-end">
                            <a href="javascript:void(0);" onclick="modalDetailQuotation()" class="btn btn-success">Tambah Item</a>
                            <a href="{{route('generate-pdf-quotation', $quotation->id)}}" target="__blank" class="btn btn-danger">Generate PDF</a>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div>
        </div>
    </div>
</div>

@include('sales.quotation.detail-quotation')
@endsection

@section('script')
<script>
    function modalDetailQuotation() {
        $('#modal_detail_quotation').modal('show');
    }

    function submitDetailQuotation() {
        let item = $('#item').val();
        let amount = $('#amount').val();
        let description = $('#description').val();
        let markup = $('#markup').val();

        // post
        $.ajax({
            url: "{{route('detail-quotation')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "item": item,
                "amount": amount,
                "description": description,
                "markup": markup,
                "quotation_id": "{{$quotation->id}}"
            },
            success: function (data) {
                $('#modal_detail_quotation').modal('hide');
                location.reload();
            }
        });
        
    }
</script>
@endsection
