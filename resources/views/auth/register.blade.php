@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center" style="height: 700px">
            <div class="col-lg-10 col-xl-10 mx-auto">
                <div class="card card-signin flex-row" style="border-radius: 10px; border: 0">
                    <div class="card-img-left d-none d-md-flex">
                        <!-- Background image for card set in CSS! -->
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center">Daftar</h5>
                        <form class="form-signin" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-label-group">
                                <input type="text" id="inputUserame" class="form-control" placeholder="Nama" name="name" required autofocus style="cursor: pointer;">
                                <label for="inputUserame"><i class="fa fa-user-circle"></i> Nama Penanggung Jawab</label>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-label-group">
                                <input type="email" id="inputEmail" class="form-control" placeholder="Email" name="email" required style="cursor: pointer;">
                                <label for="inputEmail"><i class="fa fa-envelope"></i> Email</label>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-label-group">
                                <input type="text" id="inputschool" class="form-control" placeholder="Asal Instansi/ Sekolah" name="school" required style="cursor: pointer;">
                                <label for="inputschool"><i class="fa fa-school"></i> Instansi/ Sekolah</label>

                                @error('school')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-label-group">
                                <input type="text" id="inputteam" class="form-control" placeholder="Nama Tim Marketing" name="team" required style="cursor: pointer;">
                                <label for="inputteam"><i class="fa fa-users"></i> Tim</label>

                                @error('team')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-label-group">
                                <input type="number" id="inputphone" class="form-control" placeholder="Nomer Hp/ Whatsapp" name="phone" required style="cursor: pointer;">
                                <label for="inputphone"><i class="fa fa-whatsapp"></i> Nomer Hp/ Whatsapp</label>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-label-group">
                                <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required style="cursor: pointer;">
                                <label for="inputPassword"><i class="fa fa-key"></i> Password</label>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button class="btn btn-lg btn-success btn-block text-uppercase" type="submit">Daftar</button>
                            <div class="row col-12 mt-4 justify-content-center">
                                <h6>Sudah punya akun ? <a href="{{route('login')}}">Masuk</a></h6>
                            </div>
                            <h6><a class="float-right" href="/"><i class="fal fa-times"></i> Batal</a></h6>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
