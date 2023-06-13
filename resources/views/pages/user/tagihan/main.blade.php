@extends('layout.main')

@section('main-content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4>Tagihan</h4>
            </div>
        </div>
        <div class="section-body">
            <div class="mt-3 mb-3">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Bayar Tagihan
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Histori Tagihan</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-2">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Tanggal Bayar</th>
                                        <th>Bukti Bayar</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($riwayat as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $row->username }}
                                            </td>
                                            <td>
                                                {{ $row->created_at }}
                                            </td>
                                            <td>
                                                <a href="{{ url('storage/Tagihan/KOS') }}/{{ $row->bukti_bayar }}"
                                                    target="_blank" class="btn btn-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                                        viewBox="0 0 512 512">
                                                        <!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                        <path
                                                            d="M448 80c8.8 0 16 7.2 16 16V415.8l-5-6.5-136-176c-4.5-5.9-11.6-9.3-19-9.3s-14.4 3.4-19 9.3L202 340.7l-30.5-42.7C167 291.7 159.8 288 152 288s-15 3.7-19.5 10.1l-80 112L48 416.3l0-.3V96c0-8.8 7.2-16 16-16H448zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm80 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z" />
                                                    </svg>
                                                </a>
                                            </td>
                                            <td>
                                                @if ($row->status == 1)
                                                    <div class="badge badge-warning">Menunggu</div>
                                                @elseif ($row->status == 2)
                                                    <div class="badge badge-primary">Pembayaran Diterima</div>
                                                @elseif ($row->status == 3)
                                                    <div class="badge badge-success">Pembayaran Ditolak</div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Bayar Tagihan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="needs-validation" novalidate="" action="{{ route('storeTagihan') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row mt-3" style="margin-bottom: -5vh;">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group" hidden>
                                    <label>Nama Kos</label>
                                    <input class="form-control" type="text" name="id_kos" value="{{ $kos }}"
                                        required>
                                    <div class="invalid-feedback">
                                        Oh no! You should fill this field.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Bukti Bayar</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" name="bukti_bayar"
                                            required>
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                        <div class="invalid-feedback">
                                            Oh no! You should fill this field.
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mt-3">
                                        <img class="d-block w-100" id="bukti_bayar" alt=""
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
                        $('#bukti_bayar').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    $('#bukti_bayar');
                }
            });

        });
    </script>
@endsection
