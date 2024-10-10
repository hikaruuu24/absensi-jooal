<!-- Scrollable modal -->
<div class="modal fade" id="exampleModalScrollable_{{$data->id}}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Ubah data {{$data->nama_perusahaan}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('laporan-aktifitas.update', $data->id)}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="tanggal">Tanggal</label>
                                <input id="tanggal" name="tanggal" type="date" value="{{date('Y-m-d', strtotime($data->tanggal))}}"
                                    class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="nama_perusahaan">Nama Restoran</label>
                                <input id="nama_perusahaan" name="nama_perusahaan" type="text" class="form-control" value="{{$data->nama_perusahaan}}"
                                    placeholder="Nama Restoran">
                            </div>
                            <div class="mb-3">
                                <label for="no_hp">Nomor HP</label>
                                <input id="no_hp" name="nomor_hp" type="number" class="form-control" value="{{$data->nomor_hp}}"
                                    placeholder="Nomor HP">
                            </div>
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input id="email" name="email" type="email" class="form-control" placeholder="Email" value="{{$data->email}}">
                            </div>
                            <div class="mb-3">
                                <label for="source_hunting">Source Hunting</label>
                                <input id="source_hunting" name="source_hunting" type="text" class="form-control" value="{{$data->source_hunting}}"
                                    placeholder="Source Hunting">
                            </div>
                            <div class="mb-3">
                                <label class="control-label">Whatsapp</label>
                                <select class="form-select" name="whatsapp">
                                    <option {{$data->whatsapp == 'ada' ? 'selected' : ''}} value="ada">Ada</option>
                                    <option {{$data->whatsapp == 'tidak ada' ? 'selected' : ''}} value="tidak ada">Tidak ada</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="respon">Respon</label>
                                <input id="respon" name="respon" type="text" class="form-control" value="{{$data->respon}}"
                                    placeholder="Respon">
                            </div>
                            <div class="mb-3">
                                <label for="kebutuhan">Kebutuhan</label>
                                <textarea class="form-control" id="kebutuhan" name="kebutuhan" rows="5" 
                                    placeholder="Kebutuhan">{{$data->kebutuhan}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
