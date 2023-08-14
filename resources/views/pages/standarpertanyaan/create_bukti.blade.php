@extends('layouts.app')

@section('title', 'Tambah Standar')

@section('content')
    <form action="{{ route('standarpertanyaan.bukti.store',$id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Tambah Bukti</h4>
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
                            <label for="name" class="col-sm-3 col-form-label">Bukti</label>
                            <div class="col-sm-9">
                                <input type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="bukti"
                                    placeholder="URL Google Drive">
                                @error('bukti')
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

