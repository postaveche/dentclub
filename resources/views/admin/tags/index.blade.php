@extends('admin.layouts.admin')

@section('title', 'Toate Tagurile produselor')

@section('content')
    @include('admin.messages.succes')
    @include('admin.messages.error')
        <div class="content">
            <div class="container">
                <a class="btn btn-success m-2" href="{{route('tags.create')}}">Adaugă TAG</a>
                <div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Lista de taguri...</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th style="width: 10px">ID</th>
                                    <th>Denumirea</th>
                                    <th>URL</th>
                                    <th style="width: 80px">Actiuni</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tags as $tag)
                                    <tr>
                                        <td>{{$tag->id}}</td>
                                        <td>{{$tag->name_ro}} | {{$tag->name_ru}}</td>
                                        <td>
                                            {{$tag->slug}}
                                        </td>
                                        <td>
                                            <div class="form-group d-inline">
                                            <a class="badge badge-success" href="{{route('tags.edit', $tag->id)}}" title="Edit"><i class="fas fa-edit"></i></a>
                                            <form action="{{route('tags.destroy', $tag->id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                           <button class="btn btn-sm btn-outline-danger" type="submit" onclick="return confirm('Doriți să ștergeți tagul?')"><i class="fas fa-trash"></i></button>
                                            </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
@endsection
