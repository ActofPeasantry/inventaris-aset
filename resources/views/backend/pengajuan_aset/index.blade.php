@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Pengadaan Aset') }}</h1>

    <button type="button" class="btn btn-primary modal-button mb-3 create-button" data-toggle="modal"
        data-target="#modal-add-pengajuan">
        <i class="fa fa-plus"></i> Ajukan Aset</a>
    </button>
    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-gray">Data Pengajuan</h6>
        </div>
        <div class="card-body">
            <table id="pengajuan_aset_table" class="table table-bordered datatable" role="grid">
                <thead>
                    <tr>
                        <th>Tujuan Transaksi</th>
                        <th>Supplier</th>
                        <th>Status Pengesahan</th>
                        <th>Status Transaksi</th>
                        <th>Aksi</th>
                        <th>Upload Invoice</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi_data as $transaksi)
                        <tr>
                            <td>{{ $transaksi->tujuan_transaksi }}</td>
                            <td>{{ $transaksi->supplier->nama_supplier }}</td>
                            @if (is_null($transaksi->pengesahanTransaksi))
                                <td>Belum Diperiksa</td>
                            @else
                                <td>{{ $transaksi->pengesahanTransaksi->status_pengesahan }}</td>
                            @endif
                            <td>{{ $transaksi->status_transaksi }}</td>
                            <td class="text-center">
                                <button type="button" class='btn btn-info show-button' data-toggle="modal"
                                    data-target="#modal-show-pengajuan" data-id="{{ $transaksi->id }}">
                                    <i class="fa fa-circle-info"></i>
                                </button>
                                @if (is_null($transaksi->pengesahanTransaksi) || $transaksi->pengesahanTransaksi->status_pengesahan == 'Revisi')
                                    <button type="button" class='btn btn-warning edit-button' data-toggle="modal"
                                        data-target="#modal-edit-pengajuan" data-id="{{ $transaksi->id }}">
                                        <i class="fa fa-edit"></i></a>
                                    </button>
                                @endif

                                <form action="{{ route('pengajuan_aset.destroy', [$transaksi->id]) }}" method="post"
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
                            <td class="text-center">
                                @if (!is_null($transaksi->pengesahanTransaksi) && $transaksi->pengesahanTransaksi->status_pengesahan == 'Disetujui')
                                    <button type="button" class='btn btn-success invoice-button mr-3' data-toggle="modal"
                                        data-target="#modal-upload-invoice" data-id="{{ $transaksi->id }}">
                                        <i class="fa fa-file"></i>
                                        Upload Invoice
                                    </button>
                                @else
                                    <button type="button" class='btn btn-success invoice-button mr-3' data-toggle="modal"
                                        data-target="#modal-upload-invoice" data-id="{{ $transaksi->id }}" disabled>
                                        <i class="fa fa-file"></i>
                                        Upload Invoice
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Upload Invoice Modal --}}
    <div id="modal-upload-invoice" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Upload Invoice</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('pengajuan_aset.upload_invoice') }}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group col-mb-3">
                            <label class="form-label" for="invoice">Upload Invoice</label> <br>
                            <div class="custom-file col-8">
                                <input id="invoice" type="file" class="custom-file-input" name="invoice"
                                    accept="image/*" value="" autocomplete="invoice">
                                <label class="custom-file-label" for="invoice">Pilih Foto</label>
                            </div>
                        </div>
                        <input type="hidden" name="transaksi_id" id="transaksi_id" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Create Modal --}}
    <div id="modal-add-pengajuan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Pengajuan Aset</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('pengajuan_aset.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        @include('backend.pengajuan_aset.pengajuan_aset_form')
                        <br>
                        <a id="create-modal-add-aset" name="create-modal-add-aset" class="btn btn-secondary mb-2">Tambah
                            Order</a>
                        <a id="create-modal-remove-aset" name="create-modal-remove-aset"
                            class="btn btn-danger
                             mb-2">Hapus Order
                        </a>

                        {{-- Aset Container --}}
                        <div id="create-modal-aset-container"></div>
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
    <div id="modal-edit-pengajuan" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Pengajuan Aset</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="pengajuan-edit-form" action="{{ route('pengajuan_aset.update_order') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        @include('backend.pengajuan_aset.pengajuan_aset_form')
                        <input type="hidden" name="transaksi_id" id="transaksi_id" value="">
                        <br>
                        <a id="edit-modal-add-aset" name="edit-modal-add-aset" class="btn btn-secondary mb-2">Tambah
                            Order</a>
                        <a id="edit-modal-remove-aset" name="edit-modal-remove-aset"
                            class="btn btn-danger
                             mb-2">Hapus Order
                        </a>
                        {{-- Aset Container --}}
                        <div id="edit-modal-aset-container"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Detail Modal --}}
    <div id="modal-show-pengajuan" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Detail Aset</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered datatable show-modal-table">
                        <thead>
                            <tr>
                                <th>Nama Aset</th>
                                <th>Jumlah Aset</th>
                                <th>Total Biaya (Rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Populated with javascript below --}}
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('child-scripts')
    {{-- Initialize DataTable Plugin For Aset Table --}}
    <script>
        $(function() {
            $('#pengajuan_aset_table').DataTable({
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
        var orderAsetFormTemplateUrl = "{{ url('/order-aset-form-template') }}";
    </script>
    {{-- Add and remove aset button in create modal --}}
    <script src="{{ asset('js/pages/pengajuan_aset/create_modal.js') }}"></script>
    {{-- Edit Modal --}}
    <script src="{{ asset('js/pages/pengajuan_aset/edit_modal.js') }}"></script>
    {{-- Show Modal --}}
    <script src="{{ asset('js/pages/pengajuan_aset/show_modal.js') }}"></script>
    {{-- Intialize above scripts --}}
    <script src="{{ asset('js/pages/init.js') }}"></script>

    {{-- Invoice Modal  --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.invoice-button').forEach(button => {
                button.addEventListener('click', function() {
                    var id = button.getAttribute('data-id');
                    // console.log('Invoice ID:', id);
                    var transaksiInput = document.querySelector(
                        '#modal-upload-invoice #transaksi_id');
                    transaksiInput.value = id;
                    // console.log('Set transaksi_id to:', transaksiInput.value);
                });
            });
        });
    </script>
@endpush
