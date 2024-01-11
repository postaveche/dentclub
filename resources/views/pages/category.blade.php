@extends('layouts.dentclub')

@section('title', $category_info[0]->name_ro??'Toate categoriile de produse DentClub.MD')

@section('description', $category_info[0]->desc_ro??'Toate categoriile de produse DentClub.MD')

@section('content')
    <div class="container">
        <div class="row d-flex w-100">
            <div class="col-sm-3 p-3">
                @include('blocks.sidebar')
            </div>
            <div class="col-sm-9 p-3">
                <h1>{{$category_info[0]->name_ro??'Toate categoriile de produse'}}</h1>
                <small>{{$category_info[0]->name_ro??'Toate categoriile de produse'}}</small>
                <hr>
                <div class="row w-100 d-flex justify-content-center">
                @foreach($products as $product)
                    <div class="product_item">
                        <div class="product_item_container">
                        <div class="product_item_img"><a href="{{route('productpage', $product->slug)}}" title="{{$product->name_ro}}"><img src="/storage/products_thumb/{{$product->image_thumb}}" alt="{{$product->name_ro}}" style="width: 200px;"></a></div>
                            <div class="product_item_name"><a href="{{route('productpage', $product->slug)}}" title="{{$product->name_ro}}">{{$product->name_ro}}</a></div>
                    </div></div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
