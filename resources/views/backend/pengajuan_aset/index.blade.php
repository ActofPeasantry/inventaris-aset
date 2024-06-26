@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Pengajuan Aset') }}</h1>

    <button type="button" class="btn btn-primary modal-button mb-3" data-toggle="modal" data-target="#modal-add-pengajuan">
        <i class="fa fa-plus"></i> Ajukan Aset</a>
    </button>
    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-gray">Pengajuan Aset</h6>
        </div>
        <div class="card-body">
            <table id="pengajuan_aset_table" class="table table-bordered datatable" role="grid">
                <thead>
                    <tr>
                        <th>Tujuan Transaksi</th>
                        <th>Supplier</th>
                        <th>Status Pengesahan</th>
                        <th>Status Transaksi</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi_data as $transaksi)
                        <tr>
                            <td>{{ $transaksi->tujuan_transaksi }}</td>
                            <td>{{ $transaksi->supplier->nama_supplier }}</td>
                            @if ($transaksi->status_pengesahan == null)
                                <td>Belum Diperiksa</td>
                            @endif
                            <td>{{ $transaksi->status_transaksi }}</td>
                            <td class="text-center">
                                <button type="button" class='btn btn-warning edit-button' data-toggle="modal"
                                    data-target="#modal-edit-pengajuan_aset" data-id="{{ $transaksi->id }}">
                                    <i class="fa fa-edit"></i></a>
                                </button>
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
                            </td </tr>
                    @endforeach
                </tbody>
            </table>
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

    {{-- <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            let asetIndex = 0;

            document.getElementById('modal-add-aset').addEventListener('click', function() {
                let asetContainer = document.getElementById('aset-container');
                let newAsetForm = document.createElement('div');

                // Set the HTML of the new form (you can customize this template as needed)
                newAsetForm.innerHTML = `
                    <div class="aset-form">
                        <!-- Replace this with your form fields, ensuring you update the index in the names -->
                        <div class="form-group">
                            <label for="aset_name_${asetIndex}">Aset Name</label>
                            <input type="text" name="aset[${asetIndex}][name]" id="aset_name_${asetIndex}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="aset_description_${asetIndex}">Description</label>
                            <input type="text" name="aset[${asetIndex}][description]" id="aset_description_${asetIndex}" class="form-control" required>
                        </div>
                        <!-- Add more fields as needed -->
                    </div>
                `;

                // Append the new form to the container
                asetContainer.appendChild(newAsetForm);
                asetIndex++;
            });
        });
    </script> --}}

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

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            var totalAmountInput = document.getElementById('total_amount');
            var hiddenTotalAmountInput = document.getElementById('hidden_total_amount');

            totalAmountInput.addEventListener('keyup', function() {
                formatCurrency(this);
                hiddenTotalAmountInput.value = totalAmountInput.value.replace(/\D/g, "");
                console.log(totalAmountInput.value.replace(/\D/g, ""));
            });

            function formatCurrency(input) {
                // get input value
                var input_val = input.value;
                // don't validate empty input
                if (input_val === "") {
                    return;
                }

                // remove all non-digits
                input_val = formatNumber(input_val);
                input_val = "Rp " + input_val;

                // send updated string to input
                input.value = input_val;
            }

            function formatNumber(num) {
                return num.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
        });
    </script> --}}
@endpush
