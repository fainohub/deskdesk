@extends('layouts.auth')

@section('title', 'Cadastro')

@section('content')
    <h4>{{ __('Novo por aqui?') }}</h4>

    <h6 class="font-weight-light">{{ __('Criar uma conta é muito fácil! Basta cadastrar o formulário abaixo ;)') }}</h6>

    <form class="pt-3" method="POST" action="{{ route('customer.register.store') }}">
        @csrf

        <div class="form-group">
            <input
                    name="name"
                    id="name"
                    type="text"
                    class="form-control form-control-lg @error('name') is-invalid @enderror"
                    value="{{ old('name') }}"
                    required
                    placeholder="{{ __('Nome') }}"
            >

            @error('name')
                <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <input
                    name="email"
                    id="email"
                    type="text"
                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                    value="{{ old('email') }}"
                    required
                    placeholder="{{ __('Email') }}"
            >

            @error('email')
                <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <input
                    name="password"
                    id="password"
                    type="password"
                    class="form-control form-control-lg @error('password') is-invalid @enderror"
                    value="{{ old('password') }}"
                    required
                    placeholder="{{ __('Senha') }}"
            >

            @error('email')
                <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">{{ __('CRIAR CONTA') }}</button>
        </div>

        <div class="text-center mt-4 font-weight-light">
            {{ __('Já possui uma conta?') }} <a href="{{ route('customer.login') }}" class="text-primary">{{ __('Login') }}</a>
        </div>
    </form>
@endsection
