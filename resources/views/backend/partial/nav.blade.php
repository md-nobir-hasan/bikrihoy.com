<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">

        {{-- Cache Clear --}}
        <li class="nav-item">
            <a href="{{ route('optimize') }}" class="nav-link" title='Optimize the app'>
                <i class="fas fa-sync"></i>
            </a>
        </li>

        {{-- Going frontend home page menu --}}
        <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link" target="_blank">
                <i class="fas fa-external-link-alt" title="Go to Home Page"></i>
            </a>
        </li>

        {{-- Cache Clear --}}
        <li class="nav-item">
            <a href="{{ route('optimize-clear') }}" class="nav-link">
                <i class="fas fa-cog"></i>
                Cache Clear
            </a>
        </li>

        {{-- Optimize the app  --}}
        {{-- <li class="nav-item">
            <a href="{{ route('optimize') }}" class="nav-link">
                <i class="fas fa-cog"></i>
                Optimize the app
            </a>
        </li> --}}

        {{-- User profile --}}
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="@if (isset(Auth::user()->image)) {{ asset(Auth::user()->image) }}@else{{ asset('/images/default/human.webp') }} @endif"
                    class="user-image img-circle elevation-2" alt="">
                <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary">
                    <img src="@if (isset(Auth::user()->image)) {{ asset(Auth::user()->image) }}@else{{ asset('/images/default/human.webp') }} @endif"
                        class="img-circle elevation-2" alt="">
                    <p>
                        {{ Auth::user()->name }}

                        {{-- <small>Member since {{ Auth::user()->created_at->format('M. Y') }}</small> --}}
                    </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                    <a href="#" class="btn btn-default btn-flat float-right"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Sign out
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>
