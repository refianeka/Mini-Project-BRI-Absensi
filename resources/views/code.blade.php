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
                    <li class="breadcrumb-item active" aria-current="page">Kode Absen</li>
                </ol>
            </nav>

            <div class="pb-3">
                <h1>Kode Absen</h1>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body collapse show" id="card1">
                            <button class="btn btn-primary btn-block" data-toggle="modal"
                                data-target="#generateModal"><i data-feather="plus"></i>Generate Kode
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
                                        <th scope="col">Kode</th>
                                        <th scope="col">Pembuat Kode</th>
                                        <th scope="col">Status Kode</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($codes as $code)
                                        <tr>
                                            <th scope="row">
                                                <label class="custom-control custom-checkbox m-0 p-0">
                                                    <input type="checkbox"
                                                        class="custom-control-input table-select-row">
                                                    <span class="custom-control-indicator"></span>
                                                </label>
                                            </th>
                                            <td>{{ $code->code }}</td>
                                            <td>{{ $code->user->name }}</td>
                                            @if ($code->status == 0)
                                                <td>Belum dipakai</td>
                                            @elseif($code->status == 1)
                                                <td>Sudah dipakai</td>
                                            @endif
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

<!-- Modal for Add -->
<div class="modal fade" id="generateModal" tabindex="-1" role="dialog" aria-labelledby="generateModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="generateModalLabel">
                    Generate Kode Baru
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('code.generate') }}" class="d-inline">
                @csrf
                <div class="modal-body">
                    <div class="col-12 form-group" style="text-align: center">
                        <button type="submit" class="btn btn-danger btn-lg">Generate Code</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@include('layout.footer')
