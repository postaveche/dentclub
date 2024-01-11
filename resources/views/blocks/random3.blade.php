<div class="random_block">
    <div class="container">
        <div class="row d-flex"></div>
        @foreach($products as $prod)
            <div class="product_block col-sm-4">
                {{$prod->name_ro}}
            </div>
        @endforeach
    </div>
</div>
