@extends('layouts.app')

@section('title', 'Edit Prodi')

@section('content')
    <form action="{{ route('prodi.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>User Form</h4>
                    </div>
                    <input type="file" class="d-none" id="avatar" name="avatar">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Nama Prodi</label>
                            <div class="col-sm-9">
                                <input value="{{ old('name', $item->name) }}" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                                    placeholder="Nama Prodi">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kaprodi" class="col-sm-3 col-form-label">Kaprodi</label>
                            <div class="col-sm-9">
                                <input value="{{ old('kaprodi', $item->kaprodi) }}" type="text"
                                    class="form-control @error('kaprodi') is-invalid @enderror" name="kaprodi"
                                    id="kaprodi" placeholder="Kaprodi">
                                @error('kaprodi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nidn" class="col-sm-3 col-form-label">NIDN</label>
                            <div class="col-sm-9">
                                <input value="{{ old('nidn', $item->nidn) }}" type="text"
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
                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input value="{{ old('email', $item->email) }}" type="text"
                                    class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                                    placeholder="Email">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-9">
                                <input value="{{ old('username', $item->username) }}" type="text"
                                    class="form-control @error('username') is-invalid @enderror" name="username"
                                    id="username" placeholder="Username">
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" id="password" placeholder="Password">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password_confirmation" class="col-sm-3 col-form-label">Confirm Password</label>
                            <div class="col-sm-9">
                                <input type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    name="password_confirmation" id="password_confirmation" placeholder="Password">
                                @error('password_confirmation')
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
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Avatar</h4>
                    </div>
                    <div class="card-body">
                        <img alt="image" src="{{ asset('/assets/img/avatar/avatar-1.png') }}"
                            class="rounded-circle w-100 mb-3">
                        <div class="clearfix"></div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="avatar" name="avatar">
                            <label class="custom-file-label" for="avatar">Choose Avatar</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
