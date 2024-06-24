@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Supplier') }}</h1>

    <div class="row">
        <div class="col-md-8">
            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-gray">Daftar Supplier</h6>
                </div>
                <div class="card-body">
                    <--- Table here --->
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-gray">Tambah Supplier</h6>
                </div>
                <div class="card-body">
                    @include('backend.supplier.supplier_form')
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>

                </div>
            </div>
        </div>
    </div>
@endsection
