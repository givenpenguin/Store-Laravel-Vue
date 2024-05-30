@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Товары</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.index') }}">Главная</a>
                        </li>
                        <li class="breadcrumb-item active">Товары</li>
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
                        @unless(auth()->user()->role->title === 'Manager')
                        <a href="{{ route('product.create') }}" class="btn btn-primary">Добавить</a>
                        @endunless
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="table-details" class="table table-bordered dataTable dtr-inline">
                                    <thead>
                                        <tr>
                                            <th class="sorting" tabindex="0" aria-controls="table-details" rowspan="1" colspan="1" aria-label="ID: activate to sort column descending">ID</th>
                                            <th class="sorting" tabindex="0" aria-controls="table-details" rowspan="1" colspan="1" aria-label="Наименование: activate to sort column ascending">Наименование</th>
                                            <th class="sorting" tabindex="0" aria-controls="table-details" rowspan="1" colspan="1" aria-label="Артикул: activate to sort column ascending">Артикул</th>
                                            <th class="sorting" tabindex="0" aria-controls="table-details" rowspan="1" colspan="1" aria-label="Цена: activate to sort column ascending">Цена</th>
                                            <th class="sorting" tabindex="0" aria-controls="table-details" rowspan="1" colspan="1" aria-label="Скидка: activate to sort column ascending">Скидка</th>
                                            <th class="sorting" tabindex="0" aria-controls="table-details" rowspan="1" colspan="1" aria-label="Количество: activate to sort column ascending">Количество</th>
                                            <th class="sorting" tabindex="0" aria-controls="table-details" rowspan="1" colspan="1" aria-label="Размеры: activate to sort column ascending">Размеры</th>
                                            <th class="sorting" tabindex="0" aria-controls="table-details" rowspan="1" colspan="1" aria-label="Категория: activate to sort column ascending">Категория</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td><a href="{{ route('product.show', $product->id) }}">{{ $product->id }}</a></td>
                                            <td><a href="{{ route('product.show', $product->id) }}">{{ $product->title }}</a></td>
                                            <td><a href="{{ route('product.show', $product->id) }}">{{ $product->article }}</a></td>
                                            <td><a href="{{ route('product.show', $product->id) }}">{{ $product->price }} р.</a></td>
                                            <td><a href="{{ route('product.show', $product->id) }}">{{ $product->discount ?? 0 }} %</a></td>
                                            <td>
                                                <a href="{{ route('product.show', $product->id) }}">
                                                    @php
                                                        $quantity = 0;
                                                        foreach($product->sizes as $size) {
                                                            $quantity += $size->pivot->quantity;
                                                        }
                                                    @endphp
                                                    @foreach($product->sizes as $size)
                                                        {{ $size->title }} ({{ $size->pivot->quantity }})
                                                    @endforeach
                                                    <br>Всего: {{ $quantity }}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('product.show', $product->id) }}">
                                                @foreach($product->sizes as $size)
                                                    {{ $size->title }}
                                                @endforeach
                                                </a>
                                            </td>
                                            <td><a href="{{ route('product.show', $product->id) }}">{{ $product->category->title }}</a></td>
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
