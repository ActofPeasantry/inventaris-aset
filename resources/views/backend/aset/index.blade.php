@extends('layouts.admin')

@section('main-content')
    {{-- <button type="button" class="btn btn-primary modal-button mb-3" data-toggle="modal" data-target="#modal-add-aset">
        <i class="fa fa-plus"></i> Tambah Aset</a>
    </button> --}}

    <h1 class="h3 mb-4 text-gray-800">{{ __('Aset') }}</h1>

    <div class="row">
        <div class="col-md-8">
            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-gray">Daftar Aset</h6>
                </div>
                <div class="card-body">
                    <table id="aset_table" class="table table-bordered datatable" role="grid">
                        <thead>
                            <tr>
                                <th width="8%">Kode Aset</th>
                                <th>Nama Aset</th>
                                <th>Kategori Aset</th>
                                <th>Deskripsi Aset</th>
                                <th width="8%">Jumlah Aset</th>
                                <th>Actions</th>
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
                                    <td class="text-center">
                                        <button type="button" class='btn btn-warning edit-button' data-toggle="modal"
                                            data-target="#modal-edit-aset" data-id="{{ $aset->id }}">
                                            <i class="fa fa-edit"></i></a>
                                        </button>
                                        <form action="{{ route('aset.destroy', [$aset->id]) }}" method="post"
                                            style="display: inline">
                                            {{-- Using this for now. pls change it after you implements swalert --}}
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger"
                                                type="submit">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            {{-- {{ method_field('DELETE') }}
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button class="btn btn-danger show_confirm" data-toggle="tooltip">Delete</button> --}}
                                        </form>
                                    </td </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-gray">Tambah Aset</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('aset.store') }}" method="post">
                        @csrf
                        @include('backend.aset.aset_form')
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Create Modal --}}
    <div id="modal-add-aset" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Aset</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('aset.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        @include('backend.aset.aset_form')
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    @if (count($aset_data) > 0)
        <div id="modal-edit-aset" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
            aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Ubah Aset</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="aset-update-form" action="" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="modal-body">
                            @include('backend.aset.aset_form')
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
            $('#aset_table').DataTable({
                "paging": false,
                "lengthChange": true,
                "searching": true,
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
                    url: '/aset/' + id + '/edit',
                    type: 'GET',
                    success: function(data) {
                        console.log(data);
                        $('#modal-edit-aset #nama_aset').val(data.nama_aset);
                        $('#modal-edit-aset #deskripsi_aset').val(data.deskripsi_aset);
                        $('#modal-edit-aset #kode_aset').val(data.kode_aset);
                        $('#modal-edit-aset #kategori_aset_id').val(data.kategori_aset_id);
                        // Update the form action with the new ID
                        $('#aset-update-form').attr('action', '/aset/' + id);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data:', error);
                    }
                });
            });
        });
    </script>
@endpush
