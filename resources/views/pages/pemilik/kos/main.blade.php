@extends('layout.main')

@section('main-content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4>Setting Kos</h4>
            </div>
        </div>
        <div class="section-body">
            <div class="mt-3 mb-3">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Tambahkan Kos
                </button>
            </div>
        </div>


        {{-- card --}}
        @foreach ($kos as $item)
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card card-large-icons">
                        <div class="card-icon bg-primary text-white">
                            <img class="d-block w-100" alt="Foto Diri"
                                src="{{ url('storage/profiles/pict/') }}/{{ $item->f_depan }}"
                                style="max-height: 25vh; max-width: 25vh;"
                                onerror="this.onerror=null; this.src='{{ url('assets/img/default/default.jpg') }}'">
                        </div>
                        <div class="card-body">
                            <h4>{{ $item->nama_kos }}</h4>
                            <p>{{ $item->alamat }}</p>
                            <a href="{{ url('pemilik/detail-kos') }}/{{ $item->id }}" class="card-cta">Lihat detail
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </section>




    {{-- start modal --}}
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
                <form action="{{ route('pemilik/storeKos') }}" method="POST" class="needs-validation" novalidate="">
                    @csrf
                    <div class="modal-body">
                        <div class="row mt-3" style="margin-bottom: -5vh;">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Kos</label>
                                    <input type="text" class="form-control" name="nama_kos" required>
                                    @error('nama_kos')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" class="form-control" name="alamat" required>
                                    @error('alamat')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Biaya</label>
                                    <input type="number" class="form-control" name="biaya" required>
                                    @error('biaya')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor HP</label>
                                    <input type="int" class="form-control" name="nomor" maxlength="12" required>
                                    @error('nomor')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Ukuran Kamar</label>
                                    <input type="text" class="form-control" name="ukuran" required>
                                    @error('ukuran')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Penghuni</label>
                                    <select class="form-control" name="penghuni" required>
                                        <option selected></option>
                                        <option value="L">Laki - laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                    @error('penghuni')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
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
    {{-- end modal --}}
@endsection
