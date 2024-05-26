@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактирование пользователя</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.index') }}">Главная</a>
                        </li>
                        <li class="breadcrumb-item active">Пользователи</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <form action="{{ route('user.update', $user->id) }}" method="post">
                    @csrf
                    @method('patch')

                    <div class="form-group">
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <label for="login" class="required-label">Роль</label>
                        <select name="role_id" class="form-control select2" style="width: 100%;">
                            <option selected disabled>Выберите роль</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->title }}</option>
                            @endforeach
                        </select>
                        @error('role_id') <div class="panel alert-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="login" class="required-label">Логин</label>
                        <input type="text" value="{{ $user->login ?? old('login') }}" name="login" class="form-control" placeholder="Логин">
                        @error('login') <div class="panel alert-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="email" class="required-label">Email</label>
                        <input type="email" value="{{ $user->email ?? old('email') }}" name="email" class="form-control" placeholder="Email">
                        @error('email') <div class="panel alert-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="password" class="required-label">Новый пароль</label>
                        <input type="password" name="password" class="form-control" placeholder="Пароль">
                        @error('password') <div class="panel alert-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="required-label">Подтверждение нового пароля</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Подтвердить пароль">
                        @error('password_confirmation') <div class="panel alert-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Принять изменения">
                    </div>
                </form>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
