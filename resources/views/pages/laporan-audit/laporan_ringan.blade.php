@extends('layouts.app')

@section('title', 'Temuan Ringan')
@section('desc', 'Page Temuan Ringan. ')

@section('content')
<div class="card">
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

        <table>
            <tr>
                <td>Prodi</td>
                <td>:</td>
                <td>
                    {{ $user->study_program->name}}
                </td>
            </tr>
            <tr>
                <td>Fakultas</td>
                <td>:</td>
                <td>
                    {{ $user->faculty->name}}
                </td>
            </tr>
            <tr>
                <td>Ketua Auditor</td>
                <td>:</td>
                <td>
                    @foreach ($auditorIdentity as $ui)
                    {{ $ui->audit_plan->lead_auditor->name}}
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>Anggota Auditor</td>
                <td>:</td>
                <td>
                    @foreach ($auditorIdentity as $ui)
                    {{ $ui->audit_plan->auditor_1->name}}
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>Tahun</td>
                <td>:</td>
                <td>
                    @foreach ($auditorIdentity as $ui)
                    {{ $ui->audit_plan->tahun}}
                    @endforeach
                </td>
            </tr>
        </table>
        <br>
        <div class="table-responsive">
            <div class="row">
                <div class="col">
                    <a class="btn btn-primary mb-3" href="{{ route('laporan.audit.print','RINGAN') }}">Cetak</a>
                </div>
                <div class="col">
                    <div class="text-right">
                        <select class="form-control" style="display: inline !important;width:100px" name="selected_year" id="selected_year">
                            @foreach ($tahun as $item)
                            <option value="{{ $item->value }}" {{ isset($_GET['year']) && $_GET['year'] == $item->value ? 'selected' : ($item->value == date('Y') ? 'selected' : '') }}>
                                {{ $item->value }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <table class="table w-100" id="datatable">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Standar</th>
                        <th>Pertanyaan</th>
                        <th>Bukti</th>
                        <th>Nilai</th>
                        <th>Rekomendasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{!! $item->value !!}</td>
                        <td>
                            @foreach($item->pertanyaan as $pertanyaan)
                            {!! $pertanyaan->questionText !!}
                            @endforeach
                        </td>
                        <td>
                            @foreach($item->bukti as $key => $bukti)
                            <a target="_blank" href="{{ $bukti->value }}"> Bukti {{ $key+1 }} </a> <br />
                            @endforeach
                        </td>
                        <td>
                            @foreach($item->score as $nilai)
                            @if ($nilai->score == 2 || $nilai->score == 3)
                            {{ $nilai->score }}<br />
                            @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($item->rekomendasi as $rekomendasi)
                            {!! $rekomendasi->value !!}<br />
                            @endforeach
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('selected_year').addEventListener('change', function() {
        var selectedYear = this.value;
        var url = "{{ route('laporan.audit.ringan') }}?year=" + selectedYear;
        window.location.href = url;
    });
</script>
@endpush