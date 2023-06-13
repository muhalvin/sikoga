@extends('layout.main')

@section('main-content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4>Pembayaran</h4>
            </div>
        </div>

        @if ($verif)
            <div class="section-body">
                <div class="mt-3 mb-3">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Pilih / Ubah Kos
                    </button>
                </div>
            </div>
        @elseif($verify)
            <div class="section-body">
                <div class="mt-3 mb-3">
                    <a class="btn btn-primary" href="{{ route('tagihan') }}">
                        Bayar Kos
                    </a>
                </div>
            </div>
        @else
            <div class="section-body">
                <div class="mt-3 mb-3">
                    <a href="{{ route('verifikasi') }}" class="btn btn-danger">Anda belum melakukan verifikasi diri!</a>
                </div>
            </div>
        @endif

        @if ($verif)
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
                                    <input type="text" class="form-control" value="{{ $item->nama_kos }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Pemilik Kos</label>
                                    <input type="text" class="form-control" value="{{ $item->nama }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Status Pembayaran</label>
                                    <div>
                                        @if ($item->status_bayar == 1)
                                            <span class="badge badge-warning">Menunggu</span>
                                        @elseif ($item->status_bayar == 2)
                                            <span class="badge badge-primary">Menunggu</span>
                                        @elseif ($item->status_bayar == 3)
                                            <span class="badge badge-success">Berhasil</span>
                                        @else
                                            <span class="badge badge-danger">Pembayaran ditolak, silahkan unggah kembali
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
        @endif
    </section>

    <!-- Modal of Pilih Kos -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pendaftaran</h5>
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
                                        <input type="file" class="custom-file-input" name="bukti_bayar" value=""
                                            required>
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
