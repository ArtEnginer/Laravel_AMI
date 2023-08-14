@extends('layouts.app')

@section('title', 'Tambah Auditor')

@section('content')
    <form action="{{ route('auditor.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>User Form</h4>
                    </div>
                    <input type="file" class="d-none" id="avatar" name="avatar">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="study_program_id" class="col-sm-3 col-form-label">Prodi</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('study_program_id') is-invalid @enderror"
                                    name="study_program_id" id="study_program_id">
                                    <option value="">-- Pilih Prodi --</option>
                                    @foreach ($studyPrograms as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('study_program_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="faculty_id" class="col-sm-3 col-form-label">Fakultas</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('faculty_id') is-invalid @enderror" name="faculty_id"
                                    id="faculty_id">
                                    <option value="">-- Pilih Fakultas --</option>
                                    @foreach ($faculties as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('faculty_id')
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
                            <label for="name" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input value="{{ old('name') }}" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                                    placeholder="Nama">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input value="{{ old('email') }}" type="text"
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
                                <input value="{{ old('username') }}" type="text"
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
