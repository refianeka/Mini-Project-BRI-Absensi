@include('layout.header')
@include('sweetalert::alert')
@include('layout.sidebar')
@include('layout.navbar')
<!-- adminx-content-aside -->
<div class="adminx-content">

    <div class="adminx-main-content">
        <div class="container-fluid">
            <!-- BreadCrumb -->
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb adminx-page-breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>

            <div class="pb-3">
                <h1>Dashboard</h1>
            </div>


            @if (Auth::user()->role_id == 4)
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="card-header-title">Form Absen</div>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title mb-5" style="text-align: center">Selamat Datang
                                    {{ Auth::user()->name }} - {{ Auth::user()->role->name }}
                                </h4>

                                <div class="row mb-3" style="text-align: center; font-size: 25px">
                                    <div class="col-12" id="digit_clock_time"></div>
                                    <div class="col-12" id="digit_clock_date"></div>
                                </div>

                                @if ($user->status_attendance == 1)
                                    <form action="{{ route('attendance.update') }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="col-12 form-group" style="text-align: center">
                                            <p>*Silahkan checkout sebelum waktu habis!</p>
                                            <button type="submit" class="btn btn-warning btn-block">CheckOut</button>
                                        </div>
                                    </form>
                                @else
                                    <form action="{{ route('attendance.store') }}" method="POST">
                                        @csrf
                                        <div class="col-12 form-group">
                                            <label for="assistant_id"><strong>ID Asisten</strong></label>
                                            <input type="text"
                                                class="form-control @error('assistant_id') is-invalid @enderror"
                                                id="assistant_id" name="assistant_id"
                                                value="{{ Auth::user()->assistant_id }}" readonly>
                                            @error('assistant_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-12 form-group">
                                            <label for="class_id"><strong>Kelas</strong></label>
                                            <select class="form-control @error('class_id') is-invalid @enderror"
                                                name="class_id" id="class_id">
                                                <option value="">Silahkan dipilih</option>
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('class_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-12 form-group">
                                            <label for="material_id"><strong>Materi</strong></label>
                                            <select class="form-control @error('material_id') is-invalid @enderror"
                                                name="material_id" id="material_id">
                                                <option value="">Silahkan dipilih</option>
                                                @foreach ($materials as $material)
                                                    <option value="{{ $material->id }}">{{ $material->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('material_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-12 form-group">
                                            <label for="teaching_role"><strong>Peran Jaga</strong></label>
                                            <select class="form-control @error('teaching_role') is-invalid @enderror"
                                                name="teaching_role" id="teaching_role">
                                                <option value="">Silahkan dipilih</option>
                                                <option value="Asisten Baris">Asisten Baris</option>
                                                <option value="Ketua">Ketua</option>
                                                <option value="Tutor">Tutor</option>
                                            </select>
                                            @error('teaching_role')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-12 form-group">
                                            <label for="code_id"><strong>Kode Absen</strong></label>
                                            <input type="text"
                                                class="form-control @error('code_id') is-invalid @enderror"
                                                id="code_id" name="code_id" placeholder="Ex: 67mmflrY">
                                            @error('code_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-12 form-group" style="text-align: center">
                                            <p>*Silahkan minta PJ atau Staff untuk kode absennya</p>
                                            <button type="submit" class="btn btn-primary btn-block">Absen</button>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-lg-6 mb-3">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="card-header-title">Buat Kode Absen</div>
                            </div>
                            <form method="POST" action="{{ route('code.generate') }}" class="d-inline">
                                @csrf
                                <div class="card-body">
                                    <div class="col-12 form-group" style="text-align: center">
                                        <button type="submit" class="btn btn-danger btn-lg">Generate Kode
                                            Absen</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="card-header-title">Form Absen</div>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title mb-3" style="text-align: center">Selamat Datang
                                    {{ Auth::user()->name }} - {{ Auth::user()->role->name }}
                                </h4>

                                <div class="row mb-3" style="text-align: center; font-size: 25px">
                                    <div class="col-12" id="digit_clock_time"></div>
                                    <div class="col-12" id="digit_clock_date"></div>
                                </div>

                                @if ($user->status_attendance == 1)
                                    <form action="{{ route('attendance.update') }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="col-12 form-group" style="text-align: center">
                                            <p>*Silahkan checkout sebelum waktu habis!</p>
                                            <button type="submit" class="btn btn-warning btn-block">CheckOut</button>
                                        </div>
                                    </form>
                                @else
                                    <form action="{{ route('attendance.store') }}" method="POST">
                                        @csrf
                                        <div class="col-12 form-group">
                                            <label for="assistant_id"><strong>ID Asisten</strong></label>
                                            <input type="text"
                                                class="form-control @error('assistant_id') is-invalid @enderror"
                                                id="assistant_id" name="assistant_id"
                                                value="{{ Auth::user()->assistant_id }}" readonly>
                                            @error('assistant_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-12 form-group">
                                            <label for="class_id"><strong>Kelas</strong></label>
                                            <select class="form-control @error('class_id') is-invalid @enderror"
                                                name="class_id" id="class_id">
                                                <option value="">Silahkan dipilih</option>
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('class_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-12 form-group">
                                            <label for="material_id"><strong>Materi</strong></label>
                                            <select class="form-control @error('material_id') is-invalid @enderror"
                                                name="material_id" id="material_id">
                                                <option value="">Silahkan dipilih</option>
                                                @foreach ($materials as $material)
                                                    <option value="{{ $material->id }}">{{ $material->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('material_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-12 form-group">
                                            <label for="teaching_role"><strong>Peran Jaga</strong></label>
                                            <select class="form-control @error('teaching_role') is-invalid @enderror"
                                                name="teaching_role" id="teaching_role">
                                                <option value="">Silahkan dipilih</option>
                                                <option value="Asisten Baris">Asisten Baris</option>
                                                <option value="Ketua">Ketua</option>
                                                <option value="Tutor">Tutor</option>
                                            </select>
                                            @error('teaching_role')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-12 form-group">
                                            <label for="code_id"><strong>Kode Absen</strong></label>
                                            <input type="text"
                                                class="form-control @error('code_id') is-invalid @enderror"
                                                id="code_id" name="code_id" placeholder="Ex: 67mmflrY">
                                            @error('code_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-12 form-group" style="text-align: center">
                                            <p>*Silahkan minta PJ atau Staff untuk kode absennya</p>
                                            <button type="submit" class="btn btn-primary btn-block">Absen</button>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@include('layout.footer')
