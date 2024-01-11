<div class="sidebar">
    <h4>PRODUCĂTORI</h4>
    <hr>
    <nav>
        <ul>
            @foreach($producatori as $producator)
                <li class="sidebar_maincategory"><b><a href="{{route('list_producatori', $producator->slug)}}">{{$producator->name}}</a></b></li>
            @endforeach
        </ul>
    </nav>
</div>
