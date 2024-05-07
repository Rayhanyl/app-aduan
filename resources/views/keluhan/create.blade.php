@extends('apps')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">PENGADUAN KELUHAN WARGA</h5>
                <p>Sampaikan Pengaduan dan Keluhan Anda kepada Dewan dengan mengisi formulir di bawah ini.</p>
                <div class="card">
                    <div class="card-body">
                        <form class="row" action="{{ route('store.complaiment') }}" method="post">
                            @csrf
                            <div class="col-12 col-lg-6 mb-3">
                                <label for="bidang" class="form-label">Bidang</label>
                                <select class="form-select" name="bidang" id="bidang">
                                    <option value="Pemerintahan dan Hukum">Pemerintahan dan Hukum</option>
                                    <option value="Perdagangan & Perindustrian">Perdagangan dan Perindustrian</option>
                                    <option value="Pembangunan">Pembangunan</option>
                                    <option value="Kesejahteraan Rakyat">Kesejaterahan Rakyat</option>
                                </select>
                            </div>
                            <div class="col-12 col-lg-6 mb-3">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap">
                            </div>
                            <div class="col-12 col-lg-6 mb-3">
                                <label for="alamat_lokasi_laporan" class="form-label">Alamat Lokasi Laporan</label>
                                <input type="text" class="form-control" name="alamat_lokasi_laporan"
                                    id="alamat_lokasi_laporan">
                            </div>
                            <div class="col-12 col-lg-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email">
                            </div>
                            <div class="col-12 col-lg-6 mb-3">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <select class="form-select" name="kecamatan" id="kecamatan">
                                    <option value="Andir">Andir</option>
                                    <option value="Buah Batu">Buah Batu</option>
                                    <option value="Cibiru">Cibiru</option>
                                    <option value="Gedebage">Gedebage</option>
                                    <option value="Kiaracondong">Kiaracondong</option>
                                    <option value="Lengkong">Lengkong</option>
                                    <option value="Mandalajati">Mandalajati</option>
                                    <option value="Panyileukan">Panyileukan</option>
                                    <option value="Rancasari">Rancasari</option>
                                    <option value="Sukajadi">Sukajadi</option>
                                    <option value="Ujung Berung">Ujung Berung</option>
                                </select>
                            </div>
                            <div class="col-12 col-lg-6 mb-3">
                                <label for="no_wa" class="form-label">No whatsApp</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">+62</span>
                                    <input type="number" class="form-control" name="no_wa" id="no_wa">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="uraian_keluhan" class="form-label">Uraian Keluhan</label>
                                <textarea class="form-control" name="uraian_keluhan" id="uraian_keluhan"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
