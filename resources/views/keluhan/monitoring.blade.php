@extends('apps')
@section('content')
    <div class="container-fluid">
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12  bg-primary p-3 rounded text-white">
                                <h5 class="card-title fw-semibold mb-4 text-white">MONITORING KELUHAN WARGA</h5>
                                <p>Memantau keluhan warga sudah sejauh mana progress penangan keluhan tersebut.</p>
                            </div>
                            <hr>
                            <div class="col-12 col-lg-3 my-1">
                                <label for="filter_date" class="form-label">Waktu Pembuatan :</label>
                                <input type="date" class="form-control" name="filter_date" id="filter_date">
                            </div>
                            <div class="col-12 my-2 d-flex justify-content-center" id="loader-monitoring-keluhan">
                            </div>
                            <div class="col-12 my-2" id="data-monitoring-keluhan">
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
                // Trigger change event on date selection
                getListKeluhan("{{ \Carbon\Carbon::now()->format('Y-m-d') }}");

                // Bind change event to date input
                $(document).on('change', '#filter_date', function(e) {
                    getListKeluhan($(this).val());
                });
            });

            function getListKeluhan(date) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('ajax.monitoring.keluhan.content') }}",
                    dataType: 'html',
                    data: {
                        date,
                    },
                    beforeSend: function() {
                        $('#data-monitoring-keluhan').html('');
                        $('#loader-monitoring-keluhan').html(
                            '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>'
                        );
                    },
                    success: function(data) {
                        $('#data-monitoring-keluhan').html(data);
                        $('#loader-monitoring-keluhan').html('');
                    },
                    complete: function() {},
                    error: function(xhr, ajaxOptions, thrownError) {
                        var pesan = xhr.status + " " + thrownError + "\n" + xhr.responseText;
                        $('#loader-monitoring-keluhan').html('');
                        $('#data-monitoring-keluhan').html(pesan);
                    },
                });
            }
        </script>
    @endpush
@endsection
