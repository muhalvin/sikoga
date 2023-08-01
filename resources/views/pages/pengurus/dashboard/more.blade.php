@extends('layout.main')

@section('main-content')
    <section class="section">

        <div class="card">
            <div class="card-header">
                <h4>Detail Kos</h4>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <a class="btn btn-primary" href="{{ url('pengurus/dashboard') }}">
                Kembali
            </a>
        </div>

        {{-- detail kos --}}
        <div class="section-body">
            <h2 class="section-title">Detail Kos</h2>
            @foreach ($kos as $item)
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Foto Depan</label>
                                    <img src="{{ url('storage/KOS/Foto') }}/{{ $item->f_depan }}" alt="" onerror="this.onerror=null; this.src='{{ url('assets/img/default/default.jpg') }}'"
                                        style="width: 100%; height:100%; max-height: 40vh;">
                                </div>
                                <div class="form-group">
                                    <label>Foto Samping</label>
                                    <img src="{{ url('storage/KOS/Foto') }}/{{ $item->f_samping }}" alt="" onerror="this.onerror=null; this.src='{{ url('assets/img/default/default.jpg') }}'"
                                        style="width: 100%; height:100%; max-height: 40vh;">
                                </div>
                                <div class="form-group">
                                    <label>Foto Lainnya</label>
                                    <img src="{{ url('storage/KOS/Foto') }}/{{ $item->f_kamar_1 }}" alt="" onerror="this.onerror=null; this.src='{{ url('assets/img/default/default.jpg') }}'"
                                        style="width: 100%; height:100%; max-height: 40vh;">
                                </div>
                                <div class="form-group">
                                    <label>Foto Lainnya</label>
                                    <img src="{{ url('storage/KOS/Foto') }}/{{ $item->f_kamar_2 }}" alt="" onerror="this.onerror=null; this.src='{{ url('assets/img/default/default.jpg') }}'"
                                        style="width: 100%; height:100%; max-height: 40vh;">
                                </div>
                                <div class="form-group">
                                    <label>Foto Lainnya</label>
                                    <img src="{{ url('storage/KOS/Foto') }}/{{ $item->f_kamar_3 }}" alt="" onerror="this.onerror=null; this.src='{{ url('assets/img/default/default.jpg') }}'"
                                        style="width: 100%; height:100%; max-height: 40vh;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Kos</label>
                                    <input type="text" class="form-control" value="{{ $item->nama_kos }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Pemilik</label>
                                    <input type="text" class="form-control" value="{{ $item->nama }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" class="form-control" value="{{ $item->alamat }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Biaya</label>
                                    <input type="text" class="form-control" value="@currency($item->biaya)" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Nomor HP</label>
                                    <input type="int" class="form-control" value="{{ $item->nomor }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Nomor Telp.</label>
                                    <input type="int" class="form-control" value="{{ $item->nomor_alt }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Ukuran Kamar</label>
                                    <input type="text" class="form-control" value="{{ $item->ukuran }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Penghuni</label>
                                    @if ($item->penghuni == 'L')
                                        <input type="text" class="form-control" value="Laki - Laki" readonly>
                                    @else
                                        <input type="text" class="form-control" value="Perempuan" readonly>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{-- /detail kos --}}

    </section>
@endsection
