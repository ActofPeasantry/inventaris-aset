@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Pengadaan Aset') }}</h1>

    <button type="button" class="btn btn-primary modal-button mb-3" data-toggle="modal" data-target="#modal-add-pengajuan">
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
                        <a id="modal-add-aset" name="modal-add-aset" class="btn btn-secondary mb-2">Tambah Order</a>
                        <div id="aset-container"></div>
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
                <form id="pengajuan-edit-form" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        @include('backend.pengajuan_aset.pengajuan_aset_form')
                        <br>
                        <a id="modal-edit-aset" name="modal-edit-aset" class="btn btn-secondary mb-2">Tambah Order</a>
                        <div id="aset-container"></div>
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

    {{-- Tambah order button script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let asetIndex = 0;

            document.getElementById('modal-add-aset').addEventListener('click', function() {
                fetch(`{{ url('/order-aset-form-template') }}?index=${asetIndex}`)
                    .then(response => response.text())
                    .then(html => {
                        // Designate cloned form placement
                        let asetContainer = document.getElementById('aset-container');
                        // Get all the fields from the url
                        let newAsetForm = document.createElement('div');
                        newAsetForm.innerHTML = html;
                        // Append the cloned form to the container
                        asetContainer.appendChild(newAsetForm);
                        asetIndex++;
                    })
                    .catch(error => console.log('Error:', error));
            });
        });
    </script>

    {{-- Edit Modal --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let asetIndex = 0;

            // Event listener for adding new aset form
            document.getElementById('modal-edit-aset').addEventListener('click', function() {
                fetch(`{{ url('/order-aset-form-template') }}?index=${asetIndex}`)
                    .then(response => response.text())
                    .then(html => {
                        let asetContainer = document.getElementById('aset-container');
                        let newAsetForm = document.createElement('div');
                        newAsetForm.innerHTML = html;
                        asetContainer.appendChild(newAsetForm);
                        asetIndex++;
                    })
                    .catch(error => console.log('Error:', error));
            });

            // Event listener for showing edit modal with prefilled data
            document.querySelectorAll('.edit-button').forEach(button => {
                button.addEventListener('click', function() {
                    var id = button.getAttribute('data-id');
                    console.log('Edit ID:', id);
                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', '/pengajuan_aset/' + id + '/edit', true);

                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4) {
                            if (xhr.status === 200) {
                                var data = JSON.parse(xhr.responseText);
                                console.log('Fetched data:', data[0]);

                                // Select the correct option for tujuan_transaksi
                                let tujuanTransaksiSelect = document.querySelector(
                                    '#modal-edit-pengajuan #tujuan_transaksi');
                                tujuanTransaksiSelect.querySelectorAll('option')
                                    .forEach(option => {
                                        if (option.value === data[0].tujuan_transaksi) {
                                            option.selected = true;
                                        } else {
                                            option.selected = false;
                                        }
                                    });

                                // Select the correct option for supplier_id
                                let supplierIdSelect = document.querySelector(
                                    '#modal-edit-pengajuan #supplier_id');
                                supplierIdSelect.querySelectorAll('option')
                                    .forEach(option => {
                                        if (option.value === data[0].supplier_id) {
                                            option.selected = true;
                                        } else {
                                            option.selected = false;
                                        }
                                    });

                                // Update form action with the record ID
                                document.getElementById('pengajuan-edit-form').action =
                                    `/pengajuan_aset/${id}`;

                                // Show the modal
                                $('#modal-edit-pengajuan').modal('show');

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

    {{-- Show Modal --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.show-button').forEach(function(button) {
                button.addEventListener('click', function() {
                    var id = button.getAttribute('data-id');
                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', '/pengajuan_aset/' + id, true);

                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4) {
                            if (xhr.status === 200) {
                                var data = JSON.parse(xhr.responseText);
                                // console.log(data);
                                updateTable(data); //Call function to update table
                            } else {
                                console.error('Error fetching data:', xhr.statusText);
                            }
                        }
                    };
                    xhr.send();
                });
            });
        });

        function updateTable(data) {
            var tableBody = document.querySelector('.show-modal-table tbody');
            tableBody.innerHTML = ''; //Clear table body

            data.forEach((item) => {
                var row = document.createElement('tr');

                // Create and append cells for 'nama_aset'
                var cellNamaAset = document.createElement('td');
                cellNamaAset.textContent = item.nama_aset;
                row.appendChild(cellNamaAset);

                // Create and append cells for 'jumlah'
                var cellJumlah = document.createElement('td');
                cellJumlah.textContent = item.jumlah;
                row.appendChild(cellJumlah);

                // Create and append cells for 'biaya'
                var cellBiaya = document.createElement('td');
                cellBiaya.textContent = item.biaya;
                row.appendChild(cellBiaya);

                // Append row to table body
                tableBody.appendChild(row);
            })
        }
    </script>

    {{-- Invoice Modal  --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.invoice-button').forEach(button => {
                button.addEventListener('click', function() {
                    var id = button.getAttribute('data-id');
                    console.log('Invoice ID:', id);
                    var transaksiInput = document.querySelector(
                        '#modal-upload-invoice #transaksi_id');
                    transaksiInput.value = id;
                    console.log('Set transaksi_id to:', transaksiInput.value);
                });
            });
        });
    </script>
@endpush
