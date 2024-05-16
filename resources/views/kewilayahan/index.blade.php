@extends('apps')
@section('content')
    <div class="container-fluid">
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 bg-info p-3 rounded text-white">
                                <h5 class="card-title fw-semibold mb-4 text-white">LIST DATA WILAYAH</h5>
                                <p>Daftar data wilayah.</p>
                            </div>
                            <hr>
                            <div class="col-12 my-1">
                                <div class="row p-3">
                                    <div class="col-12 table-responsive">
                                        <table class="table" id="data-table-list-wilayah">
                                            <thead class="table-info">
                                                <tr>
                                                    <th>Nama Kecamatan</th>
                                                    <th>Kode Pos</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data_kecamatan->data as $item)
                                                    <tr>
                                                        <td>{{ $item->nama }}</td>
                                                        <td>{{ $item->kodePos }}</td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <div class="p-2">
                                                                    <button class="btn btn-warning btn-sm btn-edit-wilayah"
                                                                        data-id="{{ $item->id }}">Edit</button>
                                                                </div>
                                                                <div class="p-2">
                                                                    <a href="{{ route('delete.wilayah', $item->id) }}"
                                                                        class="btn btn-danger btn-sm btn-delete-kecamatan">Delete</a>
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
        </div>
    </div>

    {{-- Modal --}}
    @include('kewilayahan.modal.modal')
    {{-- Modal --}}

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#data-table-list-wilayah').DataTable({
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

            var modal = new bootstrap.Modal(document.getElementById('modal-edit-wilayah'));
            var jqmodal = $('#modal-edit-wilayah');
            var loaderModal = $('#modal-edit-wilayah-loader');
            var contentModal = $('#modal-edit-wilayah-content');

            $(document).on('click', '.btn-edit-wilayah', function() {
                modal.show();
                jqmodal.find('.modal-title').html('Edit Kecamatan');
                var idKecamatan = $(this).data('id');
                $.ajax({
                    type: "GET",
                    url: "{{ route('ajax.edit.wilayah') }}",
                    dataType: 'html',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id_kecamatan: idKecamatan,
                    },
                    beforeSend: function() {
                        contentModal.html('');
                        loaderModal.html(
                            '<div class="d-flex justify-content-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>'
                        );
                    },
                    success: function(data) {
                        contentModal.html(data);
                    },
                    complete: function() {
                        loaderModal.html('');
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        var pesan = xhr.status + " " + thrownError + "\n" + xhr.responseText;
                        contentModal.html(pesan);
                    },
                });
            });

            // Delete Wilayah
            $(document).on('click', '.btn-delete-kecamatan', function(e) {
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
