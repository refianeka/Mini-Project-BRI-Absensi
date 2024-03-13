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
                    <li class="breadcrumb-item active" aria-current="page">Riwayat Absen</li>
                </ol>
            </nav>

            <div class="pb-3">
                <h1>Riwayat Absen</h1>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body collapse show" id="card1">
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
                                        <th scope="col">Nama Asisten</th>
                                        <th scope="col">Kelas</th>
                                        <th scope="col">Materi</th>
                                        <th scope="col">Peran</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Waktu Mulai</th>
                                        <th scope="col">Waktu Akhir</th>
                                        <th scope="col">Durasi</th>
                                        <th scope="col">Approved By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($attendances as $data)
                                        <tr>
                                            <th scope="row">
                                                <label class="custom-control custom-checkbox m-0 p-0">
                                                    <input type="checkbox"
                                                        class="custom-control-input table-select-row">
                                                    <span class="custom-control-indicator"></span>
                                                </label>
                                            </th>
                                            <td>{{ $data->user->assistant_id }}</td>
                                            <td>{{ $data->user->name }}</td>
                                            <td>{{ $data->class->name }}</td>
                                            <td>{{ $data->material->name }}</td>
                                            <td>{{ $data->teaching_role }}</td>
                                            <td>{{ $data->date }}</td>
                                            <td>{{ $data->start }}</td>
                                            <td>{{ $data->end }}</td>
                                            <td>{{ $data->duration }} Menit</td>
                                            <td>
                                                {{ $data->code->user->name }}
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

@include('layout.footer')
