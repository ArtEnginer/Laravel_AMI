@extends('layouts.app')

@section('title', 'Ketercapaian')
@section('desc', 'Page Ketercapaian. ')

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
                <td>{{$identity->study_program->name}}</td>
            </tr>
            <tr>
                <td>Fakultas</td>
                <td>:</td>
                <td>{{$identity->faculty->name}}</td>
            </tr>
            <tr>
                <td>Kaprodi</td>
                <td>:</td>
                <td>{{$identity->study_program->kaprodi}}</td>
            </tr>
            <tr>
                <td>NIDN</td>
                <td>:</td>
                <td>{{$identity->study_program->nidn}}</td>
            </tr>
        </table>

        <br>
        <div class="table-responsive">
            <div class="row">
                <div class="col">
                    <a class="btn btn-primary mb-3" href="{{ route('laporan.prodi.print','KETERCAPAIAN') }}">Cetak</a>
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
                            @if ($nilai->score == 4)
                            {{ $nilai->score }}<br />
                            @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($item->rekomendasi as $rekomendasi)
                            {{ $rekomendasi->value }}<br />
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
        var url = "{{ route('laporan.prodi.ketercapaian') }}?year=" + selectedYear;
        window.location.href = url;
    });
</script>
@endpush