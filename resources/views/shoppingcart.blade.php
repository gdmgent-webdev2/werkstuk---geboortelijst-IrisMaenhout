@extends('layouts.master')

@section('content')
<div class="container">

    <h1 class="font-bold text-xl mb-8">{{__('Shoppingcart')}}</h1>

    @foreach ($products_shoppingcart as $product)
        <a href="product-{{$product->id}}" class="card-item-list py-4 border-t flex gap-4">
            <div class="w-2/5 mx-auto h-32 mb-4  max-w-[150px]">
                <img  class="rounded-2xl" src="{{$product->attributes->image}}" alt="{{$product->name}}">
            </div>
            <div class="w-5/6">
                <h3>{{$product->name}}</h3>
                <p>Dreambaby</p>
                <div class="flex justify-between mt-8">
                    <p class="font-bold text-lg">€ {{$product->price}}</p>

                    <form action="shoppingcart/delete-item" method="POST">
                        @csrf
                        <input type="hidden" name="product-id" value="{{$product->id}}">
                        <button class="remove-item" type="submit">
                            <i
                                class="fa-solid fa-trash text-light-blue border border-light-blue px-4 py-2 rounded hover:text-white hover:bg-light-blue"></i>
                        </button>
                    </form>

                </div>

            </div>
        </a>
    @endforeach



        <div class="border-t mb-4"></div>

        <div class="total-price flex justify-between p-4 mb-6 border border-primair bg-light-pink rounded">
            <p class="font-bold uppercase text-primair">{{__('Total:')}}</p>
            <p class="font-bold text-primair price">€ {{$total}}</p>
        </div>

        <div class="message p-4 mb-6 bg-light-yellow rounded">
            <label class="mb-2 block" for="message">{{__('Write a message (optional):')}}</label>

            <textarea class="w-full border-0 rounded" name="message" id="message" rows="4"></textarea>
        </div>


        {{-- link to checkout -> I need to place this on the next page --}}
        <a href="/checkout">Ga naar de checkout</a>

        <div class="mb-12">
            <x-button class="primair-btn">
                {{ __('Go to payment') }}
            </x-button>
        </div>


</div>
@endsection
