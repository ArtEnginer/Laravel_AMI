@extends('layouts.app')

@section('title', 'Dashboard')
@section('desc', 'Page Dashboard. ')

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
                <td>&nbsp;{{ $user->name }}</td>
            </tr>
            <tr>
                <td>Fakultas</td>
                <td>:</td>
                <td>&nbsp;{{ $user->faculty->name }}</td>
            </tr>
            <tr>
                <td>NIDN</td>
                <td>:</td>
                <td>&nbsp;{{ $user->nidn }}</td>
            </tr>
        </table>
        <br>
        <div class="table-responsive">
            <table class="table w-100" id="datatable">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tahun</th>
                        <th>Ketua Auditor</th>
                        <th>Anggota Auditor</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $item->tahun }}</td>
                        <td>{{ $item->lead_auditor->name }}</td>
                        <td>{{ $item->auditor_2->name }}</td>
                        <td><button type="button" class="btn btn-success btn-sm">Audit</button></td>
                        {{-- <td>{!! $item->value !!}</td>
                        <td>
                            @foreach($item->pertanyaan as $pertanyaan)
                            {!! $pertanyaan->questionText !!}
                            @endforeach
                        </td>

                        <td>
                            @foreach($item->bukti as $key => $bukti)
                            <a target="_blank" href="{{ $bukti->value }}"> Bukti {{ $key+1 }} </a> <br />
                            @endforeach

                            @if(count($item->bukti) == 0)
                            <a href="{{ route('standarpertanyaan.bukti',$item->id) }}" class="btn btn-success btn-sm">Tambah Bukti</a>
                            @endif

                        </td>
                        <td>
                            @foreach($item->score as $nilai)
                            {{ $nilai->score }}<br />
                            @endforeach
                        </td>
                        <td>
                            @foreach($item->rekomendasi as $rekomendasi)
                            {{ $rekomendasi->value }}<br />
                            @endforeach
                        </td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection