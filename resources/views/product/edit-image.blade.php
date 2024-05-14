@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Изменить изображения товара</h1>
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
                <form action="{{ route('product.update-image', $product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('patch')

                    <div class="form-group">
                        <label for="preview_image">Изменить главное изображение</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="preview_image" itemid="preview_image" type="file" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">File</label>
                            </div>
                        </div>
                        @error('preview_image') <div class="panel alert-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label>Добавить изображения</label>
                        <div class="input-group mb-1">
                            <button type="button" name="product_images" class="btn btn-block btn-default file-chooser">Загрузить</button>
                        </div>
                        <div class="list-input"></div>
                        <div class="list-images"></div>
                        @error('product_images') <div class="panel alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="deleted_images">Удалить изображения</label>
                        @foreach($images as $image)
                            <div class="form-check">
                                <input class="form-check-input" name="deleted_images[]" type="checkbox" value="{{ $image->file_path }}">
                                <a href="http://127.0.0.1:8888/storage/{{ $image->file_path }}" target="_blank" class="form-check-label">{{ str_replace('images/', '', $image->file_path) }}</a>
                            </div>
                        @endforeach
                        @error('deleted_images') <div class="panel alert-danger">{{ $message }}</div> @enderror
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
    <script src="{{ asset('adminlte/js/main.js') }}"></script>
@endsection
