@extends('layouts.app')

@section('title', 'Tambah Fakultas')

@section('content')
    <form action="{{ route('fakultas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
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
                                <input value="{{ old('name') }}" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                                    placeholder="Nama Fakultas">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dekan" class="col-sm-3 col-form-label">Dekan</label>
                            <div class="col-sm-9">
                                <input value="{{ old('dekan') }}" type="text"
                                    class="form-control @error('dekan') is-invalid @enderror" name="dekan" id="dekan"
                                    placeholder="Dekan">
                                @error('dekan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nidn" class="col-sm-3 col-form-label">NIDN</label>
                            <div class="col-sm-9">
                                <input value="{{ old('nidn') }}" type="text"
                                    class="form-control @error('nidn') is-invalid @enderror" name="nidn" id="nidn"
                                    placeholder="NIDN">
                                @error('nidn')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="telp" class="col-sm-3 col-form-label">Telepon</label>
                            <div class="col-sm-9">
                                <input value="{{ old('telp') }}" type="text"
                                    class="form-control @error('telp') is-invalid @enderror" name="telp" id="telp"
                                    placeholder="Telepon">
                                @error('telp')
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
