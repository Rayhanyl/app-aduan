@extends('auth')
@section('content-auth')
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden text-bg-light min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="{{ route('view.main.menu.page') }}" class="fw-bold"><b><iconify-icon
                                            icon="solar:alt-arrow-left-line-duotone"></iconify-icon> Back To Main
                                        Menu</b></a>
                                <a href="{{ route('view.main.menu.page') }}"
                                    class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img class="rounded" src="{{ asset('assets/images/products/dash-prd-4.jpg') }}"
                                        alt="logo" />
                                </a>
                                <p class="text-center">Aplikasi Kewilayahan</p>
                                <form action="{{ route('login.process') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="param" id="param" value="kewilayahan">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Username</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            aria-describedby="emailHelp" />
                                    </div>
                                    <div class="mb-4">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" />
                                    </div>
                                    <button class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
