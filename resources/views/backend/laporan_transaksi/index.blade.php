@extends('layouts.admin')

@section('main-content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="text-center mt-5">
                <div class="form-group">
                    <form action="{{ route('laporan_transaksi.search') }}" method="POST">
                        @csrf
                        <div class="row">
                            <h5 class="col-1 mt-1 ml-3">Pilih Data</h5>
                            <div class="col-3">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Tujuan Transaksi</span>
                                    </div>
                                    <select class="form-control" name="tujuan_transaksi" id="tujuan_transaksi">
                                        @foreach (transPurposeArray() as $value => $purpose_name)
                                            <option value="{{ $value }}"
                                                {{ $selected_trans_purpose == $value ? 'selected' : '' }}>
                                                {{ $purpose_name }}
                                            </option>
                                        @endforeach
                                        {{-- <option value="0">--Semua Tujuan--</option>
                                        <option value="pengaadaan aset baru">Pengadaan Aset Baru</option>
                                        <option value="pengaduan aset rusak">Pengaduan Aset Rusak</option> --}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Bulan</span>
                                    </div>
                                    <select class="custom-select" name="month" id="month">
                                        @foreach (monthNameArray() as $value => $month_name)
                                            <option value="{{ $value }}"
                                                {{ $selected_month == $value ? 'selected' : '' }}>
                                                {{ $month_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Tahun</span>
                                    </div>
                                    <select class="custom-select" name="year" id="year">
                                        {{-- <option value="0">--Semua Tahun--</option> --}}
                                        @foreach ($years as $key => $year)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group">
                                    <button type="submit" id="search_button" name="search_button"
                                        class="btn btn-primary btn-sm waves-effect waves-light btn">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-gray">Data Transaksi</h6>
        </div>
        <div class="card-body">
            <table id="transaksi_table" class="table table-bordered datatable" role="grid">
                <thead>
                    <tr>
                        <th>Tujuan Transaksi</th>
                        <th>Supplier</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi_data as $transaksi)
                        <tr>
                            <td>{{ $transaksi->tujuan_transaksi }}</td>
                            <td>{{ $transaksi->supplier->nama_supplier }}</td>
                            <td class="text-center">
                                <button type="button" class='btn btn-info show-button' data-toggle="modal"
                                    data-target="#modal-show-laporan-transaksi" data-id="{{ $transaksi->id }}">
                                    <i class="fa fa-circle-info"></i> Detail
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Detail Modal --}}
    <div id="modal-show-laporan-transaksi" class="modal fade" tabindex="-1" role="dialog"
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
            $('#transaksi_table').DataTable({
                "paging": false,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            }).buttons().container().appendTo('#transaksi_table .col-md-6:eq(0)');
        })
    </script>

    {{-- Show Modal --}}
    <script src="{{ asset('js/pages/laporan_transaksi/show_modal.js') }}"></script>
    {{-- Intialize above scripts --}}
    <script src="{{ asset('js/pages/init.js') }}"></script>
@endpush
