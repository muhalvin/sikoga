@extends('layout.main')

@section('main-content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4>Verifikasi</h4>
            </div>
        </div>
        <div class="section-body">

            @if ($verify)
            @else
                <div class="mt-3 mb-3">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Buat Pendaftaran Baru
                    </button>
                </div>
            @endif
            @foreach ($pendaftaran as $item)
                <div class="card">
                    <form action="{{ url('updateVerifikasi') }}/{{ $item->id }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <h4>Verifikasi Identitas</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group" hidden>
                                        <label>Username</label>
                                        <input type="text" class="form-control" name="username"
                                            value="{{ $username }}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Surat Keterangan</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFoto" name="surat_ket"
                                                required>
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                        @error('surat_ket')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="mt-3">
                                            <img class="d-block w-100" id="surat" alt="Foto Diri"
                                                src="{{ url('storage/Pendaftaran/SRT') }}/{{ $item->surat_ket }}"
                                                style="min-height: 32vh; max-height: 32vh; border-radius: 0.5vh; border: 2px solid gray"
                                                onerror="this.onerror=null; this.src='{{ url('assets/img/pictures/default-photo.png') }}'">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        @if ($item->verifikasi == 1)
                                            <div class="mt-2">
                                                <span class="badge badge-warning">Menunggu verifikasi Pengurus</span>
                                            </div>
                                        @elseif ($item->verifikasi == 2)
                                            <div class="mt-2">
                                                <span class="badge badge-primary">Menunggu verifikasi Pemilik</span>
                                            </div>
                                        @elseif ($item->verifikasi == 3)
                                            <div class="mt-2">
                                                <span class="badge badge-success">Pendaftaran Terverifikasi</span>
                                            </div>
                                        @elseif ($item->verifikasi == 4)
                                            <div class="mt-2">
                                                <span class="badge badge-danger">Pendaftaran Ditolak</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right" style="margin-top: -2vh;">
                            <button type="submit" class="btn btn-success"
                                onclick="return confirm('Proses verifikasi akan dimulai dari awal, anda yakin?')">
                                Kirim Ulang
                            </button>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pendaftaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('createVerifikasi') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row mt-3" style="margin-bottom: -5vh;">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group" hidden>
                                    <label>Username</label>
                                    <input type="text" class="form-control" name="username" value="{{ $username }}"
                                        readonly>
                                </div>

                                <div class="form-group">
                                    <label>Surat Keterangan</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" name="surat_ket"
                                            required>
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                    @error('surat_ket')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="mt-3">
                                        <img class="d-block w-100" id="foto" alt=""
                                            onerror="this.onerror=null; this.src='{{ url('assets/img/pictures/default-photo.png') }}'">
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

    <script src="https://code.jquery.com/jquery-3.7.0.slim.min.js"
        integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous"></script>

    <script>
        $(function() {
            $('#customFile').change(function() {
                var input = this;
                var url = $(this).val();
                var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" ||
                        ext == "jpg")) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#foto').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    $('#foto');
                }
            });

        });
    </script>

    <script>
        $(function() {
            $('#customFoto').change(function() {
                var input = this;
                var url = $(this).val();
                var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" ||
                        ext == "jpg")) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#surat').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    $('#surat');
                }
            });

        });
    </script>
@endsection
