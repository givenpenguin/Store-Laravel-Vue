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
                        <label for="title" class="required-label">Наименование</label>
                        <input type="text" value="{{ $product->title ?? old('title') }}" name="title" class="form-control" placeholder="Наименование">
                        @error('title') <div class="panel alert-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="article" class="required-label">Артикул</label>
                        <input type="text" value="{{ $product->article ?? old('article') }}" name="article" class="form-control" placeholder="Артикул">
                        @error('article') <div class="panel alert-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Описание</label>
                        <textarea name="description" class="form-control" placeholder="Описание" cols="30" rows="5">{{ $product->description ?? old('description') }}</textarea>
                        @error('description') <div class="panel alert-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="price" class="required-label">Цена</label>
                        <input type="number" value="{{ $product->price ?? old('price') }}" name="price" min="1" class="form-control" placeholder="Цена">
                        @error('price') <div class="panel alert-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="discount_price">Размер скидки в %</label>
                        <input type="number" value="{{ $product->discount ?? old('discount') }}" name="discount" min="1" class="form-control" placeholder="Размер скидки">
                        @error('discount') <div class="panel alert-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="required-label">Размеры</label>
                        @foreach($sizes as $size)
                            @php
                                foreach($product->sizes as $productSize)
                                    if($productSize->id === $size->id){
                                        {{ $isChecked = true; }}
                                        {{ $quantity = $productSize->pivot->quantity; }}
                                    }
                            @endphp

                            <div class="d-flex nowrap mb-2 form-check">
                                <input id="size-input-{{ $size->id }}" class="form-check-input" type="checkbox" value="{{ $size->id }}"
                                       {{ $isChecked ? 'checked' : '' }} name="sizes[]" onchange="toggleInputAvailability('quantity-input-{{ $size->id }}')">
                                <label for="sizes" class="col-sm-2 col-form-label">{{ $size->title }}</label>
                                <input id="quantity-input-{{ $size->id }}" type="number" value="{{ $quantity }}"
                                       min="1" name="quantities[]" class="form-control" placeholder="Количество на складе"
                                       {{ $isChecked ? '' : 'disabled' }} required>
                            </div>
                        @endforeach
                        @error("sizes") <div class="panel alert-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="category_id" class="required-label">Категория</label>
                        <select name="category_id" class="form-control select2" style="width: 100%;">
                            <option selected="selected" disabled>Выберите категорию</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id === $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
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
    <script>
        function toggleInputAvailability(id) {
            let input = document.getElementById(id);
            input.disabled = !input.disabled
            input.disabled === true ? input.value = '' : '';
        }
    </script>
@endsection
