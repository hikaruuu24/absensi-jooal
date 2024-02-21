<!-- Scrollable modal -->
<div class="modal fade" id="modal_detail_quotation" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Tambah Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" id="quotation_id" name="quotation_id" value="{{$quotation->id}}">
                        <div class="mb-3">
                            <label for="item">Item</label>
                            <input id="item" name="item" type="text" class="form-control" placeholder="Item">
                        </div>
                        <div class="mb-3">
                            <label for="amount">Amount</label>
                            <input id="amount" name="amount" type="text" class="form-control" placeholder="Amount">
                        </div>
                        <div class="mb-3">
                            <label for="markup">Markup</label>
                            <div class="input-group">
                                <div class="input-group-text">%</div>
                                <input type="number" class="form-control" id="markup" name="markup" value="0">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" id="description" cols="30"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" onclick="submitDetailQuotation()">Add</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
