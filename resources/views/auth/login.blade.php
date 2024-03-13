@include('layout.header')
@include('sweetalert::alert')

<div class="adminx-container d-flex justify-content-center align-items-center">
    <div class="page-login">
        <div class="text-center">
            <a class="navbar-brand mb-4 h1" href="{{ route('/') }}">
                <img src="{{ asset('assets') }}/img/logo.png" class="navbar-brand-image d-inline-block align-top mr-2"
                    alt="">
                Login Absensi
            </a>
        </div>

        <div class="card mb-0">
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            placeholder="email@example.com">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-sm btn-block btn-primary">Sign in</button>
                </form>
            </div>
            {{-- <div class="card-footer text-center">
                <a href="#"><small>Forgot your password?</small></a>
            </div> --}}
        </div>
    </div>
</div>

@include('layout.footer')
