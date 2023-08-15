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
        <div id="main-box">
            <div class="row">
                <div class="col">
                    {{-- <a class="btn btn-primary mb-3" href="{{ route('laporan.print','ALL') }}">Cetak</a> --}}
                </div>
                <div class="col d-flex justify-content-end align-items-center">
                    <div class="text-right">
                        <select class="form-control selected-filters" style="display: inline !important;" name="selected_year" id="selected_year">
                            <option value="none" selected>Semua Tahun</option>
                            @foreach ($tahun as $item)
                            <option value="{{ $item->value }}" >{{ $item->value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
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
</div>
@endsection

@push('scripts')
    <script>
        $('.selected-filters').on("change", function () {
            $.ajax({
                type: "GET",
                url: "{!! url()->current() !!}",
                dataType: 'JSON',
                data: {
                    action: "plans",
                    year: $("#selected_year").val()
                },
                success: function (response) {
                    createPlans(response);
                }
            });
        });

        function createPlans(data = []) {
            $("#main-box tbody").empty();
            data.forEach(function(item, index, arr){
                $("#main-box tbody").append(`<tr>
                                <td>${index + 1}</td>
                                <td>${item.tahun}</td>
                                <td>${item.lead_auditor.name}</td>
                                <td>${item.auditor_2.name}</td>
                                <td><button type="button" class="btn btn-success btn-sm btn-audit" data-planId="${item.id}">Audit</button></td>
                            </tr>`);
            })
        }
    </script>
@endpush()