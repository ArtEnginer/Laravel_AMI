@extends('layouts.app')

@section('title', 'Standar & Pertanyaan')
@section('desc', 'Page Standar & Pertanyaan. ')

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
                    <td>&nbsp;Sistem Informasi</td>
                </tr>
                <tr>
                    <td>Fakultas</td>
                    <td>:</td>
                    <td>&nbsp;Sains dan Teknologi</td>
                </tr>
                <tr>
                    <td>Ketua Auditor</td>
                    <td>:</td>
                    <td>&nbsp;M. Wildan Ihsani</td>
                </tr>
                <tr>
                    <td>Anggota Auditor</td>
                    <td>:</td>
                    <td>&nbsp;Tsalatsah Maulidi Hasanah</td>
                </tr>
                <tr>
                    <td>Tahun</td>
                    <td>:</td>
                    <td>&nbsp;2023</td>
                </tr>
            </table>
            <br>
            <div class="table-responsive">
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
                                <td>{{ $item->value }}</td>
                                <td>
                                    @foreach($item->pertanyaan as $pertanyaan)
                                        {!! $pertanyaan->questionText !!}
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($item->bukti as $key => $bukti)
                                        <a target="_blank" href="{{ $bukti->value }}"> Bukti {{ $key+1 }} </a> <br/>
                                    @endforeach
                                    <a href="{{ route('standarpertanyaan.bukti',$item->id) }}" class="btn btn-success btn-sm">Tambah Bukti</a>
                                </td>
                                <td>
                                    @foreach($item->score as $nilai)
                                        {{ $nilai->score }}<br/>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($item->rekomendasi as $rekomendasi)
                                        {{ $rekomendasi->value }}<br/>
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
