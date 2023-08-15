@extends('layouts.app')

@section('title', 'Tambah Nilai')

@section('content')
<form action="{{ url()->current() }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Form Tambah Nilai</h4>
                </div>
                <div class="card-body">
                    @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                    @endif
                    <div class="form-group row">
                        <label for="score" class="col-sm-3 col-form-label">Nilai</label>
                        <div class="col-sm-9">
                            <select class="form-control @error('score') is-invalid @enderror" name="score" id="score">
                                <option value="0">0</option>
                                @foreach ($nilai as $n)
                                <option value="{{ $n->id }}">{{ $n->score }}</option>
                                @endforeach
                            </select>
                            @error('score')
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