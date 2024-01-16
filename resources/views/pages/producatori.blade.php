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
                <div class="category_info_block">
                <h1>{{$category_info[0]->name_ro??'Toți producătorii'}}</h1>
                <small>{{$category_info[0]->name_ro??'Toți producătorii pe DentClub.MD'}}</small>
                </div>
                <hr>
                <div class="row w-100 d-flex justify-content-center">
                    @foreach($producatori as $producator)
                        <div class="product_item">
                            <div class="product_item_container">
                                <div class="product_item_img"><a href="{{route('list_producatori', $producator->slug)}}"
                                                                 title="{{$producator->name}}@200"><img
                                            src="/storage/producatori/{{$producator->logo}}"
                                            alt="{{$producator->name}}" style="width: 200px;"></a></div>
                                <div class="product_item_name"><a href="{{route('productpage', $producator->slug)}}"
                                                                  title="{{$producator->name}}">{{$producator->name}}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <hr>
            </div>
        </div>
        {{\App\Http\Controllers\ProductController::random5()}}
    </div>
@endsection
