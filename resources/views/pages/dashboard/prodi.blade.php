@extends('layouts.app')

@section('title', 'Dashboard')
@section('desc', 'Page Dashboard. ')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table w-100" id="datatable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Status AMI</th>
                            <th>Informasi Audit</th>
                            <th>Laporan AMI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ami as $item)
                            <tr>
                                <td class="align-top py-3">1.</td>
                                <td>
                                    Status Akhir:
                                    <a href="{{ route('dashboard.ubah_status_audit', $item->id) }}"
                                        onclick="return confirm('Yakin ingin ubah status?')"
                                        class="badge {{ $item->status == 'proses' ? 'badge-warning' : 'badge-success' }} text-capitalize">
                                        {{ $item->status }}
                                    </a>
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
