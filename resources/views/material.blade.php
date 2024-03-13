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
                    <li class="breadcrumb-item active" aria-current="page">Data Materi</li>
                </ol>
            </nav>

            <div class="pb-3">
                <h1>Data Materi</h1>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body collapse show" id="card1">
                            <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#addModal"><i
                                    data-feather="plus"></i>Materi Baru</button>

                            <table class="table table-actions table-striped table-hover mb-0" data-table>
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            <label class="custom-control custom-checkbox m-0 p-0">
                                                <input type="checkbox" class="custom-control-input table-select-all">
                                                <span class="custom-control-indicator"></span>
                                            </label>
                                        </th>
                                        <th scope="col">Materi</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($materials as $material)
                                        <tr>
                                            <th scope="row">
                                                <label class="custom-control custom-checkbox m-0 p-0">
                                                    <input type="checkbox"
                                                        class="custom-control-input table-select-row">
                                                    <span class="custom-control-indicator"></span>
                                                </label>
                                            </th>
                                            <td>{{ $material->name }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary" data-toggle="modal"
                                                    data-target="#editModal{{ $material->id }}">Edit</button>
                                                <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                    data-target="#deleteModal{{ $material->id }}">Delete</button>
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
@foreach ($materials as $material)
    <div class="modal fade" id="deleteModal{{ $material->id }}" tabindex="-1" role="dialog"
        aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('material.delete', ['id' => $material->id]) }}">
                    @csrf
                    @method('delete')
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete Materi: {{ $material->name }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus {{ $material->name }}?
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
@foreach ($materials as $material)
    <div class="modal fade" id="editModal{{ $material->id }}" tabindex="-1" role="dialog"
        aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('material.update', ['id' => $material->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Materi: {{ $material->name }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="col-12 form-group">
                            <label for="name"><strong>Materi</strong></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" value="{{ $material->name }}">
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
                    Materi Baru
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('material.store') }}" class="d-inline">
                @csrf
                <div class="modal-body">
                    <div class="col-12 form-group">
                        <label for="name"><strong>Materi</strong></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name">
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
