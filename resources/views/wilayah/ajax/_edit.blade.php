<form class="row" action="{{ route('update.wilayah') }}" method="POST">
    @csrf
    <input type="hidden" name="id_kecamatan" id="id_kecamatan" value="{{ $data_kecamatan->data->id }}">
    <div class="col-12 col-lg-6 mb-3">
        <label for="nama_kecamatan" class="form-label">Nama Kecamatan</label>
        <input type="text" class="form-control" name="nama_kecamatan" id="nama_kecamatan"
            value="{{ $data_kecamatan->data->nama }}">
    </div>
    <div class="col-12 col-lg-6 mb-3">
        <label for="kode_pos" class="form-label">Kode Pos</label>
        <input type="text" class="form-control" name="kode_pos" id="kode_pos"
            value="{{ $data_kecamatan->data->kodePos }}">
    </div>
    <div class="col-6">
        <button type="submit" class="btn btn-primary w-5-">Edit Wilayah</button>
    </div>
</form>
