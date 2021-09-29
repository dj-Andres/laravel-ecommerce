@extends('layouts.auth.app')

@section('content')
<form class="pt-3" method="POST" action="{{ route('register') }}">
    @csrf
    <div class="form-group">
      <label for="email">Nombre</label>
      <div class="input-group">
        <div class="input-group-prepend bg-transparent">
          <span class="input-group-text bg-transparent border-right-0">
            <i class="fa fa-user text-primary"></i>
          </span>
        </div>
        <input id="name" type="text" name="name" class="form-control form-control-lg border-left-0 @error('name') is-invalid @enderror" id="name" placeholder="Nombre" required>
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
    </div>
    <div class="form-group">
        <label for="email">Correo electrónico</label>
        <div class="input-group">
          <div class="input-group-prepend bg-transparent">
            <span class="input-group-text bg-transparent border-right-0">
              <i class="fas fa-at text-primary"></i>
            </span>
          </div>
          <input id="email" type="email" name="email" class="form-control form-control-lg border-left-0 @error('email') is-invalid @enderror" id="email" placeholder="Correo Electronico" required>
          @error('email')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>
    </div>
    <div class="form-group">
      <label for="password">Contraseña</label>
      <div class="input-group">
        <div class="input-group-prepend bg-transparent">
          <span class="input-group-text bg-transparent border-right-0">
            <i class="fa fa-lock text-primary"></i>
          </span>
        </div>
        <input id="password" type="password" name="password" class="form-control form-control-lg border-left-0 @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
    </div>
    <div class="form-group">
      <label for="password-confirm">Confirmar Contraseña</label>
      <div class="input-group">
        <div class="input-group-prepend bg-transparent">
          <span class="input-group-text bg-transparent border-right-0">
            <i class="fa fa-lock text-primary"></i>
          </span>
        </div>
        <input id="password-confirm" type="password" name="password_confirmation" class="form-control form-control-lg border-left-0" id="password-confirm" placeholder="Confirmar Password" required>
        @error('password-confirm')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
    </div>
    <div class="my-3">
      <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"type="submit">Registrar</button>
    </div>
  </form>
@endsection
