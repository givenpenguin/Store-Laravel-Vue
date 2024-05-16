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
                        <label for="title" class="required-label">Наименование</label>
                        <input type="text" value="{{ old('title') }}" name="title" class="form-control" placeholder="Наименование">
                        @error('title') <div class="panel alert-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="article" class="required-label">Артикул</label>
                        <input type="text" value="{{ old('article') }}" name="article" class="form-control" placeholder="Артикул">
                        @error('article') <div class="panel alert-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Описание</label>
                        <textarea name="description" class="form-control" placeholder="Описание" cols="30" rows="5">{{ old('description') }}</textarea>
                        @error('description') <div class="panel alert-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="preview_image" class="required-label">Превью</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="preview_image" itemid="preview_image" type="file" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Preview</label>
                            </div>
                        </div>
                        @error('preview_image') <div class="panel alert-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">Изображения</label>
                        <div class="input-group mb-1">
                            <button type="button" class="btn btn-block btn-default file-chooser">Загрузить</button>
                        </div>
                        <div class="list-input"></div>
                        <div class="list-images"></div>
                        @error('product_images') <div class="panel alert-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="price" class="required-label">Цена</label>
                        <input type="number" value="{{ old('price') }}" name="price" min="1" class="form-control" placeholder="Цена">
                        @error('price') <div class="panel alert-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="discount_price">Размер скидки в %</label>
                        <input type="number" value="{{ old('discount') }}" name="discount" min="1" max="100" class="form-control" placeholder="Размер скидки">
                        @error('discount') <div class="panel alert-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="required-label">Размеры</label>
                        @foreach($sizes as $size)
                            <div class="d-flex nowrap mb-2 form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $size->id }}" name="sizes[]" onchange="toggleInputAvailability('quantity-input-{{ $size->id }}')">
                                <label for="sizes" class="col-sm-2 col-form-label">{{ $size->title }}</label>
                                <input id="quantity-input-{{ $size->id }}" type="number" min="1" name="quantities[]" class="form-control" placeholder="Количество на складе" disabled required>
                            </div>
                        @endforeach
                        @error("sizes") <div class="panel alert-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="category_id" class="required-label">Категория</label>
                        <select name="category_id" class="form-control select2" style="width: 100%;">
                            <option selected disabled>Выберите категорию</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <div class="panel alert-danger">{{ $message }}</div> @enderror
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
    <script>
        function toggleInputAvailability(id) {
            let input = document.getElementById(id);
            input.disabled = !input.disabled
            input.disabled === true ? input.value = '' : '';
        }
    </script>
@endsection

