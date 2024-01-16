<div class="random_block">
    <div class="container">
        <h4 class="d-flex justify-content-center">PRODUSE RECOMANDATE</h4>
        <div class="row w-100 d-flex justify-content-center">
        @foreach($products as $prod)
            <div class="product_item">
                <div class="product_item_container">
                    <div class="product_item_img"><a href="{{route('productpage', $prod->slug)}}"
                                                     title="{{$prod->name_ro}}"><img
                                src="/storage/products_thumb/{{$prod->image_thumb}}@200"
                                alt="{{$prod->name_ro}}" style="width: 200px;"></a></div>
                    <div class="product_item_name"><a href="{{route('productpage', $prod->slug)}}"
                                                      title="{{$prod->name_ro}}">{{$prod->name_ro}}</a>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>
