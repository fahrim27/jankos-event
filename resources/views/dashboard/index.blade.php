@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/users.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/dashboard-analytics.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/card-analytics.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/tour/tour.css') }}">
@endsection

@section('content')
<div class="content-header row">
</div>
<div class="content-body">
    <!-- Dashboard Analytics Start -->
    <section id="dashboard-analytics">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                @if(auth()->user()->profile)
                    @if(auth()->user()->profile->s1 || auth()->user()->profile->s2 || auth()->user()->profile->s3)
                        @if(auth()->user()->profile->s1_instansi || auth()->user()->profile->s2_instansi || auth()->user()->profile->s3_instansi)
                            <div class="alert alert-warning show" role="alert">
                              <strong>Akun anda dalam keadaan bagus,</strong> <a route="{{ route('setting.indexProfile') }}">klik disini!</a> untuk melengkapi kembali data pribadi anda.
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                        @endif
                    @endif
                @endif
                
                <div class="card {{ $bg }} text-white">
                    <div class="card-content">
                        <div class="card-body text-center">
                            <img src="{{ asset('app-assets/images/elements/decore-left.png') }}" class="img-left">
                            <img src="{{ asset('app-assets/images/elements/decore-right.png') }}" class="img-right">
                            <div class="avatar avatar-xl {{ $bg }} shadow mt-0">
                                <div class="avatar-content">
                                    <i class="{{ $icon }} white font-large-1"></i>
                                </div>
                            </div>
                            <div class="text-center">
                                <h1 class="mb-2 text-white">{{ $title }}</h1>
                                <p class="m-auto w-75">{{ $message }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Dashboard Analytics end -->

</div>
@endsection

@section('js')
    <script src="{{ asset('app-assets/js/scripts/pages/user-profile.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/pages/dashboard-analytics.js') }}"></script>
@endsection