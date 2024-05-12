<form class="row g-3" action="{{ route ('update.penduduk') }}" method="POST">
    @csrf
    <div class="col-12 col-lg-6">
        <label for="nik" class="form-label">NIK</label>
        <input type="text" class="form-control" name="nik" id="nik" value="{{ $data_penduduk->data->nik }}"
            readonly>
    </div>
    <div class="col-12 col-lg-6">
        <label for="nama_penduduk" class="form-label">Nama</label>
        <input type="text" class="form-control" name="nama_penduduk" id="nama_penduduk"
            value="{{ $data_penduduk->data->nama }}">
    </div>
    <div class="col-12 col-lg-4">
        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
        <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir"
            value="{{ $data_penduduk->data->tempatLahir }}">
    </div>
    <div class="col-12 col-lg-4">
        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
        <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir"
            value="{{ $data_penduduk->data->tanggalLahir }}">
    </div>
    <div class="col-12 col-lg-4">
        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
        <select class="form-select" name="jenis_kelamin" id="jenis_kelamin">
            <option value="Laki-laki" {{ $data_penduduk->data->jenisKelamin == 'Laki-laki' ? 'selected' : '' }}>
                Laki-laki</option>
            <option value="Perempuan" {{ $data_penduduk->data->jenisKelamin == 'Perempuan' ? 'selected' : '' }}>
                Perempuan</option>
        </select>
    </div>
    <div class="col-12 col-lg-4">
        <label for="status" class="form-label">Status</label>
        <select class="form-select" name="status" id="status">
            <option value="Kawin" {{ $data_penduduk->data->status == 'Kawin' ? 'selected' : '' }}>
                Kawin</option>
            <option value="Belum kawin" {{ $data_penduduk->data->status == 'Belum kawin' ? 'selected' : '' }}>
                Belum Kawin</option>
        </select>
    </div>
    <div class="col-12 col-lg-4">
        <label for="agama" class="form-label">Agama</label>
        <select class="form-select" name="agama" id="agama">
            <option value="Islam" {{ $data_penduduk->data->agama == 'Islam' ? 'selected' : '' }}>
                Islam</option>
            <option value="Kristen" {{ $data_penduduk->data->agama == 'Kristen' ? 'selected' : '' }}>
                Kristen</option>
            <option value="Katholik" {{ $data_penduduk->data->agama == 'Katholik' ? 'selected' : '' }}>
                Katholik</option>
            <option value="Hindu" {{ $data_penduduk->data->agama == 'Hindu' ? 'selected' : '' }}>
                Hindu</option>
            <option value="Budha" {{ $data_penduduk->data->agama == 'Budha' ? 'selected' : '' }}>
                Budha</option>
        </select>
    </div>
    <div class="col-12 col-lg-4">
        <label for="gol_darah" class="form-label">Golongan Darah</label>
        <select class="form-select" name="gol_darah" id="gol_darah">
            <option value="A" {{ $data_penduduk->data->golonganDarah == 'A' ? 'selected' : '' }}>
                A</option>
            <option value="B" {{ $data_penduduk->data->golonganDarah == 'B' ? 'selected' : '' }}>
                B</option>
            <option value="AB" {{ $data_penduduk->data->golonganDarah == 'AB' ? 'selected' : '' }}>
                AB</option>
            <option value="O" {{ $data_penduduk->data->golonganDarah == 'O' ? 'selected' : '' }}>
                O</option>
        </select>
    </div>
    <div class="col-12 col-lg-4">
        <label for="pekerjaan" class="form-label">Pekerjaan</label>
        <input type="text" class="form-control" name="pekerjaan" id="pekerjaan"
            value="{{ $data_penduduk->data->pekerjaan }}">
    </div>
    <div class="col-12 col-lg-4">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" id="email"
            value="{{ $data_penduduk->data->email }}">
    </div>
    <div class="col-12 col-lg-4">
        <label for="no_wa" class="form-label">No WhatsApp</label>
        <input type="number" class="form-control" name="no_wa" id="no_wa"
            value="{{ $data_penduduk->data->noWa }}">
    </div>
    <div class="col-12">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea class="form-control" name="alamat" id="alamat">{{ $data_penduduk->data->alamat }}</textarea>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary w-100">Submit</button>
    </div>
</form>
