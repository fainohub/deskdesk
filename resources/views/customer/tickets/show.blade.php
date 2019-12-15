@extends('layouts.app')

@section('title', 'Ticket')

@section('content')

    <div class="row flex-grow">
        <div class="col-lg-8 mx-auto">

            <div class="page-header">
                <h3 class="page-title"> {{ __('Ticket') }}</h3>
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

                                <div class="form-group row">
                                    <label for="title" class="col-sm-3 col-form-label">Titulo</label>
                                    <div class="col-sm-9">
                                        <input
                                                name="title"
                                                id="title"
                                                type="text"
                                                value="{{ $ticket->title }}"
                                                class="form-control"
                                                placeholder=""
                                        >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="description" class="col-sm-3 col-form-label">Descrição</label>
                                    <div class="col-sm-9">
                                        <textarea
                                                name="description"
                                                id="description"
                                                class="form-control"
                                                rows="10"
                                        >{{ $ticket->description }}</textarea>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row">
                                    <div class="col-md-12 text-right">
                                        <a class="btn btn-light" href="{{ route('customer.tickets.index') }}">Voltar</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
