@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактировать товар</h1>
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
                <form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('patch')

                    <div class="form-group">
                        <label for="title">Наименование*</label>
                        <input type="text" value="{{ $product->title ?? old('title') }}" name="title" class="form-control" placeholder="Наименование">
                        @error('title') <div class="panel alert-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="article">Артикул*</label>
                        <input type="text" value="{{ $product->article ?? old('article') }}" name="article" class="form-control" placeholder="Артикул">
                        @error('article') <div class="panel alert-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Описание</label>
                        <textarea name="description" class="form-control" placeholder="Описание" cols="30" rows="5">{{ $product->description ?? old('description') }}</textarea>
                        @error('description') <div class="panel alert-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="preview_image">Превью*</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="preview_image" itemid="preview_image" type="file" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">File</label>
                            </div>
                        </div>
                        @error('preview_image') <div class="panel alert-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="product_images">Фото</label>
                        <div class="input-group mb-1">
                            <div class="custom-file">
                                <input name="product_images[]" itemid="product_image" type="file" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">File</label>
                            </div>
                        </div>
                        <div class="input-group mb-1">
                            <div class="custom-file">
                                <input name="product_images[]" itemid="product_image" type="file" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">File</label>
                            </div>
                        </div>
                        <div class="input-group mb-1">
                            <div class="custom-file">
                                <input name="product_images[]" itemid="product_image" type="file" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">File</label>
                            </div>
                        </div>
                        @error('product_images') <div class="panel alert-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Цена*</label>
                        <input type="text" value="{{ $product->price ?? old('price') }}" name="price" class="form-control" placeholder="Цена">
                        @error('price') <div class="panel alert-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="discount_price">Цена со скидкой</label>
                        <input type="text" value="{{ $product->discount_price ?? old('discount_price') }}" name="discount_price" class="form-control" placeholder="Цена со скидкой">
                        @error('discount_price') <div class="panel alert-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="quantity">Количество на складе*</label>
                        <input type="text" value="{{ $product->quantity ?? old('quantity') }}" name="quantity" class="form-control" placeholder="Количество">
                        @error('quantity') <div class="panel alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="sizes">Размеры*</label>
                        <select name="sizes[]" class="sizes" multiple="multiple" data-placeholder="Выберите размеры" style="width: 100%;">
                            @foreach($sizes as $size)
                            <option value="{{ $size->id }}">{{ $size->title }}</option>
                            @endforeach
{{--                            @foreach($sizes as $size)--}}
{{--                                @if($size == $product->sizes)--}}
{{--                                <option selected="selected">{{ $product->sizes }}</option>--}}
{{--                                @else--}}
{{--                                <option value="{{ $size->id }}">{{ $size->title }}</option>--}}
{{--                                @endif--}}
{{--                            @endforeach--}}
                        </select>
                        @error('sizes') <div class="panel alert-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="category_id">Категория*</label>
                        <select name="category_id" class="form-control select2" style="width: 100%;">
                            <option selected="selected" disabled>Выберите категорию</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <div class="panel alert-danger">{{ $message }}</div> @enderror
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
