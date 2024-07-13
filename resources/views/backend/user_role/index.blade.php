@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Manajemen User') }}</h1>

    <button type="button" class="btn btn-primary modal-button mb-3 create-button" data-toggle="modal"
        data-target="#modal-add-user-role">
        <i class="fa fa-plus"></i> Tambah User</a>
    </button>

    <div class="row">
        <div class="col-md-10">
            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-gray">Daftar User</h6>
                </div>
                <div class="card-body">
                    <table id="user_role_table" class="table table-bordered datatable" role="grid">
                        <thead>
                            <tr>
                                <th>#id</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user_data as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach ($user->roles->pluck('nama_role') as $user_role)
                                            <span class="badge badge-primary">
                                                {{ $user_role }}
                                            </span>
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class='btn btn-warning edit-button' data-toggle="modal"
                                            data-target="#modal-edit-user-role" data-id="{{ $user->id }}">
                                            <i class="fa fa-edit"></i></a>
                                        </button>
                                        <form action="{{ route('user_role.destroy', [$user->id]) }}" method="post"
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    {{-- Create Modal --}}
    <div id="modal-add-user-role" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('user_role.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        @include('backend.user_role.user_role_form')
                        {{-- Roles --}}
                        <div class="form-group">
                            <label class="form-label" for="activity_name">Role User</label>
                            @foreach ($role_data as $role)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" class="modal-form-check" name="roles[]"
                                        value="{{ $role->id }}">
                                    <label class="form-check-label" for="">{{ $role->nama_role }}</label>
                                </div>
                            @endforeach
                        </div>

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
    @if (count($user_data) > 0)
        <div id="modal-edit-user-role" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Ubah User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="user-role-update-form" action="" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="modal-body">
                            {{-- @include('backend.user_role.user_role_form') --}}
                            <input type="hidden" name="user_id" id="user_id" value="">
                            {{-- Roles --}}
                            <div class="form-group">
                                <label class="form-label" for="activity_name">Role User</label>
                                @foreach ($role_data as $role)
                                    <div class="form-check">
                                        <input class="edit-form-check-input" type="checkbox" class="modal-form-check"
                                            name="roles[]" value="{{ $role->id }}">
                                        <label class="form-check-label" for="">{{ $role->nama_role }}</label>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('child-scripts')
    {{-- Initialize DataTable Plugin For User Role Table --}}
    <script>
        $(function() {
            $('#user_role_table').DataTable({
                "paging": false,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            })
        })
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.edit-button').forEach(function(button) {
                button.addEventListener('click', function() {
                    var id = this.getAttribute('data-id');
                    fetch('/user_role/' + id + '/edit')
                        .then(response => response.json())
                        .then(data => {
                            console.log("Data:", data.user);

                            document.querySelector('#modal-edit-user-role #user_id').value =
                                data.user.id;
                            // document.querySelector('#modal-edit-user-role #nik').value = data
                            //     .user.nik;
                            // document.querySelector('#modal-edit-user-role #name').value = data
                            //     .user.name;
                            // document.querySelector('#modal-edit-user-role #username').value =
                            //     data.user.username;
                            // document.querySelector('#modal-edit-user-role #email').value = data
                            //     .user.email;

                            // Update checkboxes based on user roles
                            const roleIds = data.user_role.map(role => role.role_id);
                            const checkboxes = document.querySelectorAll(
                                "input.edit-form-check-input");
                            checkboxes.forEach(checkbox => {
                                checkbox.checked = roleIds.includes(parseInt(checkbox
                                    .value, 10));
                            });
                            console.log("Checkboxes:", checkboxes);

                            // Update the form action with the new ID
                            document.querySelector('#user-role-update-form').setAttribute(
                                'action', '/user_role/' + id);
                        })
                        .catch(error => {
                            console.error('Error fetching data:', error);
                        });
                });
            });
        });
    </script>
@endpush
