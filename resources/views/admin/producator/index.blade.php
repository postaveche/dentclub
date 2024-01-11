@extends('admin.layouts.admin')

@section('title', 'Toți producătorii')

@section('content')
    @include('admin.messages.succes')
    @include('admin.messages.error')
    <div class="content">
        <div class="container">
            <div>
                <a href="{{route('producatori.create')}}" class="btn btn-success m-2">Adaugă un producător</a>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Lista de producători...</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th style="width: 10px">ID</th>
                                <th>Logo</th>
                                <th>Denumirea</th>
                                <th>URL</th>
                                <th>Țara</th>
                                <th style="width: 80px">Actiuni</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($producatori as $prod)
                                <tr>
                                    <td>{{$prod->id}}</td>
                                    <td><img src="/storage/producatori/{{$prod->logo}}" alt="{{$prod->name}}" style="height: 64px;"></td>
                                    <td>{{$prod->name}}</td>
                                    <td>{{$prod->site}}</td>
                                    <td>{{$prod->country}}</td>
                                    <td>
                                        <form action="{{route('producatori.edit', $prod->id)}}" method="get">
                                            @csrf
                                            <button class="btn btn-sm btn-outline-warning" type="submit"><i class="fas fa-edit"></i></button>
                                        </form>
                                        <form action="{{route('producatori.destroy', $prod->id)}}" method="post">
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
                <a href="{{route('producatori.create')}}" class="btn btn-success m-2">Adaugă un producător</a>
            </div>
        </div>
    </div>
@endsection
