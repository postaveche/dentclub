@extends('admin.layouts.admin')

@section('title', 'Modificare Categorie')

@section('content')
        @include('admin.messages.succes')
        @include('admin.messages.error')
        <div class="content">
            <div class="container">
                <div class="col-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Modificare categorie</h3>
                        </div>
                        <form action="{{route('categories.update', $categoryinfo[0]->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="url_category">URL Categorie (slug)</label>
                                    <input type="text" class="form-control" id="url_category" name="slug"
                                           value="{{old('slug')??$categoryinfo[0]->slug}}" placeholder="Întrodu URL" required>
                                </div>
                                <div class="form-group">
                                    <label for="name_ro">Nume Categorie RO</label>
                                    <input type="text" class="form-control" id="name_ro" name="name_ro"
                                           value="{{old('name_ro')??$categoryinfo[0]->name_ro}}" placeholder="Nume Categorie" required>
                                </div>
                                <div class="form-group">
                                    <label for="name_ru">Имя Категории РУ</label>
                                    <input type="text" class="form-control" id="name_ru" name="name_ru"
                                           value="{{old('name_ru')??$categoryinfo[0]->name_ru}}" placeholder="Имя Категории" required>
                                </div>
                                <div class="form-group">
                                    <label for="desc_ro">Descrierea categoriei RO</label>
                                    <input type="text" class="form-control" id="desc_ro" name="desc_ro"
                                           value="{{old('desc_ro')??$categoryinfo[0]->desc_ro}}" placeholder="Descrierea">
                                </div>
                                <div class="form-group">
                                    <label for="desc_ru">Описание категории РУ</label>
                                    <input type="text" class="form-control" id="desc_ru" name="desc_ru"
                                           value="{{old('desc_ru')??$categoryinfo[0]->desc_ru}}" placeholder="Описание">
                                </div>
                                <div class="form-group">
                                    <label>Categoria principală</label>
                                    <select class="form-control" name="category_id">
                                        <option value="0"> -------------</option>
                                        @foreach($categories as $category)
                                            @if($categoryinfo[0]->category_id == $category->id)
                                                <option value="{{$category->id}}" selected>{{$category->maincategory->name_ro??null}} | {{$category->name_ro}}</option>
                                            @else
                                            <option value="{{$category->id}}">{{$category->maincategory->name_ro??null}} | {{$category->name_ro}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success">Modifică</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
