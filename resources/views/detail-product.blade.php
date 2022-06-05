@extends('layouts.master')

@section('content')
<div class="container">
    <div>
        <img src="{{url('/storage' . '/' . $product->image)}}" alt="{{$product->name}}" class="mb-6 rounded-2xl mx-auto h-56">
    </div>

        @csrf
        <h3 class="font-bold text-xl">{{$product->name}}</h3>
        <p class="font-bold text-lg mt-4 mb-12">{{$product->price}}</p>

        {{-- Buttons --}}

        @auth
            @if ($favorite_product === null)
                {{-- Add to favorites --}}
                <form method="get" action="/save-product-in-babylist">
                    @csrf
                    <input type="hidden" id="product-id" name="product-id" value="{{$product->id}}">
                    <input type="hidden" name="babylist-id" value="{{$babylist_id}}">
                    <x-button class="primair-btn">
                        <i class="fa-solid fa-plus text-white text-xl mr-4"></i>
                        {{ __('Add to my list') }}
                    </x-button>
                </form>

            @else
                @if ($order !== null)
                    @if ($order->status === 'paid')
                        {{-- item is purchased --}}
                        <div class="bg-light-green text-white w-full p-4 rounded-md text-center">
                            <i class="fa-solid fa-check text-white text-xl mr-4"></i>
                            {{ __('The item has been purchased') }}
                        </div>


                        <h3 class="font-bold mt-8">Gekocht door:</h3>
                        <p>{{$order->first_name}} {{$order->last_name}}</p>


                        @if ($order->message !== '')
                            <h3 class="font-bold mt-8">Boodschap:</h3>
                            <p>{{$order->message}}</p>
                        @endif

                    @else
                        {{-- btn to delete item --}}
                        <form action="/delete-saved-item" method="get">
                            @csrf
                            <input type="hidden" name="babylist-id" value="{{$babylist_id}}">
                            <input type="hidden" id="product-id" name="product-id" value="{{$product->id}}">
                            <button type='submit' class="remove-item">
                                <i class="fa-solid fa-trash text-light-blue border border-light-blue px-4 py-2 rounded hover:text-white hover:bg-light-blue"></i>
                            </button>
                        </form>
                    @endif


                @else
                    <form action="/delete-saved-item" method="get">
                        @csrf
                        <input type="hidden" id="product-id" name="product-id" value="{{$product->id}}">
                        <input type="hidden" name="babylist-id" value="{{$babylist_id}}">
                        <button type='submit' class="remove-item w-full p-4 rounded-md text-center text-light-blue border border-light-blue hover:text-white hover:bg-light-blue">
                            <i class="fa-solid fa-trash text-xl mr-4"></i>
                            {{__('Remove')}}
                        </button>
                    </form>
                @endif


            @endif

        @endauth


        @guest
            @if ($order !== null)
                @if ($order->status === 'paid')
                    <div class="primair-btn opacity-40 text-white">
                        <i class="fa-solid fa-check text-xl mr-4"></i>
                        {{ __('The item has been purchased') }}
                    </div>
                @endif

            @else
                <form action="/shoppingcart/add" method="post">
                    @csrf
                    <input type="hidden" id="product-id" name="product-id" value="{{$product->id}}">
                    <input type="hidden" name="babylist-id" value="{{$babylist_id}}">
                    <x-button class="primair-btn">
                        <i class="fa-solid fa-cart-shopping text-white text-xl mr-4"></i>
                        {{ __('Add to my shoppingcart') }}
                    </x-button>
                </form>
            @endif

        @endguest

        <hr class="my-8">

        {{-- Extra info --}}

        <h3 class="font-bold">{{__('Product description')}}</h3>
        <p>{{$product->description}}</p>

        <h3 class="font-bold mt-8">{{__('Sold by:')}}</h3>
        <a href="{{$product->url_product}}" target="_blank" class="underline text-light-blue mb-12 block">{{$shop}}</a>


</div>
@endsection
