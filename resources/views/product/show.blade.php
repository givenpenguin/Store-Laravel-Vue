@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Товар</h1>
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
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex p-3">
                            @unless(auth()->user()->role->title === 'Manager')
                            <div class="mr-3">
                                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary">Редактировать</a>
                            </div>
                            <div class="mr-3">
                                <a href="{{ route('product.edit-image', $product->id) }}" class="btn btn-primary">Изменить изображения</a>
                            </div>
                            <form action="{{ route('product.delete', $product->id) }}" method="post">
                                @csrf
                                @method('delete')

                                <input type="submit" class="btn btn-danger" value="Удалить" onclick="return confirm('Вы уверены, что хотите удалить?')">
                            </form>
                            @endunless
                        </div>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <tbody>
                                    <tr>
                                        <td>ID</td>
                                        <td>{{ $product->id }}</td>
                                    </tr>
                                    <tr>
                                        <td>Наименование</td>
                                        <td>{{ $product->title }}</td>
                                    </tr>
                                    <tr>
                                        <td>Артикул</td>
                                        <td>{{ $product->article }}</td>
                                    </tr>
                                    <tr>
                                        <td>Цена</td>
                                        <td>{{ $product->price }} р.</td>
                                    </tr>
                                    <tr>
                                        <td>Скидка</td>
                                        <td>{{ $product->discount }} %</td>
                                    </tr>
                                    <tr>
                                        <td>Количество</td>
                                        <td>
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
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Размеры</td>
                                        <td>
                                            @foreach($product->sizes as $size)
                                                {{ $size->title }}
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Категория</td>
                                        <td>{{ $product->category->title }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
