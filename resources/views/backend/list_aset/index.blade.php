@extends('layouts.admin')

@section('main-content')
    <!-- Main Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-gray">Data Aset</h6>
        </div>
        <div class="card-body">
            <table id="aset_table" class="table table-bordered datatable" role="grid">
                <thead>
                    <tr>
                        <th>Kode Aset</th>
                        <th>Nama Aset</th>
                        <th>Kategori Aset</th>
                        <th>Deskripsi Aset</th>
                        <th>Jumlah Aset</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($aset_data as $aset)
                        <tr>
                            <td>{{ $aset->kode_aset }}</td>
                            <td>{{ $aset->nama_aset }}</td>
                            <td>{{ $aset->kategoriAset->nama_kategori }}</td>
                            <td>{{ $aset->deskripsi_aset }}</td>
                            <td>{{ $aset->jumlah_aset }}</td>
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
            $('#aset_table').DataTable({
                "paging": false,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            }).buttons().container().appendTo('#aset_table .col-md-6:eq(0)');
        })
    </script>
@endpush
