@extends('layouts.error')

@section('title', '500')

@section('content')
    <div class="row flex-grow">
        <div class="col-lg-7 mx-auto text-white">
            <div class="row align-items-center d-flex flex-row">
                <div class="col-lg-6 text-lg-right pr-lg-4">
                    <h1 class="display-1 mb-0">500</h1>
                </div>
                <div class="col-lg-6 error-page-divider text-lg-left pl-lg-4">
                    <h2>{{ __('OOPS :(') }}</h2>
                    <h3 class="font-weight-light">{{ __('Ocorreu um erro interno. Já estamos trabalhando nisso ;)') }}</h3>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12 text-center mt-xl-2">
                    <a class="text-white font-weight-medium" href="{{ route('home.index') }}">{{ __('Voltar para a Home') }}</a>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12 mt-xl-2">
                    <p class="text-white font-weight-medium text-center">Copyright &copy; 2019 All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
