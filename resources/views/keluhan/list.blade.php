@extends('apps')
@section('content')
    <div class="container-fluid">
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 bg-primary p-3 rounded text-white">
                                <h5 class="card-title fw-semibold mb-4 text-white">LIST KELUHAN WARGA</h5>
                                <p>Daftar keluhan yang disampaikan oleh warga untuk ditindaklanjuti oleh Helpdesk.</p>
                            </div>
                            <hr>
                            <div class="col-12 my-1">
                                <p class="fw-semibold">Filter Status:</p>
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="pills-open-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-open" type="button" role="tab"
                                            aria-controls="pills-open" aria-selected="true">Open</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-inprogress-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-inprogress" type="button" role="tab"
                                            aria-controls="pills-inprogress" aria-selected="false">Inprogress</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-reject-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-reject" type="button" role="tab"
                                            aria-controls="pills-reject" aria-selected="false">Reject</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-done-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-done" type="button" role="tab"
                                            aria-controls="pills-done" aria-selected="false">Done</button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-open" role="tabpanel"
                                        aria-labelledby="pills-open-tab" tabindex="0">
                                        <div id="open-content">
                                        </div>
                                        <div id="reload-open-content" class="d-flex justify-content-center">
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pills-inprogress" role="tabpanel"
                                        aria-labelledby="pills-inprogress-tab" tabindex="0">
                                        <div id="inprogress-content">
                                        </div>
                                        <div id="reload-inprogress-content" class="d-flex justify-content-center">
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pills-reject" role="tabpanel"
                                        aria-labelledby="pills-reject-tab" tabindex="0">
                                        <div id="reject-content">
                                        </div>
                                        <div id="reload-reject-content" class="d-flex justify-content-center">
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pills-done" role="tabpanel"
                                        aria-labelledby="pills-done-tab" tabindex="0">
                                        <div id="done-content">
                                        </div>
                                        <div id="reload-done-content" class="d-flex justify-content-center">
                                        </div>
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
    @include('keluhan.modal.modal')
    {{-- Modal --}}

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#pills-open-tab').trigger('click');
            });

            $(document).on('click', '#pills-open-tab', function() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('ajax.open.content') }}",
                    dataType: 'html',
                    data: {},
                    beforeSend: function() {
                        $('#open-content').html('');
                        $('#reload-open-content').html(
                            '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>'
                        );
                    },
                    success: function(data) {
                        $('#open-content').html(data);
                    },
                    complete: function() {
                        $('#reload-open-content').html('');
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        var pesan = xhr.status + " " + thrownError + "\n" + xhr.responseText;
                        $('#open-content').html(pesan);
                    },
                });
            });

            $(document).on('click', '#pills-inprogress-tab', function() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('ajax.inprogress.content') }}",
                    dataType: 'html',
                    data: {},
                    beforeSend: function() {
                        $('#inprogress-content').html('');
                        $('#reload-inprogress-content').html(
                            '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>'
                        );
                    },
                    success: function(data) {
                        $('#inprogress-content').html(data);
                    },
                    complete: function() {
                        $('#reload-inprogress-content').html('');
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        var pesan = xhr.status + " " + thrownError + "\n" + xhr.responseText;
                        $('#inprogress-content').html(pesan);
                    },
                });
            });

            $(document).on('click', '#pills-reject-tab', function() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('ajax.reject.content') }}",
                    dataType: 'html',
                    data: {},
                    beforeSend: function() {
                        $('#reject-content').html('');
                        $('#reload-reject-content').html(
                            '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>'
                        );
                    },
                    success: function(data) {
                        $('#reject-content').html(data);
                    },
                    complete: function() {
                        $('#reload-reject-content').html('');
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        var pesan = xhr.status + " " + thrownError + "\n" + xhr.responseText;
                        $('#reject-content').html(pesan);
                    },
                });
            });

            $(document).on('click', '#pills-done-tab', function() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('ajax.done.content') }}",
                    dataType: 'html',
                    data: {},
                    beforeSend: function() {
                        $('#done-content').html('');
                        $('#reload-done-content').html(
                            '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>'
                        );
                    },
                    success: function(data) {
                        $('#done-content').html(data);
                    },
                    complete: function() {
                        $('#reload-done-content').html('');
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        var pesan = xhr.status + " " + thrownError + "\n" + xhr.responseText;
                        $('#done-content').html(pesan);
                    },
                });
            });
        </script>
    @endpush
@endsection
