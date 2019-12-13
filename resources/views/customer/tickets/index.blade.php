@extends('layouts.app')

@section('title', 'Tickets')

@section('content')

    <div class="row flex-grow">
        <div class="col-lg-8 mx-auto">

            <div class="page-header">
                <h3 class="page-title"> {{ __('Meus tickets') }}</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Meus tickets') }}</li>
                    </ol>
                </nav>
            </div>

            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{ route('customer.tickets.create') }}" class="btn btn-primary float-right">{{ __('Criar Ticket') }}</a>
                                </div>
                            </div>

                            <hr>

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ __('Titulo') }}</th>
                                        <th>{{ __('Ultima Atualização') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Visualizar') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tickets as $ticket)
                                        <tr>
                                            <td>{{ $ticket->title }}</td>
                                            <td>{{ $ticket->created_at->format('d/m/Y H:i:s') }}</td>
                                            <td><label class="badge badge-default">{{ $ticket->status }}</label></td>
                                            <td><a href="#" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {!! $tickets->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
