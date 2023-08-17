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
            <tr>
                <td>Ketua Auditor</td>
                <td>:</td>
                <td>{{$identity->lead_auditor->name}}</td>
            </tr>
            <tr>
                <td>Anggota Auditor</td>
                <td>:</td>
                <td>{{$identity->auditor_1->name}}</td>
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
                        <td>{!! $item->value !!}</td>
                        <td>
                            @foreach($item->pertanyaan as $pertanyaan)
                            {!! $pertanyaan->questionText !!}
                            @endforeach
                        </td>
                        <td>
                            @foreach($item->bukti as $key => $bukti)
                            <p>{{ $bukti->value }}</p>
                            @endforeach
                        </td>
                        <td>
                            @foreach($item->score as $nilai)
                            @if ($type == 'ALL')
                            {{ $nilai->score }}<br />
                            @elseif($type == 'KETERCAPAIAN')
                            @if ($nilai->score == 4)
                            {{ $nilai->score }}<br />
                            @endif
                            @elseif($type == 'RINGAN')
                            @if ($nilai->score == 2 || $nilai->score == 3)
                            {{ $nilai->score }}<br />
                            @endif
                            @elseif($type == 'BERAT')
                            @if ($nilai->score == 0 || $nilai->score == 1)
                            {{ $nilai->score }}<br />
                            @endif
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

<script>
    window.onload = function() {
        window.print();
    }
</script>