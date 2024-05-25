@extends('layouts.auth')

@section('title', 'login')

@section('content')

<div class="login-box">
    <div class="login-logo">
        <span><b>Admin</b>LTE</span>
    </div>

    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Войдите в аккаунт</p>
            <form action="{{ route('login') }}" method="post">
                @csrf

                <div class="input-group mb-3">
                    <input type="email" class="form-control" name="email" required placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" required placeholder="Пароль">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                @error('email') <div class="panel alert-danger">{{ $message }}</div> @enderror
                @error('password') <div class="panel alert-danger">{{ $message }}</div> @enderror
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>

                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

@endsection
