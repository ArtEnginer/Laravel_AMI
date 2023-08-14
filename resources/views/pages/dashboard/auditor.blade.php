@extends('layouts.app')

@section('title', 'Dashboard')
@section('desc', 'Page Dashboard. ')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped w-100" id="datatable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Proses Audit</th>
                            <th>Informasi Audit</th>
                            <th>Laporan AMI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ami as $item)
                            <tr>
                                <td class="align-top py-3">{{ $loop->iteration }}.</td>
                                <td>
                                    <div class="row mb-2">
                                        <div class="col">Audit</div>
                                        <div class="col text-right">
                                            @if (!count($item->audits) > 0)
                                                <a href="{{ route('dashboard.audit', $item->id) }}"
                                                    class="badge badge-danger">
                                                    Belum diisi
                                                </a>
                                            @else
                                                <a href="{{ route('dashboard.audit', $item->id) }}"
                                                    class="badge badge-success">
                                                    Sudah diisi
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">Tanggal RTM</div>
                                        <div class="col text-right">
                                            @if (!$item->tanggal_rtm)
                                                <a href="{{ route('dashboard.tanggal_rtm', $item->id) }}"
                                                    class="badge badge-danger">
                                                    Belum diisi
                                                </a>
                                            @else
                                                <a href="{{ route('dashboard.tanggal_rtm', $item->id) }}"
                                                    class="badge badge-success">
                                                    Sudah diisi
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">Kesimpulan</div>
                                        <div class="col text-right">
                                            @if (!$item->kesimpulan)
                                                <a href="{{ route('dashboard.kesimpulan', $item->id) }}"
                                                    class="badge badge-danger">
                                                    Belum diisi
                                                </a>
                                            @else
                                                <a href="{{ route('dashboard.kesimpulan', $item->id) }}"
                                                    class="badge badge-success">
                                                    Sudah diisi
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">Foto Kegiatan</div>
                                        <div class="col text-right">
                                            @if (!$item->foto_kegiatan)
                                                <a href="{{ route('dashboard.foto_kegiatan', $item->id) }}"
                                                    class="badge badge-danger">
                                                    Belum diisi
                                                </a>
                                            @else
                                                <a href="{{ route('dashboard.foto_kegiatan', $item->id) }}"
                                                    class="badge badge-success">
                                                    Sudah diisi
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <p class="mb-0">Prodi: {{ $item->study_program->name }}</p>
                                        <p class="mb-0">Fakultas: {{ $item->faculty->name }}</p>
                                        <p class="mb-0">Ketua Auditor: {{ $item->lead_auditor->name }}</p>
                                        <p class="mb-4">
                                            Anggota Auditor : <br />
                                            - {{ $item->auditor_1->name }} <br />
                                            - {{ $item->auditor_2->name }}
                                        </p>
                                        <p class="mb-4">
                                            Status Akhir:
                                            <span
                                                class="badge {{ $item->status == 'proses' ? 'badge-warning' : 'badge-success' }} text-capitalize">
                                                {{ $item->status }}
                                            </span>
                                        </p>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        @if ($item->status === 'selesai')
                                            <a target="_blank" href="{{ route('laporan.print', $item->id) }}"
                                                class="badge badge-primary">
                                                Print Lap. AMI
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
