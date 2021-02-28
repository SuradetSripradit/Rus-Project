@extends('layouts/master')
@section('menulist')
    <ul class="navbar-nav text-uppercase ml-auto">
        <li class="nav-item"><a class="nav-link js-scroll-trigger" style="color :black" href="/index"> หน้าแรก </a></li>
        <li class="nav-item"><a class="nav-link js-scroll-trigger" style="color :black" href="/relations"> ประชาสัมพันธ์ </a></li>
        <li class="nav-item"><a class="nav-link js-scroll-trigger" style="color :black" href="/course"> หลักสูตร </a></li> 
        <li class="nav-item"><a class="nav-link js-scroll-trigger" style="color :black" href="/re"> สมัครเรียน</a></li>
        @guest
                            <li class="nav-item">
                                <a class="nav-link" style="color :black" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                              
                            
                            @endif
                            @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" style="color :black" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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

@endsection

@section('BodyZone')

    @yield('Getbody')

@endsection

@section('AnotherLink')
@endsection