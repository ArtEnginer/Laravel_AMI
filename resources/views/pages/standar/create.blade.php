@extends('layouts.app')

@section('title', 'Tambah Standar')

@section('content')
    <form action="{{ route('standar.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Tambah Standar</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Standar</label>
                            <div class="col-sm-9">
                                <input value="{{ old('name') }}" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                                    placeholder="Standar">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="desc" class="col-sm-3 col-form-label">Untuk Pilihan</label>
                            <div class="col-sm-9">
                                <input value="{{ old('desc') }}" type="text"
                                    class="form-control @error('desc') is-invalid @enderror" name="desc" id="desc"
                                    placeholder="Untuk Pilihan">
                                @error('desc')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="value" class="col-sm-3 col-form-label">Isi Standar</label>
                            <div class="col-sm-9">
                                <textarea style="height: 200px" class="form-control summernote-simple @error('value') is-invalid @enderror"
                                    name="value" id="value" placeholder="Isi Standar">{{ old('value') }}</textarea>
                                @error('value')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ url('assets/vendor/summernote/summernote-bs4.css') }}">
@endpush

@push('scripts')
    <script src="{{ url('assets/vendor/summernote/summernote-bs4.js') }}"></script>
    <script>
        $(".summernote-simple").summernote({
            dialogsInBody: true,
            minHeight: 150,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough']],
                ['para', ['paragraph']]
            ]
        });
    </script>
@endpush
