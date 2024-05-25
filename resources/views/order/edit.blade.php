@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактировать заказ</h1>
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
                <form action="{{ route('order.update', $order->id) }}" method="post">
                    @csrf
                    @method('patch')

                    <div class="form-group">
                        <label for="order_status" class="required-label">Статус заказа</label>
                        <input type="text" name="order_status" value="{{ $order->order_status ?? old('order_status') }}" class="form-control" required placeholder="Статус заказа">
                        @error('order_status') <div class="panel alert-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="track_number">Номер отслеживания</label>
                        <input type="number" name="track_number" value="{{ $order->track_number ?? old('track_number') }}" class="form-control" placeholder="Номер отслеживания">
                        @error('track_number') <div class="panel alert-danger">{{ $message }}</div> @enderror
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
