@extends('apps')
@section('content')
    <div class="container-fluid">
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row p-3">
                            <div class="col-12 table-responsive">
                                <table class="table" id="data-table-list-warga">
                                    <thead class="table-info">
                                        <tr>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Agama</th>
                                            <th>Status</th>
                                            <th>Email</th>
                                            <th>No Wa</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_warga->data as $item)
                                            <tr>
                                                <td data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="{{ $item->nik }}">{{ Str::limit($item->nik, '8', '...') }}
                                                </td>
                                                <td data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="{{ $item->nama }}">{{ Str::limit($item->nama, '5', '...') }}
                                                </td>
                                                <td>{{ $item->jenisKelamin }}</td>
                                                <td>{{ $item->agama }}</td>
                                                <td>{{ $item->status }}</td>
                                                <td data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="{{ $item->email }}">{{ Str::limit($item->email, '7', '...') }}
                                                </td>
                                                <td>{{ $item->noWa }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="p-2">
                                                            <button class="btn btn-primary btn-sm btn-detail-penduduk"
                                                                data-id="{{ $item->nik }}">Detail</button>
                                                        </div>
                                                        <div class="p-2">
                                                            <button class="btn btn-warning btn-sm btn-edit-penduduk"
                                                                data-id="{{ $item->nik }}">Edit</button>
                                                        </div>
                                                        <div class="p-2">
                                                            <a href="{{ route('delete.penduduk', $item->nik) }}"
                                                                class="btn btn-danger btn-sm btn-delete-penduduk">Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal --}}
    @include('warga.modal.modal_detail')
    @include('warga.modal.modal_edit')
    {{-- Modal --}}
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#data-table-list-warga').DataTable({
                    responsive: true,
                    lengthMenu: [
                        [5, 10, 15, -1],
                        [5, 10, 15, 'All'],
                    ],
                    order: [
                        [0, 'desc']
                    ],
                });
            });

            var modalDetail = new bootstrap.Modal(document.getElementById('modal-detail-penduduk'));
            var jqmodalDetail = $('#modal-detail-penduduk');
            var loaderModalDetail = $('#modal-detail-penduduk-loader');
            var contentModalDetail = $('#modal-detail-penduduk-content');

            $(document).on('click', '.btn-detail-penduduk', function() {
                modalDetail.show();
                jqmodalDetail.find('.modal-title').html('Detail Data Penduduk');
                var idPenduduk = $(this).data('id');
                $.ajax({
                    type: "GET",
                    url: "{{ route('ajax.detail.data.penduduk') }}",
                    dataType: 'html',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id_penduduk: idPenduduk,
                    },
                    beforeSend: function() {
                        contentModalDetail.html('');
                        loaderModalDetail.html(
                            '<div class="d-flex justify-content-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>'
                        );
                    },
                    success: function(data) {
                        contentModalDetail.html(data);
                    },
                    complete: function() {
                        loaderModalDetail.html('');
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        var pesan = xhr.status + " " + thrownError + "\n" + xhr.responseText;
                        contentModalDetail.html(pesan);
                    },
                });
            });

            var modalPenduduk = new bootstrap.Modal(document.getElementById('modal-edit-penduduk'));
            var jqmodalPenduduk = $('#modal-edit-penduduk');
            var loaderModalPenduduk = $('#modal-edit-penduduk-loader');
            var contentModalPenduduk = $('#modal-edit-penduduk-content');

            $(document).on('click', '.btn-edit-penduduk', function() {
                modalPenduduk.show();
                jqmodalPenduduk.find('.modal-title').html('Edit Data Penduduk');
                var idPenduduk = $(this).data('id');
                $.ajax({
                    type: "GET",
                    url: "{{ route('ajax.edit.data.penduduk') }}",
                    dataType: 'html',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id_penduduk: idPenduduk,
                    },
                    beforeSend: function() {
                        contentModalPenduduk.html('');
                        loaderModalPenduduk.html(
                            '<div class="d-flex justify-content-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>'
                        );
                    },
                    success: function(data) {
                        contentModalPenduduk.html(data);
                    },
                    complete: function() {
                        loaderModalPenduduk.html('');
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        var pesan = xhr.status + " " + thrownError + "\n" + xhr.responseText;
                        contentModalPenduduk.html(pesan);
                    },
                });
            });

            // Delete Penduduk
            $(document).on('click', '.btn-delete-penduduk', function(e) {
                e.preventDefault();
                let href = $(this).attr('href');
                Swal.fire({
                    title: 'Apakah anda yakin akan menghapus data ini?',
                    text: "Data yang sudah terhapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    toast: true,
                    position: 'top-end',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Data Sedang Dihapus',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 1000,
                            timerProgressBar: true,
                            didOpen: function(toast) {
                                toast.addEventListener('mouseenter', Swal.stopTimer);
                                toast.addEventListener('mouseleave', Swal.resumeTimer);
                            }
                        }).then(() => {
                            window.location.href = href;
                        });
                    }
                });
            });
        </script>
    @endpush
@endsection
