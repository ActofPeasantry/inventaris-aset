@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Pengesahan Aset Rusak') }}</h1>


    <!-- Project Card Example -->
    <form action="{{ route('pengesahan_aset_rusak.store') }}" method="post">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-gray">Aset yang Diajukan</h6>
            </div>
            <div class="card-body">
                <table id="pengesahan_aset_rusak_table" class="table table-bordered datatable" role="grid">
                    <thead>
                        <tr>
                            <th width="5%">Ceklis</th>
                            <th width="5%">Nama Pelapor</th>
                            <th width="8%">Kode Aset</th>
                            <th width="10%">Nama Aset</th>
                            <th width="10%">Kategori Aset</th>
                            <th width="10%">Status Pengesahan</th>
                            <th width="10%">Jumlah Aset Rusak</th>
                            <th width="10%">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($aset_rusak_data as $aset_rusak)
                            <tr>
                                <td class="text-center">
                                    <input class="aset_rusak_check" type="checkbox" name="aset_rusak_check[]"
                                        id="aset_rusak_check_{{ $aset_rusak->id }}" value="{{ $aset_rusak->id }}">
                                </td>
                                <td>{{ $aset_rusak->user->name }}</td>
                                <td>{{ $aset_rusak->aset->kode_aset }}</td>
                                <td>{{ $aset_rusak->aset->nama_aset }}</td>
                                <td>{{ $aset_rusak->aset->kategoriAset->nama_kategori }}</td>
                                <td>{{ $aset_rusak->status_pengesahan }}</td>
                                <td>{{ $aset_rusak->jumlah_aset_rusak }}</td>
                                <td>{{ $aset_rusak->keterangan }}</td>
                            </tr>
                        @endforeach
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

            if (anyTrue(document.querySelectorAll('.aset_rusak_check'))) {
                checkAllButton.forEach(button => button.disabled = false);
            }
        }

        // Function to check all data when 'Ceklis Seluruh Data' is checked
        function checkedAllTransaksi() {
            const allTransaksi = document.getElementById('all_transaksi');
            allTransaksi.checked = false;

            if (allTrue(document.querySelectorAll('.aset_rusak_check'))) {
                allTransaksi.checked = true;
            }
        }

        // Execute unllockButton() and checkedAllTransaksi() when checkbox whith class 'aset_rusak_check' is checked/unchecked
        document.querySelectorAll('.aset_rusak_check').forEach(checkbox => {
            checkbox.addEventListener('click', function(event) {
                unlockButton();
                checkedAllTransaksi();
            });
        });

        // Check all checkboxes and execute unlockButton() when 'Ceklis Seluruh Data' checkbox is checked
        document.getElementById('all_transaksi').addEventListener('change', function() {
            const transaksiChecks = document.querySelectorAll('.aset_rusak_check');
            const isChecked = this.checked;

            transaksiChecks.forEach(checkbox => {
                checkbox.checked = isChecked;
            });

            unlockButton();
        });
    </script>
@endpush
