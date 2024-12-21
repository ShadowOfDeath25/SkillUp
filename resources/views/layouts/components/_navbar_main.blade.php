@if(Auth::check()&& Auth::user()->role==="admin")
    @include("layouts.components._navbar_admin")
@elseif(Auth::check())
    @include("layouts.components._navbar")
@else
    @include("layouts.components._navbar_logged_out")
@endif
