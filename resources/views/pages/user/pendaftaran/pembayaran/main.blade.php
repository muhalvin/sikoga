@extends('layout.main')

@section('main-content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4>Pembayaran</h4>
            </div>
        </div>

        @if ($verif)
            {{-- Pilih kos --}}
            <div class="section-body">
                <div class="mt-3 mb-3">

                    <div class="card">
                        <div class="card-header">
                            <h4>Pendaftaran anda telah diverifikasi, silahkan pilih kos yang tersedia dengan klik pada
                                tombol dibawah.</h4>
                        </div>
                        <div class="card-body">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Pilih KOS
                            </button>
                        </div>
                    </div>

                    <div class="section-body">
                        <h5 class="section-title">Daftar KOS</h5>
                        <p class="section-lead">Berikut merupakan daftar pilihan tempat kos yang tersedia.</p>
                        <div class="row">
                            @foreach ($list as $item)
                                <div class="col-12 col-md-4 col-lg-4">
                                    <div class="pricing pricing-highlight">
                                        <div class="pricing-title">
                                            <span>{{ $item->nama_kos }}</span>
                                        </div>
                                        <div class="box mt-2">
                                            <img src="{{ url('storage/KOS/Foto') }}/{{ $item->f_depan }}" alt=""
                                                onerror="this.onerror=null; this.src='{{ url('assets/img/default/default.jpg') }}'"
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
                                            <a href="{{ url('showKos') }}/{{ $item->id }}">More Details <i
                                                    class="fas fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            {{-- /Pilih kos --}}
        @elseif($verify)
            {{-- sudah terverifikasi --}}

            <div class="section-body">
                <div class="mt-3 mb-3">
                    <a class="btn btn-success" href="{{ route('nota') }}" target="_blank">
                        Lihat Invoice
                    </a>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>KOS Terdaftar</h4>
                    </div>
                    <div class="card-body">
                        @foreach ($kos_in as $item)
                            <div class="col-12 col-md-4 col-lg-4">
                                <div class="pricing pricing-highlight">
                                    <div class="pricing-title">
                                        <span>{{ $item->nama_kos }}</span>
                                    </div>
                                    <div class="box mt-2">
                                        <img src="{{ url('storage/KOS/Foto') }}/{{ $item->f_depan }}" alt=""
                                            onerror="this.onerror=null; this.src='{{ url('assets/img/default/default.jpg') }}'"
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
                                        <a style="font-size: 12px;">
                                            Anda terdaftar di KOS ini
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- /sudah terverifikasi --}}
        @elseif($verifikasi)
            {{-- Belum diverifikasi --}}
            <div class="section-body">
                <div class="mt-3">
                    @foreach ($daftar as $item)
                        <div class="card">
                            <div class="card-header">
                                <h4>Pembayaran Pertama</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Bukti Bayar</label>
                                            <div class="mt-3">
                                                <img class="d-block w-100" id="bukti_bayar" alt=""
                                                    src="{{ url('storage/Pembayaran') }}/{{ $item->bukti_bayar }}"
                                                    style="min-height: 32vh; max-height: 32vh; border-radius: 0.5vh; border: 2px solid gray"
                                                    onerror="this.onerror=null; this.src='{{ url('assets/img/pictures/default-photo.png') }}'">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Nama Kos</label>
                                            <input type="text" class="form-control" value="{{ $item->nama_kos }}"
                                                readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Pemilik Kos</label>
                                            <input type="text" class="form-control" value="{{ $item->nama }}"
                                                readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Status Pembayaran</label>
                                            <div>
                                                @if ($item->status_bayar == null)
                                                    <span class="badge badge-warning">Menunggu</span>
                                                @elseif ($item->status_bayar == 1)
                                                    <span class="badge badge-primary">Menunggu</span>
                                                @elseif ($item->status_bayar == 2)
                                                    <span class="badge badge-success">Berhasil</span>
                                                @else
                                                    <span class="badge badge-danger">Pembayaran ditolak, silahkan unggah
                                                        kembali
                                                        bukti pembayaran anda!
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @elseif($tolak)
            {{-- Pilih kos --}}
            <div class="section-body">
                <div class="mt-3 mb-3">

                    <div class="card">
                        <div class="card-header">
                            <h4>Pembayaran Anda Ditolak, Silahkan Ulangi Lagi!</h4>
                        </div>
                        <div class="card-body">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModal">
                                Pilih KOS
                            </button>
                        </div>
                    </div>

                    <div class="section-body">
                        <h5 class="section-title">Daftar KOS</h5>
                        <p class="section-lead">Berikut merupakan daftar pilihan tempat kos yang tersedia.</p>
                        <div class="row">
                            @foreach ($list as $item)
                                <div class="col-12 col-md-4 col-lg-4">
                                    <div class="pricing pricing-highlight">
                                        <div class="pricing-title">
                                            <span>{{ $item->nama_kos }}</span>
                                        </div>
                                        <div class="box mt-2">
                                            <img src="{{ url('storage/KOS/Foto') }}/{{ $item->f_depan }}" alt=""
                                                onerror="this.onerror=null; this.src='{{ url('assets/img/default/default.jpg') }}'"
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
                                            <a href="{{ url('showKos') }}/{{ $item->id }}">More Details <i
                                                    class="fas fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            {{-- /Pilih kos --}}
        @else
            {{-- Belum mendaftar --}}
            <div class="section-body">
                <div class="mt-3 mb-3">
                    <a href="{{ route('verifikasi') }}" class="btn btn-danger">Anda belum melakukan verifikasi diri!</a>
                </div>
            </div>
        @endif
    </section>

    <!-- Modal of Pilih Kos -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="needs-validation" novalidate="" action="{{ route('storePembayaran') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="row mt-3" style="margin-bottom: -5vh;">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Nama Kos</label>
                                    <select class="form-control  @error('kos_id') is-invalid @enderror" name="kos_id"
                                        id="kos" required>
                                        <option value=""></option>
                                        @foreach ($kos as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_kos }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Oh no! You forget to fill this field.
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Bukti Bayar</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="bukti_bayar"
                                            value="" required>
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                        <div class="invalid-feedback">
                                            Oh no! You forget to fill this field.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- Modal of Bayar Kos -->
    <div class="modal fade" id="bayarKos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bayar Sewa Kos / Bulan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="needs-validation" novalidate="" action="{{ route('storePembayaranBulanan') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="row mt-3" style="margin-bottom: -5vh;">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Nama Kos</label>
                                    <input type="date" class="form-control" value="now()" name="tanggal">
                                    <div class="invalid-feedback">
                                        Oh no! You forget to fill this field.
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Bukti Bayar</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="bukti_bayar"
                                            value="" required>
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                        <div class="invalid-feedback">
                                            Oh no! You forget to fill this field.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
