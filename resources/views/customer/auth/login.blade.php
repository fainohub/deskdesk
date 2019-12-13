@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <h6 class="font-weight-light">{{ __('Faça o Login para continuar') }}</h6>

    <form class="pt-3" method="POST" action="{{ route('customer.login.post') }}">
        @csrf

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

            @error('password')
                <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">{{ __('LOGIN') }}</button>
        </div>

        <div class="text-center mt-4 font-weight-light">
            {{ __('Não possui uma conta?') }} <a href="{{ route('customer.register.index') }}" class="text-primary">{{ __('Registrar') }}</a>
        </div>
    </form>
@endsection
