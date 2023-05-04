@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center" style="height: 700px;">
            <div class="col-lg-10 col-xl-10 mx-auto">
                <div class="card card-signin flex-row" style="border-radius: 10px; border: 0">
                    <div class="card-img-left d-none d-md-flex">
                        <!-- Background image for card set in CSS! -->
                    </div>
                    <div class="card-body">
                        @if (session('confirmation'))
                            <div class="alert alert-info" role="alert">
                                {!! session('confirmation') !!}
                            </div> <br>
                        @endif
                        @if ($errors->has('confirmation') > 0 )
                            <div class="alert alert-danger" role="alert">
                                {!! $errors->first('confirmation') !!}
                            </div>
                        @endif

                        <h5 class="card-title text-center">Masuk</h5>
                        <p class="text-center">Gunakan Email dan Password yang telah terdaftar</p>
                        <form class="form-signin" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-label-group">
                                <input type="email" id="inputEmail" class="form-control @error('email') is-invalid @enderror"  placeholder="Email" name="email" required>
                                <label for="inputEmail"><i class="fa fa-envelope"></i> Email</label>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-label-group">
                                <input type="password" id="inputPassword" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required>
                                <label for="inputPassword"><i class="fa fa-key"></i> Password</label>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <a href="{{ route('password.request') }}" class=""><b>Lupa Password ?</b></a>
                            </div>
                            <button class="btn btn-lg btn-info btn-block text-uppercase" type="submit">Masuk</button>
                            <div class="row col-12 mt-4 justify-content-center">
                                <h6>Belum punya akun ? <a href="{{route('register')}}">Daftar</a></h6>
                            </div>
                            {{-- <h6><a class="float-right" href="/"><i class="fal fa-times"></i> Batal</a></h6> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
