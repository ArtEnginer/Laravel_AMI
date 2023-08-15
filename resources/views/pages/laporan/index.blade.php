@extends('layouts.app')

@section('title', 'Laporan Hasil AMI')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <div class="row">
                    <div class="col">
                        {{-- <a class="btn btn-primary mb-3" href="{{ route('laporan.print','ALL') }}">Cetak</a> --}}
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
                                {{ $nilai->score }}<br />
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
        var url = "{{ route('laporan.hasil_ami') }}?year=" + selectedYear;
        window.location.href = url;
    });
</script>
@endpush
