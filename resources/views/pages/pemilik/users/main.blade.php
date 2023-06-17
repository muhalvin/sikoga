@extends('layout.main')

@section('main-content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4>Penghuni Kos</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Penghuni KOS</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-2">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Nomor HP</th>
                                        <th>KOS</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($penghuni as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->nama }}</td>
                                            <td>{{ $row->no_hp }}</td>
                                            <td>{{ $row->nama_kos }}</td>
                                            <td>
                                                @if ($row->verifikasi == 3)
                                                    <div class="badge badge-success">Terverifikasi</div>
                                                @else
                                                    <div class="badge badge-danger">Belum Terverifikasi</div>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
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
@endsection
