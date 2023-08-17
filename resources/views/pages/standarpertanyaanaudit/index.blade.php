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

        <table id="idn">
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>&nbsp;{{ $user->name }}</td>
            </tr>
            <tr>
                <td>NIDN</td>
                <td>:</td>
                <td>&nbsp;{{ $user->nidn }}</td>
            </tr>
            <tr>
                <td>Prodi</td>
                <td>:</td>
                <td>&nbsp;{{ $user->study_program->name }}</td>
            </tr>
            <tr>
                <td>Fakultas</td>
                <td>:</td>
                <td>&nbsp;{{ $user->faculty->name }}</td>
            </tr>
        </table>
        <br>
        <div id="main-box">
            <div class="row">
                <div class="col">
                    {{-- <a class="btn btn-primary mb-3" href="{{ route('laporan.print','ALL') }}">Cetak</a> --}}
                </div>
                <div class="col d-flex justify-content-end align-items-center">
                    <div class="text-right mr-2">
                        <select class="form-control selected-filters" style="display: inline !important;" name="selected_faculty" id="selected_faculty">
                            <option value="none" selected>Semua Fakultas</option>
                            @foreach ($facultys as $item)
                            <option value="{{ $item->id }}" >{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
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
                            <th>Prodi</th>
                            <th>Fakultas</th>
                            <th>Ketua Auditor</th>
                            <th>Anggota Auditor</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($plans as $key => $item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $item->tahun }}</td>
                            <td>{{ $item->study_program->name }}</td>
                            <td>{{ $item->faculty->name }}</td>
                            <td>{{ $item->lead_auditor->name }}</td>
                            <td>{{ $item->auditor_2->name }}</td>
                            <td><button type="button" class="btn btn-success btn-sm btn-audit" data-planId="{{ $item->id }}">Audit</button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <div id="next-box" class="d-none">
            <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-danger btn-sm" id="btn-back">Kembali</button>
                </div>
                <div class="col">
                </div>
            </div>
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $("li.active a span").text("Dashboard");
        const nilauUrl = "{{ route('standarpertanyaan.nilai', [99999, 55555]) }}";
        const rekomUrl = "{{ route('standarpertanyaan.rekomendasi', [99999, 55555]) }}";
        $('.selected-filters').on("change", function () {
            $.ajax({
                type: "GET",
                url: "{!! url()->current() !!}",
                dataType: 'JSON',
                data: {
                    action: "plans",
                    faculty: $("#selected_faculty").val(),
                    year: $("#selected_year").val()
                },
                success: function (response) {
                    createPlans(response);
                }
            });
        });
        $('#main-box').on('click', '.btn-audit', function (e) {
        $("li.active a span").text("AMI");
            $(".section-header h1").text("AMI");
            $("#idn").addClass("d-none");
            $("#main-box").addClass("d-none");
            $("#next-box").removeClass("d-none");
            $("#next-box tbody").empty();
            const planId = e.currentTarget.getAttribute("data-planId");
            $.ajax({
                type: "GET",
                url: "{!! url()->current() !!}",
                dataType: 'JSON',
                data: {
                    action: "audit",
                    plan_id: planId,
                },
                success: (response) => {
                    response.forEach((item, index, arr) => {
                        let q = "";
                        item.pertanyaan.forEach(function(qs, qi){
                            q += `<div>${qs.questionText}</div>`;
                        });
                        const b = item.bukti != null ? `<a href="${item.bukti?.value}">Bukti</a>` : "Belum";
                        const n = item.nilai != null ? item.nilai?.value : `
                            <a href="${nilauUrl.replace("99999",planId).replace("55555", item.id)}" class="btn btn-success btn-sm">Tambah Nilai</a>
                        `;
                        const r = item.rekomendasi != null ? item.rekomendasi?.value : `
                            <a href="${rekomUrl.replace("99999",planId).replace("55555", item.id)}" class="btn btn-success btn-sm">Tambah Rekomendasi</a>
                        `;
                        $("#next-box tbody").append(`<tr>
                                <td>${index + 1}</td>
                                <td>${item.value}</td>
                                <td><div class="d-flex flex-column justify-content-center align-items-center">${q}</div></td>
                                <td>${b}</td>
                                <td>${n}</td>
                                <td>${r}</td>
                                `);
            })
                }
            });
        });
        $('#btn-back').on("click", function (e) {
        $("li.active a span").text("Dashboard");
            $(".section-header h1").text("Dashboard");
            $("#idn").removeClass("d-none");
            $("#next-box").addClass("d-none");
            $("#main-box").removeClass("d-none");
        });

        function createPlans(data = []) {
            $("#main-box tbody").empty();
            data.forEach(function(item, index, arr){
                $("#main-box tbody").append(`<tr>
                                <td>${index + 1}</td>
                                <td>${item.tahun}</td>
                                <td>${item.study_program.name}</td>
                                <td>${item.faculty.name}</td>
                                <td>${item.lead_auditor.name}</td>
                                <td>${item.auditor_2.name}</td>
                                <td><button type="button" class="btn btn-success btn-sm btn-audit" data-planId="${item.id}">Audit</button></td>
                            </tr>`);
            })
        }
    </script>
@endpush()