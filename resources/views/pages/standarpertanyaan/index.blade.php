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
        const buktiUrl = "{{ route('standarpertanyaan.bukti', [99999, 55555]) }}";
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
        $('#main-box').on('click', '.btn-audit', function (e) {
            $(".section-header h1").text("AMI");
            $("li.active a span").text("AMI");
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
                        const b = item.bukti != null ? `<a href="${item.bukti?.value}">Bukti</a>` : `
                        <a href="${buktiUrl.replace("99999",planId).replace("55555", item.id)}" class="btn btn-success btn-sm">Tambah Bukti</a>
                        `;
                        const n = item.nilai != null ? item.nilai?.value : `
                            Belum
                        `;
                        const r = item.rekomendasi != null ? item.rekomendasi?.value : `
                            Belum
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
                    console.log(response);
                }
            });
        });
        $('#btn-back').on("click", function (e) {
            $(".section-header h1").text("Dashboard");
            $("li.active a span").text("Dashboard");
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
                                <td>${item.lead_auditor.name}</td>
                                <td>${item.auditor_2.name}</td>
                                <td><button type="button" class="btn btn-success btn-sm btn-audit" data-planId="${item.id}">Audit</button></td>
                            </tr>`);
            })
        }
    </script>
@endpush()