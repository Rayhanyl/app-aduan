<form class="row g-3" action="{{ route('approval.status.complaiment') }}" method="post">
    @csrf
    <input type="hidden" name="id" id="id" value="{{ $detail_keluhan->data->id }}">
    <div class="col-12 col-lg-6">
        <label for="nomer_keluhan" class="form-label">Nomer Keluhan</label>
        <input type="text" class="form-control" id="nomer_keluhan" name="nomer_keluhan"
            value="{{ $detail_keluhan->data->nomor }}" readonly>
    </div>
    <div class="col-12 col-lg-6">
        <label for="waktu_dibuat" class="form-label">Waktu Dibuat</label>
        <input type="text" class="form-control" id="waktu_dibuat" name="waktu_dibuat"
            value="{{ $detail_keluhan->data->createdAt }}" readonly>
    </div>
    <div class="col-12 col-lg-4">
        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
            value="{{ $detail_keluhan->data->namaPelapor }}" readonly>
    </div>
    <div class="col-12 col-lg-4">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email"
            value="{{ $detail_keluhan->data->emailPelapor }}" readonly>
    </div>
    <div class="col-12 col-lg-4">
        <label for="no_wa" class="form-label">No WhatsApp</label>
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1">+62</span>
            <input type="number" class="form-control" name="no_wa" id="no_wa"
                value="{{ $detail_keluhan->data->waPelapor }}" readonly>
        </div>
    </div>
    <div class="col-12 col-lg-6">
        <label for="bidang" class="form-label">Bidang</label>
        <input type="text" class="form-control" id="bidang" name="bidang"
            value="{{ $detail_keluhan->data->bidang }}" readonly>
    </div>
    <div class="col-12 col-lg-6">
        <label for="lokasi" class="form-label">Lokasi</label>
        <input type="text" class="form-control" id="lokasi" name="lokasi"
            value="{{ $detail_keluhan->data->alamatKeluhan }} , {{ $detail_keluhan->data->namaKecamatan }}" readonly>
    </div>
    <div class="col-12">
        <label for="uraian_keluhan" class="form-label">Uraian Keluhan</label>
        <textarea class="form-control" name="uraian_keluhan" id="uraian_keluhan" rows="5" readonly>{{ $detail_keluhan->data->uraianKeluhan }}</textarea>
    </div>
    <div class="col-12">
        <label for="status" class="form-label">Status Approval</label>
        <select class="form-select" name="status" id="status">
            <option value="OPEN">Open</option>
            <option value="INPROGRESS">Inprogress</option>
            <option value="REJECT">Reject</option>
            <option value="DONE">Done</option>
        </select>
    </div>
    <div class="col-12 d-grid gap-2">
        <button type="submit" class="btn btn-primary" type="button">submit</button>
    </div>
</form>
