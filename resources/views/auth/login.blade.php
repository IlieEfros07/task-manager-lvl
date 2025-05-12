@extends('layouts.app')

@section('title', 'Autentificare')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
         <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-header bg-primary text-white text-center">
                <h3 class="fw-light my-2">Autentificare</h3>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('login') }}">
                    @csrf 
                     @error('email')
                        <div class="alert alert-danger py-2 small mb-3" role="alert">
                            {{ $message }}
                        </div>
                     @enderror

                    <div class="mb-3">
                        <label for="email" class="form-label">Adresă Email</label>
                        <input type="email" id="email" name="email"
                               class="form-control @error('email') is-invalid @enderror" 
                               value="{{ old('email') }}" required autofocus placeholder="adresa@email.com">

                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Parolă</label>
                        <input type="password" id="password" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               required autocomplete="current-password" placeholder="********">
                         @error('password') 
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Ține-mă minte</label>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">Login</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center py-3">
                <div class="small">

                     <a class="text-decoration-none" href="{{ route('register') }}">Nu ai cont? Înregistrează-te</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection