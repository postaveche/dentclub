<div class="sidebar">
    <h4>CATEGORII</h4>
    <hr>
    <nav>
        <ul>
            @foreach($top_category as $top)
                <li class="sidebar_maincategory"><b><a href="{{route('list_category', $top->slug)}}">{{$top->name_ro}}</a></b></li>
                @foreach($all_category as $all)
                    @if($top->id == $all->category_id)
                        <li class="sidebar_subcategory"><a href="{{route('list_category', $all->slug)}}" title="{{$all->name_ro}}">{{$all->name_ro}}</a></li>
                    @endif
                @endforeach
            @endforeach
        </ul>
    </nav>
</div>
