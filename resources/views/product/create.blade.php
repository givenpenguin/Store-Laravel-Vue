@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Добавить товар</h1>
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
                <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <input type="text" value="{{ old('title') }}" name="title" class="form-control" placeholder="Наименование">
                    </div>
                    <div class="form-group">
                        <input type="text" value="{{ old('article') }}" name="article" class="form-control" placeholder="Артикул">
                    </div>
                    <div class="form-group">
                        <textarea name="description" class="form-control" placeholder="Описание" cols="30" rows="5">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="preview_image" type="file" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Preview</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" value="{{ old('price') }}" name="price" class="form-control" placeholder="Цена">
                    </div>
                    <div class="form-group">
                        <input type="text" value="{{ old('discount_price') }}" name="discount_price" class="form-control" placeholder="Цена со скидкой">
                    </div>
                    <div class="form-group">
                        <input type="text" value="{{ old('quantity') }}" name="quantity" class="form-control" placeholder="Количество на складе">
                    </div>

                    <div class="form-group">
                        <select name="sizes[]" class="sizes" multiple="multiple" data-placeholder="Выберите размеры" style="width: 100%;">
                            @foreach($sizes as $size)
                                <option value="{{ $size->id }}">{{ $size->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <select name="category_id" class="form-control select2" style="width: 100%;">
                            <option selected="selected" disabled>Выберите категорию</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Добавить">
                    </div>
                </form>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
