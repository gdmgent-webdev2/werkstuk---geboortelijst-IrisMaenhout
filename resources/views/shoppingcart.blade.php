@extends('layouts.master')

@section('content')
<div class="container">

    <h1 class="font-bold text-xl mb-8">{{__('Shoppingcart')}}</h1>

    @for ($i = 0; $i<2; $i++)
    <a href="product-33" class="card-item-list py-4 border-t flex gap-4">
        <div
            class="w-2/5 mx-auto h-32 bg-[url('https://www.bestevoormoeders.nl/wp-content/uploads/2019/09/speel7.jpg')] bg-center bg-cover mb-4 rounded-2xl max-w-[150px]">
        </div>
        <div class="w-5/6">
            <h3>Dreambee rammelaar Jules & odette</h3>
            <p>Dreambaby</p>
            <div class="flex justify-between mt-8">
                <p class="font-bold text-lg">€ 10,99</p>

                <button class="remove-item">
                    <i
                        class="fa-solid fa-trash text-light-blue border border-light-blue px-4 py-2 rounded hover:text-white hover:bg-light-blue"></i>
                </button>
            </div>

        </div>
        </a>
        @endfor
        <div class="border-t mb-4"></div>

        <div class="total-price flex justify-between p-4 mb-6 border border-primair bg-light-pink rounded">
            <p class="font-bold uppercase text-primair">{{__('Total:')}}</p>
            <p class="font-bold text-primair price">€ 15,88</p>
        </div>

        <div class="message p-4 mb-6 bg-light-yellow rounded">
            <label class="mb-2 block" for="message">{{__('Write a message (optional):')}}</label>

            <textarea class="w-full border-0 rounded" name="message" id="message" rows="4"></textarea>
        </div>

        <div class="mb-12">
            <x-button class="primair-btn">
                {{ __('Go to payment') }}
            </x-button>
        </div>


</div>
@endsection
