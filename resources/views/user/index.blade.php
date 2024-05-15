@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Пользователи</h1>
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

            <div class="card">
                <div class="card-body">
                    <div id="table-details_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <a href="{{ route('user.create') }}" class="btn btn-primary">Добавить</a>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="table-details" class="table table-bordered dataTable dtr-inline">
                                    <thead>
                                        <tr>
                                            <th class="sorting" tabindex="0" aria-controls="table-details" rowspan="1" colspan="1" aria-label="ID: activate to sort column descending">ID</th>
                                            <th class="sorting" tabindex="0" aria-controls="table-details" rowspan="1" colspan="1" aria-label="Логин: activate to sort column ascending">Логин</th>
                                            <th class="sorting" tabindex="0" aria-controls="table-details" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td><a href="{{ route('user.show', $size->id) }}">{{ $user->id }}</a></td>
                                            <td><a href="{{ route('user.show', $user->id) }}">{{ $user->login }}</a></td>
                                            <td><a href="{{ route('user.show', $size->id) }}">{{ $user->email }}</a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
