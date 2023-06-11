@extends('layout.main')

@section('main-content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4>User Profile</h4>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <form action="{{ route('updateProfile') }}" method="POST" id="form1" name="form1">
                    @csrf
                    <div class="card-header">
                        <h4>Identitas Diri</h4>
                    </div>
                    <div class="card-body">
                        @foreach ($user as $item)
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group" style="min-height: 36.18vh; max-height: 36.18vh;">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-12">
                                                <label>Foto Diri</label>
                                                <img class="d-block w-100" alt="Foto Diri"
                                                    src="{{ url('storage/profiles/pict/') }}/{{ $item->foto }}"
                                                    style="min-height: 32vh; max-height: 32vh; border-radius: 1vh;"
                                                    onerror="this.onerror=null; this.src='{{ url('assets/img/pictures/default-photo.png') }}'">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" name=""
                                            value="{{ $item->username }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" class="form-control" name="nama"
                                            value="{{ $item->nama }}">
                                        @error('nama')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <input type="text" class="form-control" name="alamat"
                                            value="{{ $item->alamat }}">
                                        @error('alamat')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select class="form-control" name="jk">
                                            <option value="{{ $item->jk }}">
                                                @if ($item->jk == 'L')
                                                    Laki - laki
                                                @elseif ($item->jk == 'P')
                                                    Perempuan
                                                @else
                                                    -
                                                @endif
                                            </option>
                                            <option value="L">Laki - laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                        @error('jk')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Lahir</label>
                                        <input type="date" class="form-control" name="tgl_lahir"
                                            value="{{ $item->tgl_lahir }}">
                                        @error('tgl_lahir')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Kota Asal</label>
                                        <input type="text" class="form-control" name="kota_asal"
                                            value="{{ $item->kota_asal }}">
                                        @error('kota_asal')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor HP</label>
                                        <input type="text" class="form-control" name="no_hp"
                                            value="{{ $item->no_hp }}">
                                        @error('no_hp')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Level</label>
                                        <input type="text" class="form-control" name=""
                                            value="{{ $item->role }}" readonly>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="card-footer text-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Perbarui Foto
                        </button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Unggah Foto Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('updateFoto') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <label>Foto</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="foto" required>
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        <div class="mt-3">
                            <img class="d-block w-100" id="foto" alt=""
                                onerror="this.onerror=null; this.src='{{ url('assets/img/pictures/default-photo.png') }}'">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
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
@endsection
