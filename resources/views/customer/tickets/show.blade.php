@extends('layouts.app')

@section('title', 'Visualizar Ticket')

@section('content')

    <div class="page-header">
        <h3 class="page-title"> {{ __('Visualizar Ticket') }}</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home.index') }}">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('customer.tickets.index') }}">{{ __('Meus Tickets') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Ticket') }}</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @switch($ticket->status)
                        @case(\App\Models\Ticket::STATUS_OPEN)
                        <label class="badge badge-warning">{{ __('Novo') }}</label>
                        @break
                        @case(\App\Models\Ticket::STATUS_IN_PROGRESS)
                        <label class="badge badge-primary">{{ __('Em andamento') }}</label>
                        @break
                        @case(\App\Models\Ticket::STATUS_CLOSED)
                        <label class="badge badge-danger">{{ __('Fechado') }}</label>
                        @break
                        @default
                        <label class="badge badge-default">{{ $ticket->status }}</label>
                    @endswitch
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

                    @foreach($ticket->messages as $message)
                        <blockquote class="blockquote blockquote">
                            <p>{{ $message->message }}</p>
                            <footer class="blockquote-footer">
                                <p title="Source Title">{{ $message->commentable->name . ' - ' . $message->updated_at->format('d/m/Y H:m:i') }}</p>
                            </footer>
                        </blockquote>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @if($ticket->status == \App\Models\Ticket::STATUS_OPEN)
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ __('Enviar mensagem') }}</h4>

                        <form class="forms-sample" method="POST" action="{{ route('customer.tickets.message.store', ['id' => $ticket->id]) }}">
                            @csrf
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
