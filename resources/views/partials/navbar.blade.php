<nav class="navbar navbar-expand-md border-bottom">
    <div class="container">
        @if (Auth::check() && Auth::user()->role === 'admin')
            <a class="navbar-brand text-secondarys fs-4" href="{{ route('admin.home') }}">
                laH?shop
            </a>
        @elseif (Auth::check() && Auth::user()->role === 'customer')
            <a class="navbar-brand text-secondarys fs-4" href="{{ route('home') }}">
                laH?shop
            </a>
        @else
            <a class="navbar-brand text-secondarys fs-4" href="{{ route('welcome') }}">
                laH?shop
            </a>
        @endif
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <form action="" method="get">
                    @csrf
                    <div class="d-flex">
                        <input type="text" class="form-control me-2" name="search" id="search"
                            value="{{ old('search', request()->search) }}">
                        <button class="btn btn-primarys">Search</button>
                    </div>
                </form>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link text-primarys me-1 pe-2 border-end"
                                href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link ms-2 btn-secondarys rounded-3" href="{{ route('register') }}">Register</a>
                        </li>
                    @endif
                @else
                    @if (Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a href="{{ route('orderAdmin.show') }}" class="nav-link position-relative me-2 text-primarys">
                                <i class="bi bi-box-seam-fill"></i>
                                @if (App\Models\Order::all()->count() === 0)
                                    <span
                                        class="position-absolute d-none top-4 start-90 translate-middle badge rounded-pill btn-secondarys">
                                        {{ App\Models\Order::all()->count() }}
                                    @else
                                    </span>
                                    <span
                                        class="position-absolute top-4 start-90 translate-middle badge rounded-pill btn-secondarys">
                                        {{ App\Models\Order::all()->count() }}
                                    </span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('transaction.show') }}"
                                class="nav-link position-relative me-2 text-primarys">
                                <i class="bi bi-check-circle"></i>
                                @if (App\Models\Transaction::all()->count() === 0)
                                    <span
                                        class="position-absolute d-none top-4 start-90 translate-middle badge rounded-pill ">
                                        {{ App\Models\Transaction::all()->count() }}
                                    </span>
                                @else
                                    <span
                                        class="position-absolute top-4 start-90 translate-middle badge rounded-pill btn-secondarys">
                                        {{ App\Models\Transaction::all()->count() }}
                                    </span>
                                @endif
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('whistlist.show') }}" class="nav-link position-relative me-2 text-primarys">
                                <i class="bi bi-bag"></i>
                                @php
                                    $whislist = App\Models\Whistlist::where('user_id', '=', Auth::user()->id)->count();
                                @endphp
                                @if ($whislist === 0)
                                    <span
                                        class="position-absolute d-none btn-secondarys top-4 start-90 translate-middle badge rounded-pill">
                                        {{ $whislist }}
                                    </span>
                                @else
                                    <span
                                        class="position-absolute btn-secondarys top-4 start-90 translate-middle badge rounded-pill">
                                        {{ $whislist }}
                                    </span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('order.waitConfirm') }}"
                                class="nav-link position-relative me-2 text-primarys">
                                <i class="bi bi-cart-check"></i>
                                @php
                                    $orderCount = \App\Models\Order::where('user_id', '=', Auth::user()->id)->count();
                                @endphp
                                @if ($orderCount === 0)
                                    <span
                                        class="position-absolute d-none btn-secondarys top-4 start-90 translate-middle badge rounded-pill">
                                        {{ $orderCount }}
                                    </span>
                                @else
                                    <span
                                        class="position-absolute btn-secondarys top-4 start-90 translate-middle badge rounded-pill">
                                        {{ $orderCount }}
                                    </span>
                                @endif
                            </a>
                        </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-primarys text-capitalize" href="#"
                            role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end border-0 shadow" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
