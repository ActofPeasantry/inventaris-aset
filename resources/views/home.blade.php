@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Dashboard') }}</h1>

    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    {{-- Counting Cards --}}
    <div class="row">

        {{-- Kategori --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Kategori</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $kategori_data->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-folder fa-2x text-gray-500"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Supplier -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Supplier</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $supplier_data->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-truck fa-2x text-gray-500"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Aset -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Pengajuan Aset Baru
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $in_progress_transaksi_data->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-500"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Costumer -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Jumlah Laporan Aset rusak
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $aset_rusak_data->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-500"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- End of Counting Cards --}}

    {{-- Alert --}}
    <div class="row">
        @if ($in_progress_transaksi_data->count() == 0)
            <div class="col-lg-12">
                <div class="alert alert-primary" role="alert">
                    <i class="fas fa-info-circle mr-2 fa-lg"></i>
                    Saat ini belum ada aset baru yang diajukan
                </div>
            </div>
        @endif
    </div>

    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-6 mb-4">
            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-gray">List Pengajuan Aset Baru</h6>
                </div>
                <div class="card-body">
                    @foreach ($in_progress_transaksi_data as $transaksi)
                        <div class="list-item">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col">
                                            <div class="text-truncate">
                                                <a href="#" class="text-body d-block">Nama Pengaju :
                                                    {{ $transaksi->user->name }}</a>
                                                <small class="d-block text-muted  mt-n1">
                                                    Tujuan Transaksi : {{ $transaksi->tujuan_transaksi }}
                                                </small>
                                                @foreach ($transaksi->transaksiDetail as $detail)
                                                    <div class="row">
                                                        <div class="col-2">
                                                            <small class="d-block text-muted  mt-n1">
                                                                Aset : {{ $detail->aset->nama_aset }}
                                                            </small>
                                                        </div>
                                                        <div class="col-2">
                                                            <small class="d-block text-muted  mt-n1">
                                                                Jumlah : {{ $detail->jumlah }}
                                                            </small>
                                                        </div>
                                                        <div class="col-2">
                                                            <small class="d-block text-muted  mt-n1">
                                                                Total biaya : {{ $detail->biaya }}
                                                            </small>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col lg-6 mb 4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-gray">List Pelaporan Aset Rusak</h6>
                </div>
                <div class="card-body">
                    @foreach ($in_progress_aset_rusak_data as $aset_rusak)
                        <div class="list-item">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col">
                                            <div class="text-truncate">
                                                <a href="#" class="text-body d-block">Nama Pengaju :
                                                    {{ $aset_rusak->user->name }}</a>
                                                <div class="row">
                                                    <div class="col-2">
                                                        <small class="d-block text-muted  mt-n1">
                                                            Aset : {{ $aset_rusak->aset->nama_aset }}
                                                        </small>
                                                    </div>
                                                    <div class="col-2">
                                                        <small class="d-block text-muted  mt-n1">
                                                            Jumlah : {{ $aset_rusak->jumlah_aset_rusak }}
                                                        </small>
                                                    </div>
                                                </div>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Aset Donut -->
        {{-- <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-gray">Aset Paling Populer</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <hr>
                    Styling for the donut chart can be found in the
                    <code>/js/demo/chart-pie-demo.js</code> file.
                </div>
            </div>
        </div> --}}
    </div>
@endsection


@push('child-scripts')
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>
@endpush
