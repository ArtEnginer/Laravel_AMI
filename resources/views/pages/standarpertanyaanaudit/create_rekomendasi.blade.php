@extends('layouts.app')

@section('title', 'Tambah Rekomendasi')

@section('content')
<form action="{{ route('standarpertanyaan.rekomendasi.store',$id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Form Tambah Rekomendasi</h4>
                </div>
                <div class="card-body">
                    @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                    @endif

                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    <div class="form-group row">
                        <label for="value" class="col-sm-3 col-form-label">Rekomendasi</label>
                        <div class="col-sm-9">
                            <textarea class="form-control summernote-simple" name="value" placeholder="Tambah Rekomendasi" rows="4"></textarea>

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