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
                            <div class="col-12 col-lg-6">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="bidang" class="form-label">Bidang</label>
                                        <select class="form-select" name="bidang" id="bidang">
                                            <option value="Pemerintahan dan Hukum">Pemerintahan dan Hukum</option>
                                            <option value="Perdagangan & Perindustrian">Perdagangan dan Perindustrian
                                            </option>
                                            <option value="Pembangunan">Pembangunan</option>
                                            <option value="Kesejahteraan Rakyat">Kesejaterahan Rakyat</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label for="kecamatan" class="form-label">Kecamatan</label>
                                        <select class="form-select" name="kecamatan" id="kecamatan">
                                            @foreach ($kecamatan->data as $item)
                                                <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label for="alamat_lokasi_laporan" class="form-label">Alamat Lokasi Laporan</label>
                                        <input type="text" class="form-control" name="alamat_lokasi_laporan"
                                            id="alamat_lokasi_laporan">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="row g-3">
                                    <div class="col-12 col-lg-7">
                                        <label for="nik" class="form-label">NIK</label>
                                        <input type="number" class="form-control" name="nik" id="nik">
                                    </div>
                                    <div class="col-12 col-lg-5" style="padding-top:30px;">
                                        <button type="button" class="btn btn-primary" id="validasi-nik">Validasi
                                            NIK</button>
                                    </div>
                                    <div class="col-12">
                                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap"
                                            readonly>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" readonly>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="no_wa" class="form-label">No whatsApp</label>
                                        <input type="number" class="form-control" name="no_wa" id="no_wa" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="col-12 mb-3">
                                    <label for="uraian_keluhan" class="form-label">Uraian Keluhan</label>
                                    <textarea class="form-control" name="uraian_keluhan" id="uraian_keluhan"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $("#validasi-nik").click(function() {
                    var idPenduduk = $('#nik').val();
                    $.ajax({
                        type: "GET",
                        url: "{{ route('ajax.get.data.penduduk') }}",
                        dataType: 'html',
                        data: {
                            _token: "{{ csrf_token() }}",
                            id_penduduk: idPenduduk,
                        },
                        beforeSend: function() {
                            // 
                        },
                        success: function(data) {
                            var penduduk = JSON.parse(data)
                            $("#nama_lengkap").val(penduduk.data.nama);
                            $("#email").val(penduduk.data.email);
                            $("#no_wa").val(penduduk.data.noWa);
                        },
                        complete: function() {
                            // 
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            // 
                        },
                    });
                });
            });
        </script>
    @endpush
@endsection
