@extends('layouts.app')

@section('title', 'Edit Tahun')

@section('content')
    <form action="{{ route('tahun.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Tambah Tahun</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="value" class="col-sm-3 col-form-label">Tahun</label>
                            <div class="col-sm-9">
                                <input type="number" value="{{ $item->value }}" placeholder="Input Tahun" class="form-control @error('value') is-invalid @enderror" name="value" />
                                @error('value')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Update</button>
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
