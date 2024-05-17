@extends('auth')
@section('content-auth')
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden text-bg-light min-vh-100 d-flex align-items-center justify-content-center background-main-menu">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100 p-5">
                    <div class="col-12 text-center mb-4">
                        <h1 class="text-white">MAIN MENU</h1>
                    </div>
                    <div class="col-md-8 col-lg-4 col-xxl-4">
                        <div class="card mb-0 bg-primary">
                            <div class="card-body text-center">
                                <img style="width: 28%" class="rounded"
                                    src="{{ asset('assets/images/logos/dash-prd-1.png') }}" alt="logo">
                                <h5 class="text-white my-4">Aplikasi Keluhan</h5>
                                <a href="{{ route('view.keluhan.login.page') }}"
                                    class="btn btn-outline-light rounded-3 my-2 w-50"><b>Login</b></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8 col-lg-4 col-xxl-4">
                        <div class="card mb-0 bg-primary">
                            <div class="card-body text-center">
                                <img style="width: 20%" class="rounded"
                                    src="{{ asset('assets/images/logos/dash-prd-3.png') }}" alt="logo">
                                <h5 class="text-white my-4">Aplikasi Kependudukan</h5>
                                <a href="{{ route('view.kependudukan.login.page') }}"
                                    class="btn btn-outline-light rounded-3 my-2 w-50"><b>Login</b></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8 col-lg-4 col-xxl-4">
                        <div class="card mb-0 bg-primary">
                            <div class="card-body text-center">
                                <img style="width: 15%" class="rounded"
                                    src="{{ asset('assets/images/logos/dash-prd-4.png') }}" alt="logo">
                                <h5 class="text-white my-4">Aplikasi Kewilayahan</h5>
                                <a href="{{ route('view.kewilayahan.login.page') }}"
                                    class="btn btn-outline-light rounded-3 my-2 w-50"><b>Login</b></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
