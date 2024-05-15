@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Размеры</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.index') }}">Главная</a>
                        </li>
                        <li class="breadcrumb-item active">Размеры</li>
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
                        <a href="{{ route('size.create') }}" class="btn btn-primary">Добавить</a>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="table-details" class="table table-bordered dataTable dtr-inline">
                                    <thead>
                                        <tr>
                                            <th class="sorting" tabindex="0" aria-controls="table-details" rowspan="1" colspan="1" aria-label="ID: activate to sort column descending">ID</th>
                                            <th class="sorting" tabindex="0" aria-controls="table-details" rowspan="1" colspan="1" aria-label="Наименование: activate to sort column ascending">Наименование</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sizes as $size)
                                        <tr>
                                            <td><a href="{{ route('size.show', $size->id) }}">{{ $size->id }}</a></td>
                                            <td><a href="{{ route('size.show', $size->id) }}">{{ $size->title }}</a></td>
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
