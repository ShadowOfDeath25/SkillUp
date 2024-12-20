<header>
    <div class="logo">SkillUp</div>
    <div class="search-container">
        <form class="search-form" method="GET" action="{{route("search.index")}}">
            <input type="text" class="search-input" placeholder="Search..." name="term">
            <button type="submit" class="search-button">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>
    <nav>
        <ul class="nav-list">
            @if(Auth::check())
                <li><span class="link">${{Auth::user()->credit}}</span></li>
            @endif
            <li>
                <div class="dropdown">
                    <button class="dropdown-btn">Categories</button>

                    <div class="dropdown-content">
                        @foreach($categories as $category)
                            <a href="#"> {{$category}}</a>
                        @endforeach
                    </div>
                </div>
            </li>
                <li><a class="link" href="{{route('home.index')}}">All Courses</a></li>
            @section('nav-buttons')
                <li><a class="border-btn" href="{{route("logout")}}">Sign Out</a></li>
            @show
        </ul>
    </nav>


</header>
