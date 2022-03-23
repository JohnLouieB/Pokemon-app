@extends('layouts.app')

@section('content')
<div class="form-login">
    <img class="img-logo" src="https://www.freepnglogos.com/uploads/pok-mon-go-logo-png-30.png"/>
    <div class="form-box">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="row mb-3">
                <div class="inputs">
                    <input id="email" type="email" placeholder="Email Address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="inputs">
                    <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="check-box">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>Remember Me?
                    </div>
                </div>
            </div>

            <div class="row mb-0">
                <div class="submit">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Login') }}
                    </button>

                    @if (Route::has('register'))
                        <a class="btn btn-link text-link " href="{{ route('register') }}">
                            {{ __('Signup?') }}
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
<div>
@endsection
