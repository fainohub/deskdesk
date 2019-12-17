@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
    <div class="d-xl-flex justify-content-between align-items-start">
        <h2 class="text-dark font-weight-bold mb-5"> Dashboard </h2>
    </div>

    <div class="row">
        <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="mb-2 text-dark font-weight-normal">Tickets</h5>
                    <h2 class="mb-4 text-dark font-weight-bold"><i class="fa fa-ticket"></i> 180</h2>
                    <p class="mt-4 mb-0">Total de tickets</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="mb-2 text-dark font-weight-normal">Tickets Abertos</h5>
                    <h2 class="mb-4 text-dark font-weight-bold"><i class="fa fa-check"></i> 100</h2>
                    <p class="mt-4 mb-0">Total de tickets abertos</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3  col-lg-6 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="mb-2 text-dark font-weight-normal">Tickets Fechados</h5>
                    <h2 class="mb-4 text-dark font-weight-bold"><i class="fa fa-close"></i> 80</h2>
                    <p class="mt-4 mb-0">Total de tickets fechados</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="mb-2 text-dark font-weight-normal">Usuários</h5>
                    <h2 class="mb-4 text-dark font-weight-bold"><i class="fa fa-users"></i> 2</h2>
                    <p class="mt-4 mb-0">Total de usuários cadastrados</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        
    </script>
@endsection
