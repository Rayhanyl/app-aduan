@extends('apps')
@section('content')
    <div class="container-fluid">
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">REKAM DATA KEPENDUDUKAN</h5>
                        <p>Menambah data baru warga.</p>
                        <div class="card">
                            <div class="card-body">
                                <form class="row g-3" action="{{ route('store.penduduk') }}" method="POST">
                                    @csrf
                                    <div class="col-12 col-lg-8">
                                        <label for="nik" class="form-label">NIK</label>
                                        <input type="text" class="form-control" name="nik" id="nik"
                                            value="">
                                    </div>
                                    <div class="col-12 col-lg-4 p-4">
                                        <button type="button" class="btn btn-primary" id="generateNumber">Generate
                                            Number</button>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <label for="nama_penduduk" class="form-label">Nama</label>
                                        <input type="text" class="form-control" name="nama_penduduk" id="nama_penduduk">
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                        <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir">
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir">
                                    </div>
                                    <div class="col-12 col-lg-3">
                                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                        <select class="form-select" name="jenis_kelamin" id="jenis_kelamin">
                                            <option value="Laki-laki">
                                                Laki-laki</option>
                                            <option value="Perempuan">
                                                Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-select" name="status" id="status">
                                            <option value="Kawin">
                                                Kawin</option>
                                            <option value="Belum kawin">
                                                Belum Kawin</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-3">
                                        <label for="agama" class="form-label">Agama</label>
                                        <select class="form-select" name="agama" id="agama">
                                            <option value="Islam">
                                                Islam</option>
                                            <option value="Kristen">
                                                Kristen</option>
                                            <option value="Katholik">
                                                Katholik</option>
                                            <option value="Hindu">
                                                Hindu</option>
                                            <option value="Budha">
                                                Budha</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-3">
                                        <label for="gol_darah" class="form-label">Golongan Darah</label>
                                        <select class="form-select" name="gol_darah" id="gol_darah">
                                            <option value="A">
                                                A</option>
                                            <option value="B">
                                                B</option>
                                            <option value="AB">
                                                AB</option>
                                            <option value="O">
                                                O</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                        <input type="text" class="form-control" name="pekerjaan" id="pekerjaan">
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" id="email">
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <label for="no_wa" class="form-label">No WhatsApp</label>
                                        <input type="number" class="form-control" name="no_wa" id="no_wa">
                                    </div>
                                    <div class="col-12">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <textarea class="form-control" name="alamat" id="alamat"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                $("#generateNumber").click(function() {
                    var number = "";
                    for (var i = 0; i < 16; i++) {
                        number += Math.floor(Math.random() * 10);
                    }
                    $("#nik").val(number);
                });
            });
        </script>
    @endpush
@endsection
