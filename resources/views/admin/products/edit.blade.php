@extends('admin.layouts.admin')

@section('title', 'Editare produs: '. $product[0]->name_ro)

@section('content')
    @include('admin.messages.succes')
    @include('admin.messages.error')
    <div class="content">
        <div class="container">
            <div class="col-12">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Editare produs</h3>
                    </div>
                    <form action="{{route('products.update', $product[0]->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name_ro">Nume Produs RO</label>
                                <input type="text" class="form-control" id="name_ro" name="name_ro"
                                       value="{{old('name_ro')??$product[0]->name_ro}}" placeholder="Nume Produs" required>
                            </div>
                            <div class="form-group">
                                <label for="name_ru">Имя Продукта РУ</label>
                                <input type="text" class="form-control" id="name_ru" name="name_ru"
                                       value="{{old('name_ru')??$product[0]->name_ru}}" placeholder="Имя Продукта" required>
                            </div>
                            <div class="form-group">
                                <label for="desc_ro">Descrierea scurtă a produsului RO</label>
                                <input type="text" class="form-control" id="desc_ro" name="desc_ro"
                                       value="{{old('desc_ro')??$product[0]->desc_ro}}" placeholder="Descrierea">
                            </div>
                            <div class="form-group">
                                <label for="desc_ru">Описание продукта РУ</label>
                                <input type="text" class="form-control" id="desc_ru" name="desc_ru"
                                       value="{{old('desc_ru')??$product[0]->desc_ru}}" placeholder="Описание">
                            </div>
                            <div class="form-group">
                                <label>Producătorul</label>
                                <select class="form-control" name="producator_id">
                                    @foreach($producatori as $prod)
                                        @if($product[0]->id == $prod->id)
                                            <option value="{{$prod->id}}" selected>{{$prod->name}}</option>
                                        @else
                                            <option value="{{$prod->id}}">{{$prod->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="cod">Codul produsului</label>
                                        <input type="text" class="form-control" id="cod" name="cod"
                                               value="{{old('cod')??$product[0]->cod}}" placeholder="Codul produsului">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Categoria principală</label>
                                        <select class="form-control" name="category_id">
                                            <option value="0"> -------------</option>
                                            @foreach($categories as $category)
                                                @if($product[0]->category_id == $category->id)
                                                <option value="{{$category->id}}" selected><b>{{$category->maincategory->name_ro??null}}</b>
                                                    | {{$category->name_ro}}</option>
                                                @else
                                                    <option value="{{$category->id}}" @if($category->category_id == '0') disabled @endif><b>{{$category->maincategory->name_ro??null}}</b>
                                                        | {{$category->name_ro}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <img style="width: 90px; border: #565757 1px solid; border-radius: 10px;" src="/storage/products_thumb/{{$product[0]->image_thumb}}@90" alt="{{$product[0]->name_ro}}">
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
                            @if($product_images == !null)
                                @foreach($product_images as $image)
                                    <img style="width: 90px; border: #565757 1px solid; border-radius: 10px;" src="/storage/products/{{$image}}@90" alt="{{$product[0]->name_ro}}">
                                @endforeach
                            @endif
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
                                @if($product[0]->catalog <> null)
                                <i class="fas fa-file-pdf m-1"></i><a href="/storage/catalog/{{$product[0]->catalog}}" target="_blank">{{$product[0]->catalog}}</a>
                                    <input type="checkbox" name="delete_catalog" value="1">
                                    <label for="delete_catalog"> Șterge catalogul?</label><br>
                                @endif
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
                                @if($product[0]->catalog_img <> null)
                                    <img style="width: 90px; border: #565757 1px solid; border-radius: 10px;" src="/storage/catalog_img/{{$product[0]->catalog_img}}@90" alt="{{$product[0]->name_ro}}">
                                    <input type="checkbox" name="delete_catalog_img" value="1">
                                    <label for="delete_catalog"> Șterge imaginea catalogul?</label><br>
                                @endif
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
                                <textarea id="myeditor" class="form-control" rows="3" name="full_desc_ro" placeholder="Scrie ...">{{old('full_desc_ro')??$product[0]->full_desc_ro}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Полное описание продукта РУ</label>
                                <textarea id="myeditor" class="form-control" rows="3" name="full_desc_ru" placeholder="Описание ...">{!!old('full_desc_ru')??$product[0]->full_desc_ru!!}</textarea>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="active" value="1" @if($product[0]->active == '1') checked=""@endif>
                                    <label class="form-check-label">Activat</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="active" value="0" @if($product[0]->active == '0') checked=""@endif>
                                    <label class="form-check-label">Dezactivat</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tagurile produsului</label>
                                <select name="tags[]" class="select2bs4 select2-hidden-accessible" multiple="" data-placeholder="Selectati Tagurile" style="width: 100%;" data-select2-id="23" tabindex="-1" aria-hidden="true">
                                    @foreach($tags as $tag)
                                        <option value="{{$tag->id}}" {{is_array($tagsIds) && in_array($tag->id, $tagsIds) ? 'selected' : '' }}>{{$tag->name_ro}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Salvează Modificările</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
