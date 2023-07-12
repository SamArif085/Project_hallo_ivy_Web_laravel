@extends('layout.layoutLogin')
@section('content')
    <main>
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="row justify-content-center">
                    <div class="col-lg-10 d-flex flex-column align-items-center justify-content-center">
                        <div class="card mb-3" style="background-color: #66E782">
                            <div class="card-body">
                                <div class="pt-2 pb-2 mb-2 pt-3">
                                    <h1 class="text-center mt-3" style="font-size: 70px">HALO-IVY</h1>
                                    {{-- <p class="text-center small">Enter your username & password to login</p> --}}
                                </div>
                                @if (session()->has('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                <form class="row g-3 needs-validation p-4" action="cekLogin" method="POST">
                                    @csrf
                                    <div class="col-12 mb-3">
                                        {{-- <label for="yourUsername" class="form-label">Username</label> --}}
                                        <div class="input-group has-validation">
                                            <input type="text" name="username" class="form-control" id="yourUsername"
                                                required placeholder="Username">
                                            <div class="invalid-feedback">Please enter your username.</div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        {{-- <label for="yourPassword" class="form-label">Password</label> --}}
                                        <input type="password" name="password" class="form-control" id="yourPassword"
                                            required placeholder="Password">
                                        <div class="invalid-feedback">Please enter your password!</div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex justify-content-center">
                                            <button class="btn btn-light" type="submit">Login</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-center">
                    <div class="row mt-3">
                        <div class="col-3">
                            <img src="images/logo_akn.png" alt="logo-akn" width="100px">
                        </div>
                        <div class="col-5">
                            <img src="images/logo_pateron.png" alt="logo-pateron" width="150px">
                        </div>
                        {{-- <div class="col-4">
                            <img src="images/logo_pateron.png" alt="logo-pateron" width="150px">
                        </div> --}}
                        <div class="col-4">
                            <img src="images/logo-slbn.png" alt="logo-slbn" width="80px">
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </main><!-- End #main -->
@endsection
