@extends('errors.layout.main')

@section('main-content')
    <div class="page-error">
        <div class="page-inner">
            <h1>403</h1>
            <div class="page-description">
                You do not have access to this page.
            </div>
            <div class="page-search">
                <form>
                    <div class="form-group floating-addon floating-addon-not-append">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-search"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Search">
                            <div class="input-group-append">
                                <button class="btn btn-primary btn-lg">
                                    Search
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="mt-3">
                    @if (Auth::user()->role == 'Pengurus')
                        <a href="{{ route('pengurus/dashboard') }}">Back to Dashboard</a>
                    @elseif (Auth::user()->role == 'Pemilik')
                        <a href="{{ route('pemilik/dashboard') }}">Back to Dashboard</a>
                    @elseif (Auth::user()->role == 'Anak Kos')
                        <a href="{{ route('dashboard') }}">Back to Dashboard</a>
                    @else
                        <a href="{{ route('login') }}">Back to Dashboard</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
