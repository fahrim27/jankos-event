@extends('layouts.auth')

@section('content')
<section class="row flexbox-container">
    <div class="col-xl-7 col-md-9 col-10 d-flex justify-content-center px-0">
        <div class="card bg-authentication rounded-0 mb-0" style="background-color: #dddddd;">
            <div class="row m-0">
                <div class="col-lg-6 d-lg-block d-none text-center align-self-center">
                    <img style="height: 100%; width: 100%;" src="{{ asset('app-assets/images/logo/Logo-UVCF22.png') }}" alt="branding logo">
                </div>
                <div class="col-lg-6 col-12 p-0">
                    <div class="card rounded-0 mb-0 px-2 py-1">
                        <div class="card-header pb-1">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="card-title">
                                <h4 class="mb-0">Recover your password</h4>
                            </div>
                        </div>
                        <p class="px-2 mb-0">Please enter your email address and we'll send you instructions on how to reset your password.</p>
                        <div class="card-content">
                            <form action="{{ route('password.email') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                        <div class="form-label-group">
                                            <input type="email" name="email" id="inputEmail" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                                            <label for="inputEmail">Email</label>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    <div class="float-md-left d-block mb-1">
                                        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-block px-75">Back to Login</a>
                                    </div>
                                    <div class="float-md-right d-block mb-1">
                                        <button type="submit" class="btn btn-primary btn-block px-75">Recover Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
