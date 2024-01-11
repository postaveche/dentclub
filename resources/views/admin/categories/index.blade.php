@extends('admin.layouts.admin')

@section('title', 'Toate categoriile de produse')

@section('content')
        <div class="content">
            <div class="container">
                <div>
                    <a href="{{route('categories.create')}}" class="btn btn-success m-2">Crează o categorie</a>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Lista de categorii...</h3>
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
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{$category->id}}</td>
                                        <td><b>{{$category->maincategory->name_ro??null}}</b> * {{$category->name_ro}} | {{$category->name_ru}} ({{$category->category_id}})</td>
                                        <td>
                                            {{$category->slug}}
                                        </td>
                                        <td>
                                            <form action="{{route('categories.edit', $category->id)}}" method="get">
                                                @csrf
                                                <button class="btn btn-sm btn-outline-warning" type="submit"><i class="fas fa-edit"></i></button>
                                            </form>
                                            <form action="{{route('categories.destroy', $category->id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-sm btn-outline-danger" type="submit" onclick="return confirm('Doriți să ștergeți produsul?')"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <a href="{{route('categories.create')}}" class="btn btn-success m-2">Crează o categorie</a>
                </div>
            </div>
        </div>
@endsection
