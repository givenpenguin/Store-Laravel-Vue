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

{{--            <div class="card">--}}
{{--                <div class="card-body">--}}
{{--                    <div id="table-products_wrapper" class="dataTables_wrapper dt-bootstrap4">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-sm-12">--}}
{{--                                <table id="table-products" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="table-products_info">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th class="sorting" tabindex="0" aria-controls="table-products" rowspan="1" colspan="1" aria-label="ID: activate to sort column ascending" aria-sort="ascending">ID</th>--}}
{{--                                        <th class="sorting" tabindex="0" aria-controls="table-products" rowspan="1" colspan="1" aria-label="Наименование: activate to sort column ascending" aria-sort="ascending">Наименование<th>--}}
{{--                                        <th class="sorting" tabindex="0" aria-controls="table-products" rowspan="1" colspan="1" aria-label="Артикул: activate to sort column ascending" aria-sort="ascending">Артикул</th>--}}
{{--                                        <th class="sorting" tabindex="0" aria-controls="table-products" rowspan="1" colspan="1" aria-label="Цена: activate to sort column ascending" aria-sort="ascending">Цена</th>--}}
{{--                                        <th class="sorting" tabindex="0" aria-controls="table-products" rowspan="1" colspan="1" aria-label="Скидка: activate to sort column ascending" aria-sort="ascending">Скидка</th>--}}
{{--                                        <th class="sorting" tabindex="0" aria-controls="table-products" rowspan="1" colspan="1" aria-label="Количество: activate to sort column ascending" aria-sort="ascending">Количество</th>--}}
{{--                                        <th class="sorting" tabindex="0" aria-controls="table-products" rowspan="1" colspan="1" aria-label="Размеры: activate to sort column ascending" aria-sort="ascending">Размеры</th>--}}
{{--                                        <th class="sorting" tabindex="0" aria-controls="table-products" rowspan="1" colspan="1" aria-label="Категория: activate to sort column ascending" aria-sort="ascending">Категория</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                        @foreach($products as $product)--}}
{{--                                        <tr>--}}
{{--                                            <td>{{ $product->id }}</td>--}}
{{--                                            <td>{{ $product->title }}</td>--}}
{{--                                            <td>{{ $product->article }}</td>--}}
{{--                                            <td>{{ $product->price }} р.</td>--}}
{{--                                            <td>{{ $product->discount }}</td>--}}
{{--                                            <td>{{ $product->quantity }}</td>--}}
{{--                                            <td>--}}
{{--                                                @foreach($product->sizes as $size)--}}
{{--                                                    {{ $size->title }}--}}
{{--                                                @endforeach--}}
{{--                                            </td>--}}
{{--                                            <td>{{ $product->category->title }}</td>--}}
{{--                                            <td class="card-header">--}}
{{--                                                <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary">Подробнее</a>--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                        @endforeach--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        {{ $products->links() }}--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}


            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex">
                            <a href="{{ route('product.create') }}" class="btn btn-primary mr-2">Добавить</a>
                            <form action="{{ route('product.create') }}" method="get" enctype="multipart/form-data" class="input-group rounded" style="width: 15%">
                                <input type="search" class="form-control rounded mr-2" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                                <button type="submit" class="btn btn-primary" id="search-addon">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </div>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Наименование</th>
                                    <th>Артикул</th>
                                    <th>Цена</th>
                                    <th>Скидка</th>
                                    <th>Количество</th>
                                    <th>Размеры</th>
                                    <th>Категория</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->article }}</td>
                                    <td>{{ $product->price }} р.</td>
                                    <td>{{ $product->discount }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>
                                        @foreach($product->sizes as $size)
                                            {{ $size->title }}
                                        @endforeach
                                    </td>
                                    <td>{{ $product->category->title }}</td>
                                    <td class="card-header">
                                        <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary">Подробнее</a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{ $products->links() }}
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
