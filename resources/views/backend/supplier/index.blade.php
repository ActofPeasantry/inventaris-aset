@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Supplier') }}</h1>

    <div class="row">
        <div class="col-md-8">
            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-gray">Daftar Supplier</h6>
                </div>
                <div class="card-body">
                    <table id="supplier_table" class="table table-bordered datatable" role="grid">
                        <thead>
                            <tr>
                                {{-- <th width="5%">No</th> --}}
                                <th>Nama Supplier</th>
                                <th>No. Telepon</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($supplier_data as $supplier)
                                <tr>
                                    <td>{{ $supplier->nama_supplier }}</td>
                                    <td>{{ $supplier->no_telp_supplier }}</td>
                                    <td>{{ $supplier->alamat_supplier }}</td>
                                    <td class="text-center">
                                        <button type="button" class='btn btn-warning edit-button' data-toggle="modal"
                                            data-target="#modal-edit-supplier" data-id="{{ $supplier->id }}" title="Edit">
                                            <i class="fa fa-edit"></i></a>
                                        </button>
                                        <form action="{{ route('supplier.destroy', [$supplier->id]) }}" method="post"
                                            style="display: inline">
                                            {{-- Using this for now. pls change it after you implements swalert --}}
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger"
                                                type="submit" title="Hapus">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            {{-- {{ method_field('DELETE') }}
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button class="btn btn-danger show_confirm" data-toggle="tooltip">Delete</button> --}}
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-gray">Tambah Supplier</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('supplier.store') }}" method="post">
                        @csrf
                        @include('backend.supplier.supplier_form')
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    @if (count($supplier_data) > 0)
        <div id="modal-edit-supplier" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Ubah Supplier</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="supplier-update-form" action="" method="post">
                        <div class="modal-body">
                            @csrf
                            @method('PATCH')
                            @include('backend.supplier.supplier_form')
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('child-scripts')
    {{-- Initialize DataTable Plugin For Aset Table --}}
    <script>
        $(function() {
            $('#supplier_table').DataTable({
                "paging": false,
                "lengthChange": true,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            })
        })
    </script>

    <script>
        $(document).ready(function() {
            $('.edit-button').on('click', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: '/supplier/' + id + '/edit',
                    type: 'GET',
                    success: function(data) {
                        console.log(data);
                        $('#modal-edit-supplier #nama_supplier').val(data.nama_supplier);
                        $('#modal-edit-supplier #no_telp_supplier').val(data.no_telp_supplier);
                        $('#modal-edit-supplier #alamat_supplier').val(data.alamat_supplier);
                        // Update the form action with the new ID
                        $('#supplier-update-form').attr('action', '/supplier/' + id);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data:', error);
                    }
                });
            });
        });
    </script>
@endpush
