@extends('layouts.master')

@section('popup')
<x-overlay></x-overlay>

<x-filter-shop></x-filter-shop>
@endsection

@section('content')
<div class="container">
    <h1 class="font-bold text-2xl mb-8">{{__('Add products to babylist')}}</h1>

    <div class="flex gap-4 mb-12">
        <button class="open-sidebar">
            <i class="fa-solid fa-filter bg-orange-yellow text-white p-4 rounded"></i>
        </button>


        <div
            class="searchbar rounded-md shadow-sm focus:ring focus:border-yellow-500 focus:ring-yellow-500 focus:opacity-40 pl-4 input-field w-full">
            <i class="fa-solid fa-magnifying-glass text-orange-yellow text-lg"></i>
            <input type="text" name="search" id="search" class="border-0 bg-[#FFFCF8] outline-none divide-none w-10/12">
        </div>

        <a href="/"><i class="fa-solid fa-arrow-right bg-primair text-white p-4 rounded"></i></a>
    </div>

    <div class="cards grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
        @foreach ($products as $product)

        {{-- products filterd by category --}}
        @if (isset($_GET['sub-category']))
            @foreach ($product as $item)
            <form method="get" action="/save-product-in-babylist" class="card-item-shop border px-8 py-4 rounded-2xl">
                @csrf
                <img src="{{url('/storage' . '/' . $item->image)}}" alt="{{$item->name}}" class="mx-auto h-56 mb-4 rounded-2xl w-4/5 mx-auto">

                <div>
                    <h3>{{$item->name}}</h3>
                    <p class="font-bold text-lg mt-4">{{$item->price}}</p>

                    <div class="flex justify-between content-center mt-12">
                        <a href="/product-{{$item->id}}" class="underline text-light-blue">{{__('Read more')}}</a>

                        <input type="hidden" id="id-product" name="id-product" value="{{$item->id}}">


                        @if (isset($babylist_id))
                            <input type="hidden" name="babylist-id" value="{{$babylist_id}}">
                        @endif

                        <button type="submit"
                            class="border border-primair rounded-full text-primair px-2 py-1 text-primair flex gap-4 hover:bg-primair hover:text-white">
                            <div
                                class="w-7 h-7 flex content-center items-center justify-center">
                                <i class="fa-solid fa-plus"></i>
                            </div>
                            {{__('Add')}}
                        </button>
                    </div>
                </div>
            </form>
            @endforeach

        @else
            {{-- All products --}}
            <form method="get" action="/save-product-in-babylist" class="card-item-shop border px-8 py-4 rounded-2xl">
                @csrf
                <img src="{{url('/storage' . '/' . $product->image)}}" alt="{{$product->name}}" class="mx-auto h-56 mb-4 rounded-2xl w-4/5 mx-auto">

                <div>
                    <h3>{{$product->name}}</h3>
                    <p class="font-bold text-lg mt-4">{{$product->price}}</p>

                    <div class="flex justify-between content-center mt-12">
                        <a href="/product-{{$product->id}}" class="underline text-light-blue">{{__('Read more')}}</a>

                        <input type="hidden" id="id-product" name="id-product" value="{{$product->id}}">

                        @if (isset($babylist_id))
                            <input type="hidden" name="babylist-id" value="{{$babylist_id}}">
                        @endif

                        <button type="submit"
                            class="border border-primair rounded-full text-primair px-2 py-1 text-primair flex gap-4 hover:bg-primair hover:text-white">
                            <div
                                class="w-7 h-7 flex content-center items-center justify-center">
                                <i class="fa-solid fa-plus content-center"></i>
                            </div>
                            {{__('Add')}}
                        </button>
                    </div>
                </div>
            </form>
        @endif
        @endforeach

    </div>

</div>
@endsection

@section('scripts')
<script src="{{ asset('js/toggle-filter.js') }}"></script>
<script src="{{ asset('js/close-popup.js') }}"></script>
@endsection
