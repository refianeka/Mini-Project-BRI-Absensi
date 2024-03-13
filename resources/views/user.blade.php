@include('layout.header')
@include('sweetalert::alert')
@include('layout.sidebar')
@include('layout.navbar')

<div class="adminx-content">

    <div class="adminx-main-content">
        <div class="container-fluid">
            <!-- BreadCrumb -->
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb adminx-page-breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('attendance') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Asisten</li>
                </ol>
            </nav>

            <div class="pb-3">
                <h1>Data Asisten</h1>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body collapse show" id="card1">
                            <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#addModal"><i
                                    data-feather="plus"></i>Asisten
                                Baru</button>

                            <table class="table table-actions table-striped table-hover mb-0" data-table>
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            <label class="custom-control custom-checkbox m-0 p-0">
                                                <input type="checkbox" class="custom-control-input table-select-all">
                                                <span class="custom-control-indicator"></span>
                                            </label>
                                        </th>
                                        <th scope="col">ID Asisten</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Join Date</th>
                                        <th scope="col">Jabatan</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <th scope="row">
                                                <label class="custom-control custom-checkbox m-0 p-0">
                                                    <input type="checkbox"
                                                        class="custom-control-input table-select-row">
                                                    <span class="custom-control-indicator"></span>
                                                </label>
                                            </th>
                                            <td>{{ $user->assistant_id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->join_date }}</td>
                                            <td>
                                                @if ($user['role_id'] == 1)
                                                    <span class="badge badge-pill badge-danger">Admin</span>
                                                @elseif ($user['role_id'] == 2)
                                                    <span class="badge badge-pill badge-warning">Staff</span>
                                                @elseif ($user['role_id'] == 3)
                                                    <span class="badge badge-pill badge-info">PJ</span>
                                                @else
                                                    <span class="badge badge-pill badge-primary">Asisten</span>
                                                @endif
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary" data-toggle="modal"
                                                    data-target="#editModal{{ $user->id }}">Edit</button>
                                                <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                    data-target="#deleteModal{{ $user->id }}">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Delete -->
@foreach ($users as $user)
    <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" role="dialog"
        aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('user.delete', ['id' => $user->id]) }}">
                    @csrf
                    @method('delete')
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete Asisten: {{ $user->name }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus {{ $user->name }}?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-danger">Iya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

<!-- Modal for Edit -->
@foreach ($users as $user)
    <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" role="dialog"
        aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('user.update', ['id' => $user->id]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Asisten: {{ $user->name }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12 form-group">
                            <label for="assistant_id"><strong>ID Assistant</strong></label>
                            <input type="text" class="form-control @error('assistant_id') is-invalid @enderror"
                                id="assistant_id" name="assistant_id" value="{{ $user->assistant_id }}" readonly>
                            @error('assistant_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-12 form-group">
                            <label for="name"><strong>Name</strong></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" value="{{ $user->name }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-12 form-group">
                            <label for="role_id"><strong>Role</strong></label>
                            <select class="form-control @error('role_id') is-invalid @enderror" name="role_id"
                                id="role_id">
                                <option value="{{ $user->role_id }}">{{ $user->role->name }}</option>
                                @foreach ($editRoles[$user->id] as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-12 form-group">
                            <label for="photo"><strong>Upload Your Photo</strong></label>
                            <input type="file" class="form-control-file @error('photo') is-invalid @enderror"
                                name="photo" id="photo">
                            @error('photo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-12 form-group">
                            <label for="email"><strong>Email</strong></label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" value="{{ $user->email }}" readonly>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

<!-- Modal for Add -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">
                    Asisten Baru
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('user.store') }}" class="d-inline" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="col-12 form-group">
                        <label for="assistant_id"><strong>ID Assistant</strong></label>
                        <input type="text" class="form-control @error('assistant_id') is-invalid @enderror"
                            id="assistant_id" name="assistant_id" value="">
                        @error('assistant_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-12 form-group">
                        <label for="name"><strong>Name</strong></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-12 form-group">
                        <label for="join_date"><strong>Join Date</strong></label>
                        <input type="date" class="form-control @error('join_date') is-invalid @enderror"
                            name="join_date" id="join_date">
                        @error('join_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-12 form-group">
                        <label for="role_id"><strong>Role</strong></label>
                        <select class="form-control @error('role_id') is-invalid @enderror" name="role_id"
                            id="role_id">
                            <option value="">Select an option</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('role_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-12 form-group">
                        <label for="photo"><strong>Upload Your Photo</strong></label>
                        <input type="file" class="form-control-file @error('photo') is-invalid @enderror"
                            name="photo" id="photo">
                        @error('photo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-12 form-group">
                        <label for="email"><strong>Email</strong></label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                            id="email" name="email" value="">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-12 form-group">
                        <label for="password"><strong>Password</strong></label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" name="password" value="">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-12 form-group">
                        <label for="repeat_password"><strong>Repeat Password</strong></label>
                        <input type="password" class="form-control @error('repeat_password') is-invalid @enderror"
                            id="repeat_password" name="repeat_password" value="">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('layout.footer')
