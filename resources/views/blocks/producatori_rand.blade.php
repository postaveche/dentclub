<div class="random_block">
    <div class="container">
        <h4 class="d-flex justify-content-center">PRODUCATORI</h4>
        <div class="row w-100 d-flex justify-content-center">
            @foreach($producatori as $prod)
                <div class="product_item">
                    <div class="product_item_container">
                        <div class="product_item_img"><a href="{{route('productpage', $prod->slug)}}"
                                                         title="{{$prod->name}}"><img
                                    src="/storage/producatori/{{$prod->logo}}@200"
                                    alt="{{$prod->name}}" style="width: 200px;"></a></div>
                        <div class="product_item_name"><a href="{{route('productpage', $prod->slug)}}"
                                                          title="{{$prod->name}}">{{$prod->name}}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
