@extends('apps')
@section('content')
    <div class="container-fluid">
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">REKAM DATA KECAMATAN</h5>
                        <p>Menambah data baru kecamatan.</p>
                        <div class="card">
                            <div class="card-body">
                                <form class="row" action="{{ route ('store.wilayah') }}" method="POST">
                                    @csrf
                                    <div class="col-12 col-lg-6 mb-3">
                                        <label for="nama_kecamatan" class="form-label">Nama Kecamatan</label>
                                        <input type="text" class="form-control" name="nama_kecamatan"
                                            id="nama_kecamatan">
                                    </div>
                                    <div class="col-12 col-lg-6 mb-3">
                                        <label for="kode_pos" class="form-label">Kode Pos</label>
                                        <input type="text" class="form-control" name="kode_pos" id="kode_pos">
                                    </div>
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary w-5-">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
