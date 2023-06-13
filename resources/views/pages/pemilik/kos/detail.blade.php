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
                                <div class="col-md-4 col-lg-4 mb-5">
                                    <label>Foto Tampak Depan</label>
                                    @error('f_depan')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <img class="d-block w-100" alt="Foto Diri"
                                        src="{{ url('storage/KOS/Foto') }}/{{ $item->f_depan }}"
                                        style="height: 100%; max-height: 25vh; width: 20vh;"
                                        onerror="this.onerror=null; this.src='{{ url('assets/img/default/default.jpg') }}'">
                                </div>
                                <div class="col-md-4 col-lg-4 mb-5">
                                    <label>Foto Tampak Samping</label>
                                    @error('f_samping')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <img class="d-block w-100" alt="Foto Diri"
                                        src="{{ url('storage/KOS/Foto') }}/{{ $item->f_samping }}"
                                        style="height: 100%; max-height: 25vh; width: 20vh; "
                                        onerror="this.onerror=null; this.src='{{ url('assets/img/default/default.jpg') }}'">
                                </div>
                                <div class="col-md-4 col-lg-4 mb-5">
                                    <label>Foto Kamar 1</label>
                                    @error('f_kamar_1')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <img class="d-block w-100" alt="Foto Diri"
                                        src="{{ url('storage/KOS/Foto') }}/{{ $item->f_kamar_1 }}"
                                        style="height: 100%; max-height: 25vh; width: 20vh; "
                                        onerror="this.onerror=null; this.src='{{ url('assets/img/default/default.jpg') }}'">
                                </div>
                                <div class="col-md-4 col-lg-4 mb-5">
                                    <label>Foto Kamar 2</label>
                                    @error('f_kamar_2')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <img class="d-block w-100" alt="Foto Diri"
                                        src="{{ url('storage/KOS/Foto') }}/{{ $item->f_kamar_2 }}"
                                        style="height: 100%; max-height: 25vh; width: 20vh; "
                                        onerror="this.onerror=null; this.src='{{ url('assets/img/default/default.jpg') }}'">
                                </div>
                                <div class="col-md-4 col-lg-4 mb-5">
                                    <label>Foto Kamar 3</label>
                                    @error('f_kamar_3')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <img class="d-block w-100" alt="Foto Diri"
                                        src="{{ url('storage/KOS/Foto') }}/{{ $item->f_kamar_3 }}"
                                        style="height: 100%; max-height: 25vh; width: 20vh; "
                                        onerror="this.onerror=null; this.src='{{ url('assets/img/default/default.jpg') }}'">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer" style="display: flex; justify-content: flex-end; margin-top: -8vh;">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Unggah Foto
                    </button>
                </div>
            </div>
        </div>
        {{-- /foto --}}

        {{-- detail kos --}}
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
        {{-- /detail kos --}}
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
                <form class="needs-validation" novalidate=""
                    action="{{ url('pemilik/update-fotoKos') }}/{{ $id }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <label>Foto Tampak Depan</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile1" name="f_depan"
                                        required>
                                    <label class="custom-file-label">Choose file</label>
                                    <div class="invalid-feedback">
                                        Oh no! This field is required.
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <img class="d-block w-100" id="f_depan" alt=""
                                        onerror="this.onerror=null; this.src='{{ url('assets/img/pictures/default-photo.png') }}'">
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label>Foto Samping</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile2" name="f_samping"
                                        required>
                                    <label class="custom-file-label">Choose file</label>
                                    <div class="invalid-feedback">
                                        Oh no! This field is required.
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <img class="d-block w-100" id="f_samping" alt=""
                                        onerror="this.onerror=null; this.src='{{ url('assets/img/pictures/default-photo.png') }}'">
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label>Foto Lainnya</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile3" name="f_kamar_1"
                                        required>
                                    <label class="custom-file-label">Choose file</label>
                                    <div class="invalid-feedback">
                                        Oh no! This field is required.
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <img class="d-block w-100" id="f_kamar_1" alt=""
                                        onerror="this.onerror=null; this.src='{{ url('assets/img/pictures/default-photo.png') }}'">
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label>Foto Lainnya</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile4" name="f_kamar_2">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                                <div class="mt-3">
                                    <img class="d-block w-100" id="f_kamar_2" alt=""
                                        onerror="this.onerror=null; this.src='{{ url('assets/img/pictures/default-photo.png') }}'">
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label>Foto Lainnya</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile5" name="f_kamar_3">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                                <div class="mt-3">
                                    <img class="d-block w-100" id="f_kamar_3" alt=""
                                        onerror="this.onerror=null; this.src='{{ url('assets/img/pictures/default-photo.png') }}'">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Unggah Foto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end modal --}}

    <script src="https://code.jquery.com/jquery-3.7.0.slim.min.js"
        integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous"></script>

    <script>
        $(function() {
            $('#customFile1').change(function() {
                var input = this;
                var url = $(this).val();
                var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" ||
                        ext == "jpg")) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#f_depan').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    $('#f_depan');
                }
            });

        });
    </script>

    <script>
        $(function() {
            $('#customFile2').change(function() {
                var input = this;
                var url = $(this).val();
                var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" ||
                        ext == "jpg")) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#f_samping').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    $('#f_samping');
                }
            });

        });
    </script>

    <script>
        $(function() {
            $('#customFile3').change(function() {
                var input = this;
                var url = $(this).val();
                var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" ||
                        ext == "jpg")) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#f_kamar_1').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    $('#f_kamar_1');
                }
            });

        });
    </script>

    <script>
        $(function() {
            $('#customFile4').change(function() {
                var input = this;
                var url = $(this).val();
                var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" ||
                        ext == "jpg")) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#f_kamar_2').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    $('#f_kamar_2');
                }
            });

        });
    </script>

    <script>
        $(function() {
            $('#customFile5').change(function() {
                var input = this;
                var url = $(this).val();
                var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" ||
                        ext == "jpg")) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#f_kamar_3').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    $('#f_kamar_3');
                }
            });

        });
    </script>
@endsection
