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
            <i class="fa-solid fa-user self-center text-lg text-gray-600"></i>
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
    @yield('scripts')
</body>

</html>
