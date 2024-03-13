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
                    <li class="breadcrumb-item active" aria-current="page">Data Kelas</li>
                </ol>
            </nav>

            <div class="pb-3">
                <h1>Data Kelas</h1>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body collapse show" id="card1">
                            <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#addModal"><i
                                    data-feather="plus"></i>Kelas Baru</button>

                            <table class="table table-actions table-striped table-hover mb-0" data-table>
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            <label class="custom-control custom-checkbox m-0 p-0">
                                                <input type="checkbox" class="custom-control-input table-select-all">
                                                <span class="custom-control-indicator"></span>
                                            </label>
                                        </th>
                                        <th scope="col">Jurusan</th>
                                        <th scope="col">Fakultas</th>
                                        <th scope="col">Tingkat</th>
                                        <th scope="col">Nama Kelas</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($classes as $class)
                                        <tr>
                                            <th scope="row">
                                                <label class="custom-control custom-checkbox m-0 p-0">
                                                    <input type="checkbox"
                                                        class="custom-control-input table-select-row">
                                                    <span class="custom-control-indicator"></span>
                                                </label>
                                            </th>
                                            <td>{{ $class->major }}</td>
                                            <td>{{ $class->faculty }}</td>
                                            <td>{{ $class->level }}</td>
                                            <td>{{ $class->name }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary" data-toggle="modal"
                                                    data-target="#editModal{{ $class->id }}">Edit</button>
                                                <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                    data-target="#deleteModal{{ $class->id }}">Delete</button>
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
@foreach ($classes as $class)
    <div class="modal fade" id="deleteModal{{ $class->id }}" tabindex="-1" role="dialog"
        aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('class.delete', ['id' => $class->id]) }}">
                    @csrf
                    @method('delete')
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete Kelas: {{ $class->name }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus {{ $class->name }}?
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
@foreach ($classes as $class)
    <div class="modal fade" id="editModal{{ $class->id }}" tabindex="-1" role="dialog"
        aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('class.update', ['id' => $class->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Kelas: {{ $class->name }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12 form-group">
                            <label for="major"><strong>Major</strong></label>
                            <input type="text" class="form-control @error('major') is-invalid @enderror"
                                id="major" name="major" value="{{ $class->major }}">
                            @error('major')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-12 form-group">
                            <label for="faculty"><strong>Faculty</strong></label>
                            <input type="text" class="form-control @error('faculty') is-invalid @enderror"
                                id="faculty" name="faculty" value="{{ $class->faculty }}">
                            @error('faculty')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-12 form-group">
                            <label for="level"><strong>Level</strong></label>
                            <input type="text" class="form-control @error('level') is-invalid @enderror"
                                id="level" name="level" value="{{ $class->level }}">
                            @error('level')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-12 form-group">
                            <label for="name"><strong>Class Name</strong></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" value="{{ $class->name }}">
                            @error('name')
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
            <form method="POST" action="{{ route('class.store') }}" class="d-inline">
                @csrf
                <div class="modal-body">
                    <div class="col-12 form-group">
                        <label for="major"><strong>Major</strong></label>
                        <input type="text" class="form-control @error('major') is-invalid @enderror"
                            id="major" name="major">
                        @error('major')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-12 form-group">
                        <label for="faculty"><strong>Faculty</strong></label>
                        <input type="text" class="form-control @error('faculty') is-invalid @enderror"
                            id="faculty" name="faculty">
                        @error('faculty')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-12 form-group">
                        <label for="level"><strong>Level</strong></label>
                        <input type="text" class="form-control @error('level') is-invalid @enderror"
                            id="level" name="level">
                        @error('level')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-12 form-group">
                        <label for="name"><strong>Class Name</strong></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" placeholder="cth: 4KAXX">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
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
