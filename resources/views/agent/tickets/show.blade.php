@extends('layouts.dashboard')

@section('title', 'Visualizar Ticket')

@section('content')

    <div class="row flex-grow">
        <div class="col-lg-12 mx-auto">

            <div class="page-header">
                <h3 class="page-title"> {{ __('Visualizar Ticket') }}</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('agent.dashboard.index') }}">{{ __('Dasboard') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('agent.tickets.index') }}">{{ __('Meus Tickets') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Ticket') }}</li>
                    </ol>
                </nav>
            </div>

            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ $ticket->title }}</h4>
                            <h5>{{ $ticket->description }}</h5>
                            <hr>
                            <p class="small">{{ $ticket->updated_at->format('d/m/Y H:m:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ __('Mensagens') }}</h4>

                            <blockquote class="blockquote blockquote">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                <footer class="blockquote-footer">Thiago Faino <cite title="Source Title">15/12/2019 13:54</cite></footer>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ __('Enviar mensagem') }}</h4>

                            <div class="form-group row">
                                <label for="description" class="col-sm-3 col-form-label">Mensagem</label>
                                <div class="col-sm-9">
                                        <textarea
                                                name="message"
                                                id="message"
                                                class="form-control @error('message') is-invalid @enderror"
                                                rows="10"
                                        >{{ old('message') }}</textarea>
                                    @error('message')
                                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection