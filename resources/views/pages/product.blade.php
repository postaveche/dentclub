@extends('layouts.dentclub')

@section('title', $product[0]->name_ro)

@section('description', $product[0]->desc_ro)

@section('content')
    <div class="product w-100">
        <div class="container p-3">
            <div class="row d-flex w-100">
            <div class="col-sm-6">
                <div class="product_slider">
                    <div class="item">
                        <div class="clearfix" style="max-width:100%;">
                            <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                                @foreach($images as $img)
                                    <li data-thumb="/storage/products/{{$img}}">
                                        <img class="product_slider_images" src="/storage/products/{{$img}}" />
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="product_info">
                    <div class="product_info_title">
                        <h1>{{$product[0]->name_ro}}</h1>
                    </div>
                    <div class="product_info_item">
                        {{$product[0]->desc_ro}}
                    </div>
                    <div class="product_info_item">
                        <b>Cod:</b> {{$product[0]->cod}}
                    </div>
                    <div class="product_info_item">
                        <b>Categoria:</b><a href="/category/{{$product[0]->mycategory->slug}}" title="{{$product[0]->mycategory->name_ro}}"> {{$product[0]->mycategory->name_ro}}</a>
                    </div>
                    <div class="product_info_item">
                        <b>Producatorul:</b> <a href="/producator/{{$product[0]->myproducator->slug}}" title="{{$product[0]->myproducator->name}}">{{$product[0]->myproducator->name}}</a>
                    </div>
                    @if($product[0]->catalog <> null)
                        <div class="product_info_item">
                            <b>Descarca catalogul:</b> <span class="pdf"><a class="pdf" href="/storage/catalog/{{$product[0]->catalog}}" target="_blank"><i class="far fa-file-pdf"></i> {{$product[0]->name_ro}}</a></span>
                        </div>
                    @endif
                    <div class="product_info_contact">
                        <i class="fas fa-mobile-alt"></i> <a href="tel:+37362143388"> 062143388</a>
                    </div>
                </div>
            </div>
                <hr>
        </div>
            <div class="product_content_desc">
                {!! $product[0]->full_desc_ro!!}
            </div>
            <div class="product_content_img d-flex justify-content-center">
                @if($product[0]->catalog_img <> null)
                <img src="/storage/catalog_img/{{$product[0]->catalog_img}}" alt="{{$product[0]->name_ro}}">
                @endif
            </div>
        </div>
        {{\App\Http\Controllers\ProductController::random3()}}
    </div>
@endsection
