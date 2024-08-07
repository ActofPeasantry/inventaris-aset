@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Review Aset') }}</h1>


    <!-- Project Card Example -->
    <form action="{{ route('review_transaksi.store') }}" method="post">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-gray">Aset yang Diajukan</h6>
            </div>
            <div class="card-body">
                <table id="review_transaksi_table" class="table table-bordered datatable" role="grid">
                    <thead>
                        <tr>
                            <th width="5%">Ceklis</th>
                            <th>Nama Pengaju</th>
                            <th>Tujuan Transaksi</th>
                            <th>Supplier</th>
                            <th>Status Pengesahan</th>
                            <th>Status Transaksi</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <div class="" id="checkbox-list">
                            @foreach ($transaksi_data as $transaksi)
                                <tr>
                                    <td class="text-center">
                                        <input class="transaksi_check" type="checkbox" name="transaksi_check[]"
                                            id="transaksi_check_{{ $transaksi->id }}" value="{{ $transaksi->id }}">
                                    </td>
                                    <td>{{ $transaksi->user->name }}</td>
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
                                            data-target="#modal-show-pengesahan-aset" data-id="{{ $transaksi->id }}">
                                            <i class="fa fa-circle-info mr-1"></i>
                                            Detail
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </div>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-2 mt-1 ml-1">
                        <input type="checkbox" id="all_transaksi" name="all_transaksi">
                        <label for="all_transaksi">Ceklis Seluruh Data</label>
                    </div>
                    <div class="col-8">
                        <button id="accept_button" class="btn btn-success check_all_button show_accept" type="submit"
                            disabled>Terima data diceklis</button>
                        <button id="revise_button" class="btn btn-warning check_all_button show_revise" type="submit"
                            disabled>Revisi data diceklis</button>
                        <button id="deny_button" class="btn btn-danger check_all_button show_deny" type="submit"
                            disabled>Tolak data diceklis</button>
                        <input type="hidden" id="check_value" name="check_value" value="">
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
{{-- Detail Modal --}}
<div id="modal-show-pengesahan-aset" class="modal fade" tabindex="-1" role="dialog"
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
                <table class="table table-bordered datatable">
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


@push('child-scripts')
    {{-- put value to status_pengesahan --}}
    <script>
        document.querySelector('.show_accept').addEventListener('click', function() {
            document.getElementById('check_value').value = 'Disetujui';
        });
        document.querySelector('.show_deny').addEventListener('click', function() {
            document.getElementById('check_value').value = 'Ditolak';
        });
        document.querySelector('.show_revise').addEventListener('click', function() {
            document.getElementById('check_value').value = 'Revisi';
        });
    </script>

    {{-- Checkbox Mechanism --}}
    <script>
        // Function to check if any checkbox is checked
        function anyTrue(nodeList) {
            return Array.from(nodeList).some(node => node.checked);
        }

        // Function to check if all checkboxes are checked
        function allTrue(nodeList) {
            return Array.from(nodeList).every(node => node.checked);
        }

        // Function to unlock/lock button when checkbox is checked/unchecked
        function unlockButton() {
            const checkAllButton = document.querySelectorAll('.check_all_button');
            checkAllButton.forEach(button => button.disabled = true);

            if (anyTrue(document.querySelectorAll('.transaksi_check'))) {
                checkAllButton.forEach(button => button.disabled = false);
            }
        }

        // Function to check all data when 'Ceklis Seluruh Data' is checked
        function checkedAllTransaksi() {
            const allTransaksi = document.getElementById('all_transaksi');
            allTransaksi.checked = false;

            if (allTrue(document.querySelectorAll('.transaksi_check'))) {
                allTransaksi.checked = true;
            }
        }

        // Execute unllockButton() and checkedAllTransaksi() when checkbox whith class 'transaksi_check' is checked/unchecked
        document.querySelectorAll('.transaksi_check').forEach(checkbox => {
            checkbox.addEventListener('click', function(event) {
                unlockButton();
                checkedAllTransaksi();
            });
        });

        // Check all checkboxes and execute unlockButton() when 'Ceklis Seluruh Data' checkbox is checked
        document.getElementById('all_transaksi').addEventListener('change', function() {
            const transaksiChecks = document.querySelectorAll('.transaksi_check');
            const isChecked = this.checked;

            transaksiChecks.forEach(checkbox => {
                checkbox.checked = isChecked;
            });

            unlockButton();
        });
    </script>

    {{-- Show Modal --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.show-button').forEach(function(button) {
                button.addEventListener('click', function() {
                    var id = button.getAttribute('data-id');
                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', '/review_transaksi/' + id, true);

                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4) {
                            if (xhr.status === 200) {
                                var data = JSON.parse(xhr.responseText);
                                console.log(data);
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
            var tableBody = document.querySelector('.datatable tbody');
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
@endpush
