@extends('layouts.app')

@section('captcha')
    {!! htmlScriptTagJsApi([
        'action' => 'homepage'
    ]) !!}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Inicio de sesión administrador') }}</div>

                <div class="card-body">
                    @if(session('message'))
                        <div class="alert alert-error" role="alert">
                          {{session('message')}}
                        </div>
                    @endif
                    <form method="POST" action="{{route('login.admin')}}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                <a href="#"><small class="inactive" id="password_change">Ver Contraseña</small></a>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Mantener sesión') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary px-4">
                                    {{ __('Iniciar sesión') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    let passInput = document.getElementById('password');
    let change = document.getElementById('password_change');

    change.addEventListener('click', (e) => {
        let elemento = e.target

        if(elemento.classList.contains('inactive'))
        {
            elemento.classList.remove('inactive')
            elemento.classList.add('active')

            passInput.type = "text"
            elemento.textContent = 'Ocultar contraseña';


        } else if(elemento.classList.contains('active')){
            elemento.classList.remove('active')
            elemento.classList.add('inactive')

            passInput.type = "password"

            elemento.textContent = 'Ver contraseña';
        }
    });
</script>
@endsection
