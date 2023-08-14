@extends('layouts.app')

@section('title', 'Tambah AMI')

@section('content')
    <form action="{{ route('ami.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Tambah AMI</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="study_program_id" class="col-sm-3 col-form-label">Prodi</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('study_program_id') is-invalid @enderror"
                                    name="study_program_id" id="study_program_id">
                                    <option value="">-- Pilih Prodi --</option>
                                    @foreach ($study_programs as $item)
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
                            <label for="lead_auditor_id" class="col-sm-3 col-form-label">Auditor</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('lead_auditor_id') is-invalid @enderror"
                                    name="lead_auditor_id" id="lead_auditor_id">
                                    <option value="">-- Pilih Auditor --</option>
                                    @foreach ($auditor as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('lead_auditor_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="auditor_1_id" class="col-sm-3 col-form-label">Anggota Auditor</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('auditor_1_id') is-invalid @enderror" name="auditor_1_id"
                                    id="auditor_1_id">
                                    <option value="">-- Pilih Anggota Auditor 1 --</option>
                                    @foreach ($auditor as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('auditor_1_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tahun" class="col-sm-3 col-form-label">Tahun</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('tahun') is-invalid @enderror" name="tahun"
                                    id="tahun">
                                    <option value="">-- Pilih Tahun --</option>
                                    @foreach ($tahun as $item)
                                        <option value="{{ $item->value }}">{{ $item->value }}</option>
                                    @endforeach
                                </select>                                @error('tahun')
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
