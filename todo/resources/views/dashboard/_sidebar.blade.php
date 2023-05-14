<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{route('lk.dashboard')}}">
                    <span data-feather="home" class="align-text-bottom"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('lk.my-lists')}}">
                    <span data-feather="file-text" class="align-text-bottom"></span>
                    Мои списки
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('lk.trust-lists')}}">
                    <span data-feather="file-text" class="align-text-bottom"></span>
                    Доверенные мне списки
                </a>
            </li>
        </ul>
        <hr>

        <div class="p-3">
            @if($tags=\App\Models\Tags::all())
                <h2 class="h4">Облако тегов</h2>
                @foreach($tags as $tag)
                    <a href="{{route("lk.tag", ['id'=>$tag->id])}}" class="shadow p-1 m-1 badge text-bg-secondary text-decoration-none">{{$tag->title}}</a>
                @endforeach
            @endif
        </div>

    </div>
</nav>
