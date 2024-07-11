@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Pelaporan Aset Rusak') }}</h1>

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
                                <th width="8%">Jumlah Aset Rusak</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($aset_rusak_data as $aset_rusak)
                                <tr>
                                    <td>{{ $aset_rusak->aset->kode_aset }}</td>
                                    <td>{{ $aset_rusak->aset->nama_aset }}</td>
                                    <td>{{ $aset_rusak->aset->kategoriAset->nama_kategori }}</td>
                                    <td>{{ $aset_rusak->jumlah_aset_rusak }}</td>
                                    <td class="text-center">
                                        <button type="button" class='btn btn-warning edit-button' data-toggle="modal"
                                            data-target="#modal-edit-aset-rusak" data-id="{{ $aset_rusak->id }}">
                                            <i class="fa fa-edit"></i></a>
                                        </button>
                                        <form action="{{ route('pelaporan_aset_rusak.destroy', [$aset_rusak->id]) }}"
                                            method="post" style="display: inline">
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
                    <h6 class="m-0 font-weight-bold text-gray">Laporkan Aset Rusak</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('pelaporan_aset_rusak.store') }}" method="post">
                        @csrf
                        @include('backend.pelaporan_aset_rusak.aset_rusak_form')
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- Edit Modal --}}
    @if (count($aset_rusak_data) > 0)
        <div id="modal-edit-aset-rusak" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Ubah Aset</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="aset-rusak-update-form" action="" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="modal-body">
                            @include('backend.pelaporan_aset_rusak.aset_rusak_form')
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

    {{-- Edit Modal --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.edit-button').forEach(function(button) {
                button.addEventListener('click', function() {
                    var id = button.getAttribute('data-id');
                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', '/pelaporan_aset_rusak/' + id + '/edit', true);

                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4) {
                            if (xhr.status === 200) {
                                var data = JSON.parse(xhr.responseText);
                                console.log(data);

                                // Set the selected option for aset_id
                                let asetSelect = document.querySelector(
                                    '#modal-edit-aset-rusak #aset_id'
                                );
                                asetSelect.querySelectorAll('option').forEach(option => {
                                    if (option.value == data.aset_id) {
                                        option.selected = true;
                                    } else {
                                        option.selected = false;
                                    }
                                });
                                // put jumlah_aset_rusak value based on id
                                document.querySelector(
                                        '#modal-edit-aset-rusak #jumlah_aset_rusak').value =
                                    data.jumlah_aset_rusak;

                                // put jumlah_aset_rusak to old_jumlah_aset_rusak
                                document.querySelector(
                                        '#modal-edit-aset-rusak #old_jumlah_aset_rusak').value =
                                    data.jumlah_aset_rusak;

                                // put aset_id to old_aset_id
                                document.querySelector(
                                        '#modal-edit-aset-rusak #old_aset_id').value =
                                    data.aset_id;

                                document.querySelector('#aset-rusak-update-form').setAttribute(
                                    'action', '/pelaporan_aset_rusak/' + id);
                            } else {
                                console.error('Error fetching data:', xhr.statusText);
                            }
                        }
                    };

                    xhr.send();
                });
            });
        });
    </script>
@endpush
