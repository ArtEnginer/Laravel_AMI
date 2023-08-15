@extends('layouts.app')

@section('title', 'Tahun')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Data Tahun</h4>
            <div class="card-header-action">
                <a href="{{ route('tahun.create') }}" class="btn btn-primary">
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
                            <th>Tahun</th>
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
                        data: 'value',
                        name: 'value'
                    },
                    {
                        data: 'id',
                        name: 'id'
                    },
                ],
                columnDefs: [{
                    "targets": [0, 1],
                    "render": function(data, type, row, meta) {
                        const e = document.createElement('div');
                        e.innerHTML = data;
                        return e.innerText
                    }
                }, {
                    "targets": -1,
                    "render": function(data, type, row, meta) {
                        return `
                        <form action="{{ url('/tahun') }}/${row.id}" method="POST">
                            @method('DELETE')
                            @csrf
                                <a
                                    href="{{ url('/tahun') }}/${row.id}/edit"
                                    class="btn btn-sm btn-warning"
                                >
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button
                                    type="submit"
                                    class="btn-danger btn-delete btn btn-sm"
                                >
                                    <i class="fas fa-trash"></i>
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
