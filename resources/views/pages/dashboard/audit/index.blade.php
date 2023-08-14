@extends('layouts.app')

@section('title', 'Audit')

@section('content')
    <div class="card">
        <div class="card-header">
            <button data-toggle="modal" data-target="#auditModal" class="btn btn-primary mr-2" type="button">Tambah</button>
            <a class="btn btn-secondary" href="/dashboard">Kembali</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered w-100">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Butir Standar</th>
                            <th>Jawaban</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($auditPlan->audits as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ $item->question->standard->name }}
                                    -
                                    {{ $item->question->questionText }}
                                </td>
                                <td>
                                    {{ $item->value->standard->name }}
                                    -
                                    {{ $item->value->answer }}
                                </td>
                                <td>
                                    <form action="{{ route('dashboard.delete_audit', $item->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn-danger btn-delete btn btn-sm">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Belum ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="auditModal" data-backdrop="false" tabindex="-1" aria-labelledby="auditModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('dashboard.input_audit') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="auditModalLabel">Input Data Audit</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="audit_plan_id" value="{{ $auditPlan->id }}">
                        <div class="form-group">
                            <label for="question_id">Butir Standar</label>
                            <select name="question_id" id="question_id" class="form-control">
                                @foreach ($question as $q)
                                    <option value="{{ $q->id }}">{{ $q->questionText }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="value_id">Jawaban</label>
                            <select name="value_id" id="value_id" class="form-control">
                                @foreach ($value as $v)
                                    <option value="{{ $v->id }}">{{ $v->answer }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
