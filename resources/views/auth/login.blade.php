@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg my-5">
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col p-3">
                            <div class="text-center">
                                <img src="{{ asset('assets/img/sedeco.png') }}" alt="Logo" width="400"
                                    height="auto" class="mb-5 ">
                            </div>
                        </div>
                        <div class="p-2">
                            <div class="text-center">
                                <h1 class="h3 mb-3 fw-bold ">Bienvenido</h1>
                            </div>
                            <br>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="row mb-4">
                                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Correo') }}</label>
                                    <div class="col-md-5">
                                        <input id="email" type="email" class="form-control custom-select @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="row mb-3">
                                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>
        
                                    <div class="col-md-5">
                                        <input id="password" type="password" class="form-control custom-select @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <br>
                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn BotonRojo">
                                            {{ __('Iniciar Sesión') }}
                                        </button>
        
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Olvidaste tu contraseña?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
