@extends('admin.layouts.admin')

@section('title', 'Toate Produsele')

@section('content')
        @include('admin.messages.succes')
        @include('admin.messages.error')
        <div class="content">
            <div class="container">
                <div>
                    <a href="{{route('products.create')}}" class="btn btn-success m-2">Adaugă un produs</a>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Lista de produse...</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th style="width: 10px">ID</th>
                                    <th style="width: 100px">Foto</th>
                                    <th>Denumirea</th>
                                    <th>Categoria</th>
                                    <th>URL</th>
                                    <th>Pret</th>
                                    <th style="width: 80px">Actiuni</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)

                                    <tr>
                                        <td><b>{{$product->id}}</b></td>
                                        <td><img style="width: 90px; border: #565757 1px solid; border-radius: 10px;" src="/storage/products_thumb/{{$product->image_thumb}}" alt="{{$product->name_ro}}"></td>
                                        <td><b>{{$product->name_ro}}</b> <br> <small>{{$product->name_ru}}</small></td>
                                        <td>{{$product->mycategory->name_ro??null}}</td>
                                        <td>
                                            {{$product->slug}}
                                        </td>
                                        <td>{{$product->price}} MDL</td>
                                        <td>
                                            <a class="btn btn-outline-warning" href="{{route('products.edit', $product->id)}}" title="Edit"><i class="fas fa-edit"></i></a>
                                            <form action="{{route('products.destroy', $product->id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-outline-danger" type="submit" onclick="return confirm('Doriți să ștergeți produsul?')"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <a href="{{route('products.create')}}" class="btn btn-success m-2">Adaugă un produs</a>
                </div>
            </div>
        </div>
@endsection
