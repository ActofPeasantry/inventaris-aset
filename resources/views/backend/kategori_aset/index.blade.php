@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Kategori Aset') }}</h1>

    <div class="row">
        <div class="col-md-8">
            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-gray">Daftar Kategori Aset</h6>
                </div>
                <div class="card-body">
                    <table id="kategori_table" class="table table-bordered datatable" role="grid">
                        <thead>
                            <tr>
                                {{-- <th width="5%">No</th> --}}
                                <th>Nama Kategori</th>
                                <th>Tipe kategori</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategori_data as $kategori)
                                <tr>
                                    <td>{{ $kategori->nama_kategori }}</td>
                                    <td>{{ $kategori->tipe_kategori }}</td>
                                    <td class="text-center">
                                        <button type="button" class='btn btn-warning edit-button' data-toggle="modal"
                                            data-target="#modal-edit-kategori" data-id="{{ $kategori->id }}">
                                            <i class="fa fa-edit"></i></a>
                                        </button>
                                        <form action="{{ route('kategori_aset.destroy', [$kategori->id]) }}" method="post"
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
                    <h6 class="m-0 font-weight-bold text-gray">Tambah Kategori Aset</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('kategori_aset.store') }}" method="post">
                        @csrf
                        @include('backend.kategori_aset.kategori_aset_form')
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    @if (count($kategori_data) > 0)
        <div id="modal-edit-kategori" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Ubah Kategori Aset</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="kategori-update-form" action="" method="post">
                        <div class="modal-body">
                            @csrf
                            @method('PATCH')
                            @include('backend.kategori_aset.kategori_aset_form')
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
            $('#kategori_table').DataTable({
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
                    url: '/kategori_aset/' + id + '/edit',
                    type: 'GET',
                    success: function(data) {
                        console.log(data);
                        $('#modal-edit-kategori #nama_kategori').val(data.nama_kategori);
                        $('#modal-edit-kategori #tipe_kategori').val(data.tipe_kategori);
                        // Update the form action with the new ID
                        $('#kategori-update-form').attr('action', '/kategori_aset/' + id);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data:', error);
                    }
                });
            });
        });
    </script>
@endpush
