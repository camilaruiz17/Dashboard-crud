<aside id="sidebar-wrapper">
    <div class="sidebar-brand" style="background-color: #B5A2E1;">
        <img class="img-rounded" src="{{ asset('img/skinner.jpg') }}" width="143">
        <a href="{{ url('/') }}"></a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ url('/') }}" class="small-sidebar-text">
            <img class="navbar-brand-full" src="{{ asset('img/logo.png') }}" width="45px" alt=""/>
        </a>
    </div>
    <ul class="sidebar-menu">
        @include('layouts.menu')
    </ul>
</aside>
