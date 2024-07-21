@extends('layouts.admin')

@section('main-content')
    <!-- Main Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-gray">List Aset Rusak</h6>
        </div>
        <div class="card-body">
            <table id="aset_rusak_table" class="table table-bordered datatable" role="grid">
                <thead>
                    <tr>
                        <th>Nama Aset</th>
                        <th>Keterangan</th>
                        <th>Jumlah Aset</th>
                        <th>Status Pengesahan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($aset_rusak_data as $aset_rusak)
                        <tr>
                            <td>{{ $aset_rusak->aset->nama_aset }}</td>
                            <td>{{ $aset_rusak->keterangan }}</td>
                            <td>{{ $aset_rusak->jumlah_aset_rusak }}</td>
                            <td>{{ $aset_rusak->status_pengesahan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection


@push('child-scripts')
    {{-- Initialize DataTable Plugin For Aset Table --}}
    <script>
        $(function() {
            $('#aset_rusak_table').DataTable({
                "paging": false,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            }).buttons().container().appendTo('#aset_rusak_table .col-md-6:eq(0)');
        })
    </script>
@endpush
