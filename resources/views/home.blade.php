@extends('layouts.app')

@section('title', 'A simple PHP help desk')

@section('content')

    <div class="row flex-grow">
        <div class="col-lg-8 mx-auto">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h1>{{ __('Bem vindo ao DeskDesk') }}</h1>
                            <h6 class="font-weight-light">{{ __('A simple PHP help desk.') }}</h6><hr>
                            <h2>{{ __('Como podemos ajudar?') }}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('customer.tickets.index') }}">Meus tickets</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h2>{{ __('Navegue nas páginas de Ajuda') }}</h2>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
