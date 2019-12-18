@extends('layouts.app')

@section('title', 'A simple PHP help desk')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h1>{{ __('Bem vindo ao DeskDesk.') }}</h1>
                    <h6 class="font-weight-light">{{ __('A simple PHP help desk.') }}</h6><hr>

                    <h2>{{ __('Como podemos ajudar?') }}</h2>
                </div>
            </div>
        </div>

        <div class="col-lg-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body text-center">
                    <h1>Tickets</h1>
                    <p>{{ __('Algum problema ou dúvida? Basta abrir um ticket que nossos atendentes vão ajudar o mais rápido possível!') }}</p>
                    <a class="btn btn-primary" href="{{ route('customer.tickets.index') }}">Meus tickets</a>
                </div>
            </div>
        </div>

        @if(config('features.faq'))
            <div class="col-lg-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h2>{{ __('Perguntas Frequentes') }}</h2>
                        <hr>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
