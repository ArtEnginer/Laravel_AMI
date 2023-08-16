@extends('layouts.app')

@section('title', 'Laporan Hasil AMI')

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-striped w-100" id="datatable">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Program Studi</th>
                        <th>Skor 4</th>
                        <th>Skor 3</th>
                        <th>Skor 2</th>
                        <th>Skor 1</th>
                        <th>Skor 0</th>
                        <th>Total Skor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prodi as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ count($item['skor4']) }}</td>
                            <td>{{ count($item['skor3']) }}</td>
                            <td>{{ count($item['skor2']) }}</td>
                            <td>{{ count($item['skor1']) }}</td>
                            <td>{{ count($item['skor0']) }}</td>
                            <td>{{ count($item['skor0']) + count($item['skor1']) + count($item['skor2']) + count($item['skor3']) + count($item['skor4']) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
    $('#datatable').DataTable();
</script>
@endpush
