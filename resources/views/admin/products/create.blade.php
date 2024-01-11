@extends('admin.layouts.admin')

@section('title', 'Crează un produs nou')

@section('content')
        @include('admin.messages.succes')
        @include('admin.messages.error')
        <div class="content">
            <div class="container">
                <div class="col-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Adăugare produs</h3>
                        </div>
                        <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name_ro">Nume Produs RO</label>
                                    <input type="text" class="form-control" id="name_ro" name="name_ro"
                                           value="{{old('name_ro')}}" placeholder="Nume Produs" required>
                                </div>
                                <div class="form-group">
                                    <label for="name_ru">Имя Продукта РУ</label>
                                    <input type="text" class="form-control" id="name_ru" name="name_ru"
                                           value="{{old('name_ru')}}" placeholder="Имя Продукта" required>
                                </div>
                                <div class="form-group">
                                    <label for="desc_ro">Descrierea scurtă a produsului RO</label>
                                    <input type="text" class="form-control" id="desc_ro" name="desc_ro"
                                           value="{{old('desc_ro')}}" placeholder="Descrierea">
                                </div>
                                <div class="form-group">
                                    <label for="desc_ru">Описание продукта РУ</label>
                                    <input type="text" class="form-control" id="desc_ru" name="desc_ru"
                                           value="{{old('desc_ru')}}" placeholder="Описание">
                                </div>
                                <div class="form-group">
                                    <label>Producătorul</label>
                                    <select class="form-control" name="producator_id">
                                        <option value=""> -------------</option>
                                        @foreach($producatori as $prod)
                                            <option value="{{$prod->id}}">{{$prod->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="cod">Codul produsului</label>
                                            <input type="text" class="form-control" id="cod" name="cod"
                                                   value="{{old('cod')}}" placeholder="Codul produsului">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Categoria principală</label>
                                            <select class="form-control" name="category_id">
                                                <option value="0"> -------------</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}" @if($category->category_id == '0') disabled @endif><b>{{$category->maincategory->name_ro??null}}</b>
                                                        | {{$category->name_ro}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="image_thumb">Imaginea reprezintativă</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="image_thumb" name="image_thumb" accept="image/png, image/jpeg, image/webp">
                                            <label class="custom-file-label" for="image_thumb">Selecteză poza</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="images">Pozele produsului</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="images" name="images[]" accept="image/png, image/jpeg, image/webp" multiple>
                                            <label class="custom-file-label" for="images">Selecteză pozele</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="catalog_pdf">Catalogul Produsului</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="catalog_pdf" name="catalog_pdf" accept="application/pdf">
                                            <label class="custom-file-label" for="catalog_pdf">Selecteză catalogul</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="catalog_img">Imaginea Catalogului</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="catalog_img" name="catalog_img" accept="image/png, image/jpeg, image/webp">
                                            <label class="custom-file-label" for="catalog_img">Selecteză imaginea catalogul</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Descrierea complectă a produsului RO</label>
                                    <textarea id="myeditor" class="form-control" rows="3" name="full_desc_ro" placeholder="Scrie ...">{{old('full_desc_ro')}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Полное описание продукта РУ</label>
                                    <textarea id="myeditor" class="form-control" rows="3" name="full_desc_ru" placeholder="Описание ...">{{old('full_desc_ru')}}</textarea>
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="active" value="1" checked="">
                                        <label class="form-check-label">Activat</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="active" value="0">
                                        <label class="form-check-label">Dezactivat</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tagurile produsului</label>
                                    <select name="tags[]" class="select2bs4 select2-hidden-accessible" multiple="" data-placeholder="Selectati Tagurile" style="width: 100%;" data-select2-id="23" tabindex="-1" aria-hidden="true">
                                        @foreach($tags as $tag)
                                            <option value="{{$tag->id}}">{{$tag->name_ro}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success">Salvează</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
