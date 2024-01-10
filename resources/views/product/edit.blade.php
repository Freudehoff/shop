@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактировать продукт</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Продукты</li>
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
                        <label for="title">Наименование</label>
                        <input type="text" id="title" name="title" value="{{ $product->title }}" class="form-control">
                        @error('title')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Краткое описание</label>
                        <input type="text" id="description" name="description" value="{{ $product->description }}"
                               class="form-control">
                        @error('description')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="summernote">Контент</label>
                        <textarea name="content" id="summernote" class="form-control">{{ $product->content }}</textarea>
                        @error('content')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="old_price">Старая цена</label>
                        <input type="number" name="old_price" id="old_price" value="{{ $product->old_price }}" class="form-control">
                        @error('old_price')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Цена</label>
                        <input type="number" name="price" id="price" value="{{ $product->price }}" class="form-control">
                        @error('price')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="count">Количество на складе</label>
                        <input type="number" name="count" id="count" value="{{ $product->count }}" class="form-control">
                        @error('count')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <img class="mx-auto d-block" style="width: 100px; height: 100px"
                                 src="{{ url('/storage/'.$product->preview_image) }}" alt="">
                        </div>
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="preview_image" value="{{ $product->preview_image }}" type="file"
                                       class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Выберите превью</label>
                            </div>
                        </div>
                        @error('preview_image')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="category_id">Выберите категорию</label>
                        <select name="category_id" id="category_id" class="form-control select2" style="width: 100%;">
                            <option selected="selected" disabled>Выберите категорию</option>
                            @foreach($categories as $category)
                                <option
                                    {{ $category->id == $product->category_id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tags">Выберите теги</label>
                        <select name="tags[]" id="tags" class="tags" multiple="multiple"
                                data-placeholder="Выберите теги"
                                style="width: 100%;">
                            @foreach($tags as $tag)
                                <option
                                    @foreach($product_tags as $product_tag)
                                        {{ $product_tag->id == $tag->id ? 'selected' : '' }}
                                    @endforeach
                                    value="{{ $tag->id }}">{{ $tag->title }}</option>
                            @endforeach
                        </select>
                        @error('tags')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="colors">Выберите цвета</label>
                        <select name="colors[]" id="colors" class="colors" multiple="multiple"
                                data-placeholder="Выберите цвета"
                                style="width: 100%;">
                            @foreach($colors as $color)
                                <option
                                    @foreach($product_colors as $product_color)
                                        {{ $product_color->id == $color->id ? 'selected' : '' }}
                                    @endforeach
                                    value="{{ $color->id }}">{{ $color->title }}</option>
                            @endforeach
                        </select>
                        @error('colors')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Редактировать">
                    </div>
                </form>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
