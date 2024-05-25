@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Заказы</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.index') }}">Главная</a>
                        </li>
                        <li class="breadcrumb-item active">Заказы</li>
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
                            <div class="mr-3">
                                <a href="{{ route('order.edit', $order->id) }}" class="btn btn-primary">Редактировать</a>
                            </div>
                            <form action="{{ route('order.delete', $order->id) }}" method="post">
                                @csrf
                                @method('delete')

                                <input type="submit" class="btn btn-danger" value="Удалить" onclick="return confirm('Вы уверены, что хотите удалить?')">
                            </form>
                        </div>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">

                                <tbody>
                                    <tr>
                                        <td>ID</td>
                                        <td>{{ $order->id }}</td>
                                    </tr>
                                    <tr>
                                        <td>ФИО</td>
                                        <td>{{ $order->customer->full_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>{{ $order->customer->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Телефон</td>
                                        <td>{{ $order->customer->phone_number }}</td>
                                    </tr>
                                    <tr>
                                        <td>Город</td>
                                        <td>{{ $order->customer->city }}</td>
                                    </tr>
                                    <tr>
                                        <td>Улица</td>
                                        <td>{{ $order->customer->street }}</td>
                                    </tr>
                                    <tr>
                                        <td>Дом</td>
                                        <td>{{ $order->customer->building }}</td>
                                    </tr>
                                    <tr>
                                        <td>Квартира</td>
                                        <td>{{ $order->customer->flat }}</td>
                                    </tr>
                                    <tr>
                                        <td>Индекс</td>
                                        <td>{{ $order->customer->postal_code }}</td>
                                    </tr>
                                    <tr>
                                        <td>Товары</td>
                                        <td>
                                            @foreach($order->products as $product)
                                                <a href="{{ route('product.show', $product['id']) }}" style="color: #007bff; margin: 5px">
                                                    <span>{{ $loop->iteration }}.</span>
                                                    <span>Название: {{ $product['title'] }};</span>
                                                    <span>Размер: {{ $product['size'] }};</span>
                                                    <span>Количество: {{ $product['quantity'] }};</span>
                                                    <span>Цена: {{ $product['price'] }} р.;</span>
                                                    <span>Скидка: {{ $product['discount'] }}%;</span>
                                                </a>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Комментарий</td>
                                        <td>{{ $order->comment }}</td>
                                    </tr>
                                    <tr>
                                        <td>Способ доставки</td>
                                        <td>{{ $order->delivery_method }}</td>
                                    </tr>
                                    <tr>
                                        <td>Способ оплаты</td>
                                        <td>{{ $order->payment_method }}</td>
                                    </tr>
                                    <tr>
                                        <td>Стоимость продуктов</td>
                                        <td>{{ $order->amount_of_products }}</td>
                                    </tr>
                                    <tr>
                                        <td>Стоимость доставки</td>
                                        <td>{{  $order->amount_of_delivery }}</td>
                                    </tr>
                                    <tr>
                                        <td>Стоимость скидки</td>
                                        <td>{{ $order->amount_of_discount }}</td>
                                    </tr>
                                    <tr>
                                        <td>Общая стоимость</td>
                                        <td>{{ $order->total_price}}</td>
                                    </tr>
                                    <tr>
                                        <td>Статус заказа</td>
                                        <td>{{ $order->order_status }}</td>
                                    </tr>
                                    <tr>
                                        <td>Номер отслеживания</td>
                                        <td>{{ $order->track_number }}</td>
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
