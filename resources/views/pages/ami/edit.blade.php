@extends('layouts.app')

@section('title', 'Edit Fakultas')

@section('content')
    <form action="{{ route('fakultas.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Tambah Fakultas</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Nama Fakultas</label>
                            <div class="col-sm-9">
                                <input value="{{ old('name', $item->name) }}" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                                    placeholder="Nama Fakultas">
                                @error('name')
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
