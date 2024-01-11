@extends('admin.layouts.admin')

@section('title', 'Editarea Tagurilor')

@section('content')
    @include('admin.messages.succes')
    @include('admin.messages.error')
    <div class="content">
        <div class="container">
            <div class="col-12">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Editează TAG</h3>
                    </div>
                    <form action="{{route('tags.update', $taginfo[0]['id'])}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name_ro">Nume TAG RO</label>
                                <input type="text" class="form-control" id="name_ro" name="name_ro"
                                       value="{{$taginfo[0]['name_ro']??old('name_ro')}}" placeholder="Nume TAG" required>
                            </div>
                            <div class="form-group">
                                <label for="name_ru">Имя Тэга РУ</label>
                                <input type="text" class="form-control" id="name_ru" name="name_ru"
                                       value="{{$taginfo[0]['name_ru']??old('name_ru')}}" placeholder="Имя Тэга" required>
                            </div>
                            <div class="form-group">
                                <label for="desc_ro">Descrierea Tagului RO</label>
                                <input type="text" class="form-control" id="desc_ro" name="desc_ro"
                                       value="{{$taginfo[0]['desc_ro']??old('desc_ro')}}" placeholder="Descrierea Tagului">
                            </div>
                            <div class="form-group">
                                <label for="desc_ru">Описание Тэга РУ</label>
                                <input type="text" class="form-control" id="desc_ru" name="desc_ru"
                                       value="{{$taginfo[0]['desc_ru']??old('desc_ru')}}" placeholder="Описание Тэга">
                            </div>
                            <div class="form-group">
                                <label>Tagul principal</label>
                                <select class="form-control" name="tag_id">
                                    <option value="0"> -------------</option>
                                    @foreach($tags as $tag)
                                        @if($taginfo[0]->tag_id == $tag->id)
                                            <option value="{{$tag->id}}" selected>{{$tag->maintag->name_ro??null}} | {{$tag->id}}) {{$tag->name_ro}}</option>
                                        @else
                                            <option value="{{$tag->id}}">{{$tag->maintag->name_ro??null}} | {{$tag->id}}) {{$tag->name_ro}}</option>
                                        @endif
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
