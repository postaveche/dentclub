@extends('layouts.dentclub')

@section('title', $producator[0]->name??'Toți producătorii pe DentClub.MD')

@section('description', $producator[0]->desc_ro??'Toți producătorii pe DentClub.MD')

@section('content')
    <div class="container">
        <div class="row d-flex w-100">
            <div class="col-lg-3 p-3 d-none d-lg-block">
                @include('blocks.producatori')
            </div>
            <div class="col-lg-9 p-0">
                <div class="category_info_block d-flex align-items-center">
                    <div><img src="/storage/producatori/{{$producator[0]->logo}}@120" alt="{{$producator[0]->name}}" style="width: 120px"></div>
                <div class="d-flex flex-column m-2">
                <h1>{{$producator[0]->name??'Toți producătorii'}}</h1>
                <small>{{$producator[0]->site??'Toți producătorii pe DentClub.MD'}}</small>
                    <small>{{$producator[0]->country}}</small>
                </div>
                </div>
                <hr>
                <div class="row w-100 d-flex justify-content-center">
                        @foreach($products as $product)
                            <div class="product_item">
                                <div class="product_item_container">
                                    <div class="product_item_img"><a href="{{route('productpage', $product->slug)}}"
                                                                     title="{{$product->name_ro}}"><img
                                                src="/storage/products_thumb/{{$product->image_thumb}}@200"
                                                alt="{{$product->name_ro}}" style="width: 200px;"></a></div>
                                    <div class="product_item_name"><a href="{{route('productpage', $product->slug)}}"
                                                                      title="{{$product->name_ro}}">{{$product->name_ro}}</a>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                </div>
                {{ $products->links() }}
                <hr>
            </div>
        </div>
        {{\App\Http\Controllers\ProductController::random5()}}
    </div>
@endsection
