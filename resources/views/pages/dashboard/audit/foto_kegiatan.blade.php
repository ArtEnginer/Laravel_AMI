@extends('layouts.app')

@section('title', 'Foto Kegiatan')

@section('content')
    <form action="{{ route('dashboard.upload_foto_kegiatan', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Input Foto Kegiatan</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="foto_kegiatan" class="col-sm-3 col-form-label">Foto Kegiatan AMI</label>
                            <div class="col-sm-9">
                                <div class="custom-file">
                                    <input type="file"
                                        class="custom-file-input @error('foto_kegiatan') is-invalid @enderror"
                                        name="foto_kegiatan" id="foto_kegiatan">
                                    <label class="custom-file-label" for="foto_kegiatan">Choose File</label>
                                </div>
                                <small class="text-muted">jpg/jpeg/png max. 2 MB</small>
                                @error('foto_kegiatan')
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
            @if ($item->foto_kegiatan)
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Foto Kegiatan</h4>
                        </div>
                        <div class="card-body">
                            <img class="w-100" src="{{ $item->foto }}" alt="Foto Kegiatan">
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </form>
@endsection
