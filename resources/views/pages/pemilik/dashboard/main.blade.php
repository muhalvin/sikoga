@extends('layout.main')

@section('main-content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4>Dashboard</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total User</h4>
                        </div>
                        <div class="card-body">
                            {{ $jml_user->count() }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="far fa-newspaper"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pengurus</h4>
                        </div>
                        <div class="card-body">
                            {{ $jml_pengurus->count() }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="far fa-file"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Penghuni Kos</h4>
                        </div>
                        <div class="card-body">
                            {{ $penghuni->count() }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-circle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Pendaftaran Berlangsung</h4>
                        </div>
                        <div class="card-body">
                            {{ $pendaftar->count() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="row pl-3 pr-3" style="display: flex; justify-content: space-evenly">
            <div class="card col-6">
                <div class="card-body">
                    {!! $chart->container() !!}
                </div>
            </div>
            <div class="card col-6">
                <div class="card-body">
                    {!! $jkChart->container() !!}
                </div>
            </div>
        </div>
    </section>

    <script src="{{ $chart->cdn() }}"></script>
    <script src="{{ $jkChart->cdn() }}"></script>

    {{ $chart->script() }}
    {{ $jkChart->script() }}
@endsection
