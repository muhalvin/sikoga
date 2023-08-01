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
                            <h4>Pemilik Kos</h4>
                        </div>
                        <div class="card-body">
                            {{ $pemilik->count() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="row pl-3 pr-3">
            <div class="card col-md-6 pr-3">
                <div class="card-body">
                    {!! $usersChart->container() !!}
                </div>
            </div>
            <div class="card col-md-6">
                <div class="card-body">
                    {!! $genderChart->container() !!}
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="section-body">
            <h5 class="section-title">Daftar KOS</h5>
            <p class="section-lead">Berikut merupakan daftar pilihan tempat kos yang tersedia.</p>
            <div class="row">
                @foreach ($kos as $item)
                    <div class="col-12 col-md-4 col-lg-4">
                        <div class="pricing pricing-highlight">
                            <div class="pricing-title">
                                <span>{{ $item->nama_kos }}</span>
                            </div>
                            <div class="box mt-2">
                                <img src="{{ url('storage/KOS/Foto') }}/{{ $item->f_depan }}" alt="" onerror="this.onerror=null; this.src='{{ url('assets/img/default/default.jpg') }}'"
                                    style="width: 100%; height:100%; max-height: 25vh;">
                            </div>
                            <div class="pricing-padding" style="min-height: 65vh;">
                                <div class="pricing-price mb-3">
                                    <h5>Price</h5>
                                </div>
                                <div class="pricing-price">
                                    <div style="font-size: 4vh; font-weight: 900;">@currency($item->biaya)</div>
                                    <div>per month</div>
                                    <hr>
                                </div>
                                <div class="pricing-price mb-1">
                                    <div style="font-size: 3vh;">Fasilitas</div>
                                </div>
                                <div class="pricing-details mb-1">
                                    <div class="pricing-item">
                                        <div class="pricing-item-label">{{ $item->fasilitas }}</div>
                                    </div>
                                </div>
                                <hr>
                                <div class="pricing-price mb-1">
                                    <div style="font-size: 3vh;">Peraturan</div>
                                </div>
                                <div class="pricing-details mb-3">
                                    <div class="pricing-item">
                                        <div class="pricing-item-label">{{ $item->peraturan }}</div>
                                    </div>
                                </div>

                            </div>
                            <div class="pricing-cta" style="margin-top: -3vh;">
                                <a href="{{ url('pengurus/showKos') }}/{{ $item->id }}">More Details <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <script src="{{ $usersChart->cdn() }}"></script>
    <script src="{{ $genderChart->cdn() }}"></script>

    {{ $usersChart->script() }}
    {{ $genderChart->script() }}
@endsection
