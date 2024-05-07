<div class="row g-3">
    <div class="col-12 col-lg-6">
        <label for="nomer_keluhan" class="form-label">Nomer Keluhan</label>
        <input type="text" class="form-control" id="nomer_keluhan" name="nomer_keluhan"
            value="{{ $data_info->data->nomor }}" readonly>
    </div>
    <div class="col-12 col-lg-6">
        <label for="waktu_dibuat" class="form-label">Waktu Dibuat</label>
        <input type="text" class="form-control" id="waktu_dibuat" name="waktu_dibuat"
            value="{{ $data_info->data->createdAt }}" readonly>
    </div>
    <div class="col-12 col-lg-4">
        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
            value="{{ $data_info->data->namaPelapor }}" readonly>
    </div>
    <div class="col-12 col-lg-4">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email"
            value="{{ $data_info->data->emailPelapor }}" readonly>
    </div>
    <div class="col-12 col-lg-4">
        <label for="no_wa" class="form-label">No WhatsApp</label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1">+62</span>
            <input type="number" class="form-control" name="no_wa" id="no_wa"
                value="{{ $data_info->data->waPelapor }}" readonly>
        </div>
    </div>
    <div class="col-12 col-lg-6">
        <label for="bidang" class="form-label">Bidang</label>
        <input type="text" class="form-control" id="bidang" name="bidang" value="{{ $data_info->data->bidang }}"
            readonly>
    </div>
    <div class="col-12 col-lg-6">
        <label for="lokasi" class="form-label">Lokasi</label>
        <input type="text" class="form-control" id="lokasi" name="lokasi"
            value="{{ $data_info->data->alamatKeluhan }} , {{ $data_info->data->namaKecamatan }}" readonly>
    </div>
    <div class="col-12">
        <label for="uraian_keluhan" class="form-label">Uraian Keluhan</label>
        <textarea class="form-control" name="uraian_keluhan" id="uraian_keluhan" readonly>{{ $data_info->data->uraianKeluhan }}</textarea>
    </div>
</div>
