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

            <div class="card">
                <div class="card-body">
                    <div id="table-details_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="table-details" class="table table-bordered dataTable dtr-inline">
                                    <thead>
                                        <tr>
                                            <th class="sorting" tabindex="0" aria-controls="table-details" rowspan="1" colspan="1" aria-label="ID: activate to sort column descending">ID</th>
                                            <th class="sorting" tabindex="0" aria-controls="table-details" rowspan="1" colspan="1" aria-label="ФИО: activate to sort column ascending">ФИО</th>
                                            <th class="sorting" tabindex="0" aria-controls="table-details" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Email</th>
                                            <th class="sorting" tabindex="0" aria-controls="table-details" rowspan="1" colspan="1" aria-label="Город: activate to sort column ascending">Город</th>
                                            <th class="sorting" tabindex="0" aria-controls="table-details" rowspan="1" colspan="1" aria-label="Индекс: activate to sort column ascending">Индекс</th>
                                            <th class="sorting" tabindex="0" aria-controls="table-details" rowspan="1" colspan="1" aria-label="Товары: activate to sort column ascending">Товары</th>
                                            <th class="sorting" tabindex="0" aria-controls="table-details" rowspan="1" colspan="1" aria-label="Комментарий: activate to sort column ascending">Комментарий</th>
                                            <th class="sorting" tabindex="0" aria-controls="table-details" rowspan="1" colspan="1" aria-label="Способ доставки: activate to sort column ascending">Способ доставки</th>
                                            <th class="sorting" tabindex="0" aria-controls="table-details" rowspan="1" colspan="1" aria-label="Способ оплаты: activate to sort column ascending">Способ оплаты</th>
                                            <th class="sorting" tabindex="0" aria-controls="table-details" rowspan="1" colspan="1" aria-label="Стоимость продуктов: activate to sort column ascending">Стоимость продуктов</th>
                                            <th class="sorting" tabindex="0" aria-controls="table-details" rowspan="1" colspan="1" aria-label="Стоимость доставки: activate to sort column ascending">Стоимость доставки</th>
                                            <th class="sorting" tabindex="0" aria-controls="table-details" rowspan="1" colspan="1" aria-label="Стоимость скидки: activate to sort column ascending">Стоимость скидки</th>
                                            <th class="sorting" tabindex="0" aria-controls="table-details" rowspan="1" colspan="1" aria-label="Общая стоимость: activate to sort column ascending">Общая стоимость</th>
                                            <th class="sorting" tabindex="0" aria-controls="table-details" rowspan="1" colspan="1" aria-label="Статус заказа: activate to sort column ascending">Статус заказа</th>
                                            <th class="sorting" tabindex="0" aria-controls="table-details" rowspan="1" colspan="1" aria-label="Номер отслеживания: activate to sort column ascending">Номер отслеживания</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td><a href="{{ route('order.show', $order->id) }}">{{ $order->id }}</a></td>

                                            <td><a href="{{ route('order.show', $order->id) }}">{{ $order->customer->full_name }}</a></td>
                                            <td><a href="{{ route('order.show', $order->id) }}">{{ $order->customer->email }}</a></td>
                                            <td><a href="{{ route('order.show', $order->id) }}">{{ $order->customer->city }}</a></td>
                                            <td><a href="{{ route('order.show', $order->id) }}">{{ $order->customer->postal_code }}</a></td>

                                            <td style="min-width: 300px">
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

                                            <td><a href="{{ route('order.show', $order->id) }}">{{ $order->comment }}</a></td>
                                            <td><a href="{{ route('order.show', $order->id) }}">{{ $order->delivery_method }}</a></td>
                                            <td><a href="{{ route('order.show', $order->id) }}">{{ $order->payment_method }}</a></td>
                                            <td><a href="{{ route('order.show', $order->id) }}">{{ $order->amount_of_products }} р.</a></td>
                                            <td><a href="{{ route('order.show', $order->id) }}">{{ $order->amount_of_delivery }} р.</a></td>
                                            <td><a href="{{ route('order.show', $order->id) }}">{{ $order->amount_of_discount }} р.</a></td>
                                            <td><a href="{{ route('order.show', $order->id) }}">{{ $order->total_price }} р.</a></td>
                                            <td><a href="{{ route('order.show', $order->id) }}">{{ $order->order_status }}</a></td>
                                            <td><a href="{{ route('order.show', $order->id) }}">{{ $order->track_number }}</a></td>
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
