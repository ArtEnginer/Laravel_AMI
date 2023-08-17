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

                    {{ $auditorIdentity->audit_plan->lead_auditor->name}}

                </td>
            </tr>
            <tr>
                <td>Anggota Auditor</td>
                <td>:</td>
                <td>

                    {{ $auditorIdentity->audit_plan->auditor_1->name}}

                </td>
            </tr>
            <tr>
                <td>Tahun</td>
                <td>:</td>
                <td>

                    {{ $auditorIdentity->audit_plan->tahun}}

                </td>
            </tr>
        </table>
        <br>
        <div class="table-responsive">
            <table class="table w-100" id="datatable" border="1" cellpadding="8" cellspacing="4" style="border-collapse: collapse">
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
                        <td>
                            @foreach ($item->audits as $audit)
                            {{ $audit->standard->name }}
                            @endforeach
                        <td>
                            @foreach ($item->audits as $audit)
                            @foreach ($audit->standard->pertanyaan as $pertanyaan)
                            {!! $pertanyaan->questionText !!}
                            @endforeach
                            @endforeach
                        </td>
                        <td>
                            @foreach($item->bukti ?? [] as $key => $bukti)

                            <a target="_blank" href="{{ $bukti->value }}"> Bukti {{ $key+1 }} </a> <br />
                            @endforeach
                        </td>
                        <td>
                            @foreach ($item->audits as $nilai)
                            {{ $nilai->value }}
                            @endforeach

                        </td>
                        <td>
                            @foreach($item->standard->rekomendasi?? [] as $rekomendasi)
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

<script>
    window.onload = function() {
        window.print();
    }
</script>