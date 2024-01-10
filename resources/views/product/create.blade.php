@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Добавить продукт</h1>
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
                <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Наименование</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control"
                               placeholder="Наименование">
                        @error('title')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Краткое описание</label>
                        <input type="text" name="description" id="description" value="{{ old('description') }}"
                               class="form-control"
                               placeholder="Краткое описание">
                        @error('description')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="summernote">Контент</label>
                        <textarea name="content" id="summernote" class="form-control"
                                  placeholder="Контент">{{ old('content') }}</textarea>
                        @error('content')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="old_price">Старая цена</label>
                        <input type="number" name="old_price" id="old_price" value="{{ old('old_price') }}" class="form-control"
                               placeholder="Цена">
                        @error('old_price')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Цена</label>
                        <input type="number" name="price" id="price" value="{{ old('price') }}" class="form-control"
                               placeholder="Цена">
                        @error('price')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="count">Количество на складе</label>
                        <input type="number" name="count" id="count" value="{{ old('count') }}" class="form-control"
                               placeholder="Количество на складе">
                        @error('count')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="preview_image" value="{{ 'preview_image' }}" type="file"
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
                                    {{ old('category_id') == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->title }}</option>
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
                                    @if(old('tags'))
                                        @for( $i =0; $i < count(old('tags')); $i++)
                                            {{ old('tags.'.$i) == $tag->id ? 'selected' : '' }}
                                        @endfor
                                    @endif
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
                                    @if(old('colors'))
                                        @for( $i =0; $i < count(old('colors')); $i++)
                                            {{ old('colors.'.$i) == $color->id ? 'selected' : '' }}
                                        @endfor
                                    @endif
                                    value="{{ $color->id }}">{{ $color->title }}</option>
                            @endforeach
                        </select>
                        @error('colors')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                        @enderror
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
