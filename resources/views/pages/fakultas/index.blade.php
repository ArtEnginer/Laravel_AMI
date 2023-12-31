@extends('layouts.app')

@section('title', 'Fakultas')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Data Fakultas</h4>
            <div class="card-header-action">
                <a href="{{ route('fakultas.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i>
                    Tambah
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped w-100" id="datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fakultas</th>
                            <th>Dekan</th>
                            <th>NIDN</th>
                            <th>Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            var datatable = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                ajax: {
                    url: "{!! url()->current() !!}"
                },
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, 'ALL']
                ],
                responsive: true,
                order: [
                    [0, 'desc'],
                ],
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'dekan',
                        name: 'dekan'
                    },
                    {
                        data: 'nidn',
                        name: 'nidn'
                    },
                    {
                        data: 'telp',
                        name: 'telp'
                    },
                    {
                        data: 'id',
                        name: 'id'
                    },
                ],
                columnDefs: [{
                    "targets": -1,
                    "render": function(data, type, row, meta) {
                        return `
                        <form action="{{ url('/fakultas') }}/${row.id}" method="POST">
                            @method('DELETE')
                            @csrf
                            <a
                                href="{{ url('/fakultas') }}/${row.id}/edit"
                                class="btn btn-sm btn-warning"
                            >
                                Edit
                            </a>
                            <button
                                type="submit"
                                class="btn-danger btn-delete btn btn-sm"
                            >
                                Delete
                            </button>
                        </form>
                    `;
                    }
                }],
                rowId: function(a) {
                    return a;
                },
                rowCallback: function(row, data, iDisplayIndex) {
                    var info = this.fnPagingInfo();
                    var page = info.iPage;
                    var length = info.iLength;
                    var index = page * length + (iDisplayIndex + 1);
                    $('td:eq(0)', row).html(index);
                },
            });
        });
    </script>
@endpush()
