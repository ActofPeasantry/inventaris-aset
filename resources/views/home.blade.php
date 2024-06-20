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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">1</div>
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">1</div>
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
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Aset</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">1</div>
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
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Costumer</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['users'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-500"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <!-- Jumlah Pengadaan Aset  -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Pengadaan Aset
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['users'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-cart-plus fa-2x text-gray-500"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Aset Masuk -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Aset Masuk
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['users'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-circle-plus fa-2x text-gray-500"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Aset Masuk Bulan Ini  -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Jumlah Aset Masuk
                                Bulan
                                Ini
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['users'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-plus fa-2x text-gray-500"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    {{-- End of Counting Cards --}}

    {{-- Alert --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-primary" role="alert">
                <i class="fas fa-info-circle mr-2 fa-lg"></i>
                Saat ini belum ada permintaan aset
            </div>
        </div>
    </div>

    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-6 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-gray">List Permintaan Aset</h6>
                </div>
                <div class="card-body">
                    {{-- Foreach Start Here --}}
                    <div class="list-item">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="row no-gutters align-items-center">
                                    <div class="col">
                                        <div class="text-truncate">
                                            <a href="#" class="text-body d-block">nama_aset</a>
                                            <small class="d-block text-muted  mt-n1">
                                                Kategori : nama_kategori
                                            </small>
                                            <small class="d-block text-muted  mt-n1">
                                                Kuantitas : kuantitas
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Foreach Ends Here --}}
                </div>
            </div>

        </div>

        <!-- Aset Donut -->
        <div class="col-lg-6 mb-4">
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
        </div>
    </div>
@endsection


@push('child-scripts')
    <!-- Page level custom scripts -->
    {{-- <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/demo/chart-bar-demo.js') }}"></script> --}}
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>


    {{-- <script type="text/javascript">
        // Pie Chart Example
        var ctx = document.getElementById("myPieChart").getContext('2d');
        var myPieChart = new Chart(ctx, {
            type: "doughnut",
            data: {
                labels: ["Direct", "Referral", "Social"],
                datasets: [{
                    data: [55, 30, 15],
                    backgroundColor: ["#4e73df", "#1cc88a", "#36b9cc"],
                    hoverBackgroundColor: ["#2e59d9", "#17a673", "#2c9faf"],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: "#dddfeb",
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false,
                },
                cutoutPercentage: 80,
            },
        });
    </script> --}}
@endpush
