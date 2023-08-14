<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Hasil Audit Mutu Internal - {{ $detail->study_program->name }}</title>
</head>

<body>
    <h1 style="text-align: center">
        Laporan Hasil Audit Mutu Internal
    </h1>
    <table>
        <tr>
            <td>Fakultas</td>
            <td>:</td>
            <td>{{ $detail->faculty->name }}</td>
        </tr>
        <tr>
            <td>Prodi</td>
            <td>:</td>
            <td>{{ $detail->study_program->name }}</td>
        </tr>
        <tr>
            <td>Ketua Audior</td>
            <td>:</td>
            <td>{{ $detail->lead_auditor->name }}</td>
        </tr>
        <tr>
            <td align="top">Anggota Audior</td>
            <td>:</td>
            <td>
                <ul style="margin:0;">
                    <li>{{ $detail->auditor_1->name }}</li>
                    <li>{{ $detail->auditor_2->name }}</li>
                </ul>
            </td>
        </tr>
        <tr>
            <td>Tanggal RTM</td>
            <td>:</td>
            <td>{{ $detail->tanggal_rtm }}</td>
        </tr>
        <tr>
            <td>Kesimpulan</td>
            <td>:</td>
            <td>{{ $detail->kesimpulan }}</td>
        </tr>
        <tr>
            <td>Status</td>
            <td>:</td>
            <td style="text-transform: capitalize">
                <b>{{ $detail->status }}</b>
            </td>
        </tr>
    </table>
    <hr>
    <table width="100%" border="1" style="border-collapse:collapse">
        <tr>
            <th>
                No.
            </th>
            <th>
                Butir Standar
            </th>
            <th>
                Jawaban
            </th>
            <th>
                Skor
            </th>
        </tr>
        @forelse ($detail->audits as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <b>{{ $item->question->standard->name }}</b>
                    <br>
                    {{ $item->question->questionText }}
                </td>
                <td>{{ $item->value->answer }}</td>
                <td>{{ $item->value->score }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4">Tidak ada nilai</td>
            </tr>
        @endforelse
    </table>

</body>

</html>
