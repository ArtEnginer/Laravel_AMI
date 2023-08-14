@extends('layouts.app')

@section('title', 'Tanggal RTM')

@section('content')
    <form action="{{ route('dashboard.update_tanggal_rtm', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Input Tanggal RTM</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="tanggal_rtm" class="col-sm-3 col-form-label">Tanggal RTM</label>
                            <div class="col-sm-9">
                                <input value="{{ old('tanggal_rtm', $item->tanggal_rtm) }}" type="text"
                                    class="form-control datepicker @error('tanggal_rtm') is-invalid @enderror"
                                    name="tanggal_rtm" id="tanggal_rtm" placeholder="Tanggal RTM">
                                @error('tanggal_rtm')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ url('assets/vendor/bootstrap-daterangepicker/daterangepicker.css') }}">
@endpush

@push('scripts')
    <script src="{{ url('assets/vendor/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
@endpush
