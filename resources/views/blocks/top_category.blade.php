<nav class="container">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/"><img class="nav_img" src="/images/dentclub_white.png"
                                                  alt="DentClub.MD"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/" style="text-transform: uppercase;">Acasă</a>
                    </li>
                    @foreach($top_category as $category)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false" style="text-transform: uppercase;">
                                {{$category->name_ro}}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @foreach($all_category as $cat)
                                    @if($category->id == $cat->category_id)
                                        <li><a class="dropdown-item"
                                               href="{!! route('list_category', $cat->slug)!!}">{{$cat->name_ro}}</a></li>
                                    @endif
                                @endforeach
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="/category/{{$category->slug}}">Toate</a></li>
                            </ul>
                        </li>
                    @endforeach
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Caută" aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">Caută</button>
                </form>
            </div>
        </div>
    </nav>
    </div>
