<div class="row g-3">
    @forelse ($detail_keluhan->data->content as $item)
        <div class="col-12">
            <div class="card bg-primary shadow">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <span class="badge text-bg-light py-2 px-3">{{ $item->bidang }}</span>
                        </div>
                        <div class="col-12 text-white">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <p>{{ $item->namaPelapor }}</p>
                                    <p>{{ $item->alamatKeluhan }} , {{ $item->namaKecamatan }}</p>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <p>{{ $item->createdAt }}</p>
                                    <p>{{ $item->status }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 row g-3 text-center">
                            <div class="col-12 col-lg-6">
                                <button type="button" class="btn btn btn-dark w-50" id="btn-info-selengkapnya"
                                    data-id="{{ $item->id }}">Selengkapnya</button>
                            </div>
                            <div class="col-12 col-lg-6">
                                <button type="button" class="btn btn btn-warning w-50" id="btn-tracking"
                                    data-id="{{ $item->id }}">Melacak</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="card bg-primary shadow">
                <div class="card-body">
                    <h4 class="text-white">Tidak ada pengaduan pada tanggal ini.</h4>
                </div>
            </div>
        </div>
    @endforelse
</div>

{{-- Modal --}}
@include('keluhan.modal.info')
@include('keluhan.modal.tracking')
{{-- Modal --}}

<script>
    var modalInfo = new bootstrap.Modal(document.getElementById('modal-info-keluhan'));
    var jqmodalInfo = $('#modal-info-keluhan');
    var loaderInfo = $('#modal-loader-info');
    var contentInfo = $('#modal-content-info');

    $(document).on('click', '#btn-info-selengkapnya', function(event) {
        event.stopImmediatePropagation(); // Stops other click event handlers on the same element
        modalInfo.show();
        jqmodalInfo.find('.modal-title').html('Info Selengkapnya');
        var idComplaint = $(this).data('id');
        $.ajax({
            type: "GET",
            url: "{{ route('ajax.info.keluhan') }}",
            dataType: 'html',
            data: {
                _token: "{{ csrf_token() }}",
                id_complaint: idComplaint,
            },
            beforeSend: function() {
                contentInfo.html('');
                loaderInfo.html(
                    '<div class="d-flex justify-content-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>'
                );
            },
            success: function(data) {
                contentInfo.html(data);
            },
            complete: function() {
                loaderInfo.html('');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                var pesan = xhr.status + " " + thrownError + "\n" + xhr.responseText;
                contentInfo.html(pesan);
            },
        });
    });

    var modal = new bootstrap.Modal(document.getElementById('modal-tracking-keluhan'));
    var jqmodal = $('#modal-tracking-keluhan');
    var loaderTracking = $('#modal-loader-tracking');
    var contentTracking = $('#modal-content-tracking');

    $(document).on('click', '#btn-tracking', function(event) {
        event.stopImmediatePropagation(); // Stops other click event handlers on the same element
        console.log('Tracking');
        modal.show();
        jqmodal.find('.modal-title').html('Trace Keluhan');
        var idComplaint = $(this).data('id');
        $.ajax({
            type: "GET",
            url: "{{ route('ajax.tracking.keluhan') }}",
            dataType: 'html',
            data: {
                _token: "{{ csrf_token() }}",
                id_complaint: idComplaint,
            },
            beforeSend: function() {
                contentTracking.html('');
                loaderTracking.html(
                    '<div class="d-flex justify-content-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>'
                );
            },
            success: function(data) {
                contentTracking.html(data);
            },
            complete: function() {
                loaderTracking.html('');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                var pesan = xhr.status + " " + thrownError + "\n" + xhr.responseText;
                contentTracking.html(pesan);
            },
        });
    });
</script>
