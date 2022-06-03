@extends('layouts.master')

@section('content')
<div class="container">
    <div>
        <img src="{{url('/storage' . '/' . $product[0]->image)}}" alt="{{$product[0]->name}}" class="mb-6 rounded-2xl mx-auto h-56">
    </div>


    <form method="get" action="/save-product-in-babylist">
        @csrf
        <h3 class="font-bold text-xl">{{$product[0]->name}}</h3>
        <p class="font-bold text-lg mt-4 mb-12">{{$product[0]->price}}</p>
        <input type="hidden" id="id-product" name="id-product" value="{{$product[0]->id}}">

        @auth
        <x-button class="primair-btn">
            <i class="fa-solid fa-plus text-white text-xl mr-4"></i>
            {{ __('Add to my list') }}
        </x-button>
        @endauth

        @guest
        <x-button class="primair-btn">
            <i class="fa-solid fa-cart-shopping text-white text-xl mr-4"></i>
            {{ __('Add to my shoppingcart') }}
        </x-button>
        @endguest

        <hr class="my-8">

        <h3 class="font-bold">{{__('Product description')}}</h3>
        <p>{{$product[0]->description}}</p>

        <h3 class="font-bold mt-8">{{__('Sold by:')}}</h3>
        <a href="{{$product[0]->url_product}}" target="_blank" class="underline text-light-blue mb-12 block">{{$shop}}</a>
    </form>

</div>
@endsection
