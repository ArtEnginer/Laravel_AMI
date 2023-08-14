@extends('layouts.app')

@section('title', 'Laporan Hasil AMI')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
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
                        @forelse ($result as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['score_4'] }}</td>
                                <td>{{ $item['score_3'] }}</td>
                                <td>{{ $item['score_2'] }}</td>
                                <td>{{ $item['score_1'] }}</td>
                                <td>{{ $item['score_0'] }}</td>
                                <td>{{ $item['total_score'] }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">
                                    Belum ada data
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $('#datatable').DataTable();
    </script>
@endpush
