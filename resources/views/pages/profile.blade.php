@extends('layouts.app')

@section('title', 'My Profile')
@section('desc', 'On this page you can edit a your profile information.')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <form action="{{ route('user-profile-information.update') }}" method="POST" class="needs-validation"
                    autocomplete="off">
                    @method('PUT')
                    @csrf
                    <div class="card-header">
                        <h4>Edit Profile</h4>
                    </div>
                    <div class="card-body">
                        @can('auditor')
                            <div class="form-group">
                                <label for="study_program_id">Prodi</label>
                                <select class="form-control @error('study_program_id') is-invalid @enderror"
                                    name="study_program_id" id="study_program_id">
                                    <option value="">-- Pilih Prodi --</option>
                                    @foreach ($prodi as $item)
                                        <option {{ $item->id === auth()->user()->study_program_id ? 'selected' : '' }}
                                            value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('study_program_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="faculty_id">Fakultas</label>
                                <select class="form-control @error('faculty_id') is-invalid @enderror" name="faculty_id"
                                    id="faculty_id">
                                    <option value="">-- Pilih Fakultas --</option>
                                    @foreach ($fakultas as $item)
                                        <option {{ $item->id === auth()->user()->faculty_id ? 'selected' : '' }}
                                            value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('faculty_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @endcan
                        <div class="form-group">
                            <label for="nidn" class="col-sm-3 col-form-label">NIDN</label>
                            <input value="{{ old('nidn', auth()->user()->nidn) }}" type="text"
                                class="form-control @error('nidn') is-invalid @enderror" name="nidn" id="nidn"
                                placeholder="NIDN">
                            @error('nidn')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" id="name" name="name"
                                class="form-control @error('name', 'updateProfileInformation') is-invalid @enderror"
                                value="{{ old('name', auth()->user()->name) }}">
                            @error('name', 'updateProfileInformation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" id="email" name="email"
                                class="form-control @error('email', 'updateProfileInformation') is-invalid @enderror"
                                value="{{ old('email', auth()->user()->email) }}">
                            @error('email', 'updateProfileInformation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" id="username" name="username"
                                class="form-control @error('username', 'updateProfileInformation') is-invalid @enderror"
                                value="{{ old('username', auth()->user()->username) }}">
                            @error('username', 'updateProfileInformation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Save Profile</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <form action="{{ route('user-password.update') }}" method="POST" class="needs-validation"
                    autocomplete="off">
                    @method('PUT')
                    @csrf
                    <div class="card-header">
                        <h4>Change Password</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="current_password" class="d-block">Current Password</label>
                            <input id="current_password" type="password"
                                class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                                name="current_password">
                            @error('current_password', 'updatePassword')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password" class="d-block">New Password</label>
                            <input id="password" type="password"
                                class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                                name="password">
                            @error('password', 'updatePassword')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="d-block">Password Confirmation</label>
                            <input id="password_confirmation" type="password"
                                class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror"
                                name="password_confirmation">
                            @error('password_confirmation', 'updatePassword')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">
                            Save Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Avatar</h4>
                    <div class="card-header-action">
                        <form action="{{ route('remove-profile-avatar') }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-times"></i>
                                Remove
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('change-profile-avatar') }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        @if (auth()->user()->avatar)
                            <img alt="image" src="{{ asset('storage/' . auth()->user()->avatar) }}"
                                class="rounded-circle img-fluid mb-3">
                        @else
                            <img alt="image" src="{{ asset('/assets/img/avatar/avatar-1.png') }}"
                                class="rounded-circle w-100 mb-3">
                        @endif
                        <div class="clearfix"></div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="avatar" id="avatar"
                                onchange="return this.form.submit()">
                            <label class="custom-file-label" for="avatar">Choose Avatar</label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
