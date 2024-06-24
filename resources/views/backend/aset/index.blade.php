@extends('layouts.admin')

@section('main-content')
    <button type="button" class="btn btn-primary modal-button mb-3" data-toggle="modal" data-target="#modal-add-aset">
        <i class="fa fa-plus"></i> Tambah Aset</a>
    </button>
    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-gray">Daftar Aset</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered" role="grid">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Aset</th>
                        <th>Kategori Aset</th>
                        <th>Supplier</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    {{-- Create Modal --}}
    <div id="modal-add-aset" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Aset</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('aset.store') }}" method="post">
                    <div class="modal-body">
                        @csrf
                        @include('backend.aset.aset_form')
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
