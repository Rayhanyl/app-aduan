<div class="row p-3">
    <div class="col-12 table-responsive">
        <table class="table" id="data-table-done-keluhan">
            <thead class="table-info">
                <tr>
                    <th>Nomor Keluhan</th>
                    <th>Waktu Dibuat</th>
                    <th>Bidang</th>
                    <th>Pelapor</th>
                    <th>Lokasi & Laporan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_done->data->content as $item)
                    <tr>
                        <td>{{ $item->nomor }}</td>
                        <td>{{ $item->createdAt }}</td>
                        <td>{{ $item->bidang }}</td>
                        <td>{{ $item->namaPelapor }}</td>
                        <td>{{ $item->alamatKeluhan }}</td>
                        <td>
                            <div class="d-flex">
                                <button type="button" class="btn btn-sm btn-success" id="btn-konfirmasi-keluhan"
                                    data-id="{{ $item->id }}">Approval</button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#data-table-done-keluhan').DataTable({
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

    var modal = new bootstrap.Modal(document.getElementById('modal-konfirmasi-keluhan'));
    var jqmodal = $('#modal-konfirmasi-keluhan');
    var loaderModal = $('#modalLoader');
    var contentModal = $('#modalContent');

    $(document).on('click', '#btn-konfirmasi-keluhan', function() {
        modal.show();
        jqmodal.find('.modal-title').html('Konfirmasi Keluhan');
        var idKeluhan = $(this).data('id');
        $.ajax({
            type: "GET",
            url: "{{ route('ajax.detail.keluhan.content') }}",
            dataType: 'html',
            data: {
                _token: "{{ csrf_token() }}",
                id_keluhan: idKeluhan,
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
</script>
