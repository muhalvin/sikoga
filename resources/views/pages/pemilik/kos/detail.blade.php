@extends('layout.main')

@section('main-content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4>Setting Kos</h4>
            </div>
        </div>
        <div class="section-body">
            <div class="mb-3">
                <a href="{{ route('pemilik/kos') }}" class="btn btn-primary">
                    Kembali
                </a>
            </div>
        </div>

        {{-- foto --}}
        <div class="section-body">
            <h2 class="section-title">Foto Kos</h2>
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        @foreach ($kos as $item)
                            <div class="row mt-3">
                                <div class="col-md-4 col-lg-4">
                                    <label>Foto Tampak Depan</label>
                                    <img class="d-block w-100" alt="Foto Diri" src=""
                                        style="min-height: 32vh; max-height: 32vh; border-radius: 1vh;"
                                        onerror="this.onerror=null; this.src='{{ url('assets/img/default/default.jpg') }}'">
                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <label>Foto Tampak Samping</label>
                                    <img class="d-block w-100" alt="Foto Diri" src=""
                                        style="min-height: 32vh; max-height: 32vh; border-radius: 1vh;"
                                        onerror="this.onerror=null; this.src='{{ url('assets/img/default/default.jpg') }}'">
                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <label>Foto Kamar 1</label>
                                    <img class="d-block w-100" alt="Foto Diri" src=""
                                        style="min-height: 32vh; max-height: 32vh; border-radius: 1vh;"
                                        onerror="this.onerror=null; this.src='{{ url('assets/img/default/default.jpg') }}'">
                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <label>Foto Kamar 2</label>
                                    <img class="d-block w-100" alt="Foto Diri" src=""
                                        style="min-height: 32vh; max-height: 32vh; border-radius: 1vh;"
                                        onerror="this.onerror=null; this.src='{{ url('assets/img/default/default.jpg') }}'">
                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <label>Foto Kamar 3</label>
                                    <img class="d-block w-100" alt="Foto Diri" src=""
                                        style="min-height: 32vh; max-height: 32vh; border-radius: 1vh;"
                                        onerror="this.onerror=null; this.src='{{ url('assets/img/default/default.jpg') }}'">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer" style="display: flex; justify-content: flex-end;">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Unggah Foto
                    </button>
                </div>
            </div>
        </div>
        {{-- /foto --}}

        <div class="section-body">
            <h2 class="section-title">Detail Kos</h2>
            @foreach ($kos as $item)
                <form class="needs-validation" novalidate="" action="{{ url('pemilik/update-kos') }}/{{ $item->id }}"
                    method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Nama Kos</label>
                                        <input type="text" class="form-control" name="nama_kos"
                                            value="{{ $item->nama_kos }}" required>
                                        @error('nama_kos')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="invalid-feedback">
                                            Oh no! This field is required.
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <input type="text" class="form-control" name="alamat"
                                            value="{{ $item->alamat }}" required>
                                        @error('alamat')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="invalid-feedback">
                                            Oh no! This field is required.
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Biaya</label>
                                        <input type="text" class="form-control" name="biaya"
                                            value="{{ $item->biaya }}" required>
                                        @error('biaya')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="invalid-feedback">
                                            Oh no! This field is required.
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Nomor HP</label>
                                        <input type="int" class="form-control" name="nomor"
                                            value="{{ $item->nomor }}" maxlength="12" required>
                                        @error('nomor')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="invalid-feedback">
                                            Oh no! This field is required.
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Nomor Telp.</label>
                                        <input type="int" class="form-control" name="nomor_alt"
                                            value="{{ $item->nomor_alt }}" maxlength="12">
                                        @error('nomor_alt')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="invalid-feedback">
                                            Oh no! This field is required.
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Ukuran Kamar</label>
                                        <input type="text" class="form-control" name="ukuran"
                                            value="{{ $item->ukuran }}" required>
                                        @error('ukuran')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="invalid-feedback">
                                            Oh no! This field is required.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Penghuni</label>
                                        <select name="penghuni" class="form-control" required>
                                            <option value="{{ $item->penghuni }}">
                                                @if ($item->penghuni == 'L')
                                                    Laki - laki
                                                @else
                                                    Perempuan
                                                @endif
                                            </option>
                                            <option value="L">Laki - laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                        @error('penghuni')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="invalid-feedback">
                                            Oh no! This field is required.
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control" required>
                                            <option value="{{ $item->status }}">{{ $item->status }}</option>
                                            <option value="Penuh">Penuh</option>
                                            <option value="Tersedia">Tersedia</option>
                                        </select>
                                        @error('status')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="invalid-feedback">
                                            Oh no! This field is required.
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Fasilitas</label>
                                        <textarea class="form-control" name="fasilitas">{{ $item->fasilitas }}</textarea>
                                        @error('fasilitas')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="invalid-feedback">
                                            Oh no! This field is required.
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Peraturan</label>
                                        <textarea class="form-control" name="peraturan">{{ $item->peraturan }}</textarea>
                                        @error('peraturan')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="invalid-feedback">
                                            Oh no! This field is required.
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @endforeach
        </div>
    </section>


    {{-- start modal --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Unggah Foto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#" method="POST" class="needs-validation" novalidate="">
                    @csrf
                    <div class="modal-body">

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
