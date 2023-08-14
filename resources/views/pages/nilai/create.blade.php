@extends('layouts.app')

@section('title', 'Tambah Nilai')

@section('content')
    <form action="{{ route('nilai.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Tambah Nilai</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="standard_id" class="col-sm-3 col-form-label">Standar</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('standard_id') is-invalid @enderror" name="standard_id"
                                    id="standard_id">
                                    <option value="">-- Pilih Standar --</option>
                                    @foreach ($standards as $standard)
                                        <option value="{{ $standard->id }}">
                                            {{ $standard->name }} {{ $standard->desc }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('standard_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="answer" class="col-sm-3 col-form-label">Jawaban</label>
                            <div class="col-sm-9">
                                <textarea style="height: 200px" class="form-control summernote-simple @error('answer') is-invalid @enderror"
                                    name="answer" id="answer" placeholder="Jawaban">{{ old('answer') }}</textarea>
                                @error('answer')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="score" class="col-sm-3 col-form-label">Nilai</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('score') is-invalid @enderror" name="score"
                                    id="score">
                                    @for ($i = 0; $i < 5; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
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
