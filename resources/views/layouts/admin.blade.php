@yield('style')

@include('Dashboard.includes.header')

@include('Dashboard.includes.navbar')

@include('Dashboard.includes.aside')

<div class="content-wrapper">
    @yield('content')
</div>

@include('Dashboard.includes.footer')

@yield('script')

@include('Dashboard.partials._session')