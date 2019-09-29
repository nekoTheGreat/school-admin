@include('layouts.top')

@include('layouts.navbar')

<div class="uk-container" style="margin-top:10px;">
@yield('content')
</div>
@include('layouts.bottom')