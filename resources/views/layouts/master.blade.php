<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $_ENV["APP_NAME"] }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/f677a13f9c.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

</head>

<body>
    @yield('popup')

    {{-- Navigation --}}
    <nav class="flex justify-between px-12 py-4 fixed w-full bg-white z-10">
        <a href="/"><h2 class="logo text-3xl text-primair">{{ $_ENV["APP_NAME"]}}</h2></a>

        @auth
            <div class="cursor-pointer">
                <p class="username mr-auto ml-0">{{auth()->user()->name}} <i class="ml-4 fa-solid fa-angle-down"></i></p>

                <a href="logout" class="hidden logout mr-auto ml-0 mt-2 bg-white absolute block border border-slate-300 pl-2 pr-16 py-1 shadow-md">{{__('Logout')}}</a>
            </div>
        @endauth

        @guest
            <a href="{{strtolower(__('Shoppingcart'))}}" class="self-center"><i class="fa-solid fa-cart-shopping text-lg text-gray-600"></i></a>
        @endguest
    </nav>

    {{-- Content --}}
    <div class="content">
        @yield('content')
    </div>

    {{-- Scripts --}}
    <script src="{{ asset('js/logout-toggle.js') }}"></script>
    @yield('scripts')
</body>

</html>
