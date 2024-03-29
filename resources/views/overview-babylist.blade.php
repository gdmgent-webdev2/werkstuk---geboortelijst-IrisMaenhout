@php
    use App\Models\Favorite_Product;
@endphp

@extends('layouts.master')

@section('content')
<div class="container">

    {{-- Card babylist --}}
    <div class="grid grid-cols-3-odd-divided gap-4 bg-light-orange p-4 rounded-xl mb-8">
        <div>
            <div class="img-card w-11/12 mx-auto h-24 mb-4">
                <img src="{{$babylist['picture']}}" alt="{{$babylist['first_name_child']}} {{$babylist['last_name_child']}}">
            </div>
            <p class="text-center">{{count($products)}}
                @if (count($products)==1)
                {{strtolower(__('Item'))}}
                @else
                {{strtolower(__('Items'))}}
                @endif
            </p>
        </div>
        <div>
            <h2 class="font-bold text-lg">{{$babylist['first_name_child']}} {{$babylist['last_name_child']}}</h2>

            <p class="description cursor-pointer">
                {{__('Message')}}
                <i class="fa-solid fa-angle-down self-center ml-2"></i>
                <span class="block description-text hidden">{{$babylist['message']}}</span>
            </p>
        </div>
        <div class="flex justify-end">
            @auth
                <form action="create-babylist" method="post">
                    @csrf
                    <input type="hidden" name="babylist_id" value="{{$babylist['id']}}">
                    <button type="submit" href="create-babylist"><i class="fa-solid fa-pen text-primair border border-primair p-2 rounded"></i></button>
                </form>

            @endauth
        </div>
    </div>

    {{-- Share, export or add product to list --}}
    @if (auth()->user() !== null && auth()->user()->id === $babylist['user_id'])
    <div class="flex justify-between mb-8">
        <div>

            <form action="/export" method="POST" class="inline">
                @csrf
                <button class="export-list">
                    <i class="fa-solid fa-download rounded-full bg-light-blue p-2 text-white mr-2"></i>
                </button>
            </form>

            <a href="share-babylist-{{$babylist['id']}}">
                <i class="fa-solid fa-share-nodes rounded-full bg-light-blue p-2 text-white"></i>
            </a>
        </div>

        <form action="/shop" method="POST">
            @csrf
            <input type="hidden" name="babylist-id" value="{{$babylist['id']}}">
            <button type="submit" class="border border-primair rounded text-primair px-2 py-1 hover:bg-primair hover:text-white">{{__('Add items')}}</button>
        </form>

    </div>
    @endif


    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @foreach ($products as $product)

        @php
            $favorite_product = Favorite_Product::where('babylist_id', '=', $babylist['id'])->where('product_id', '=', $product[0]['id'])->get()->first();
        @endphp


        <a href="product-{{$product[0]['id']}}" class="card-item-list py-4 border-t flex gap-4">
            <div class="w-2/4 mb-4 rounded-2xl">
                <img class="w-full block" src="{{url('/storage' . '/' . $product[0]['image'])}}" alt="{{$product[0]['name']}}">
            </div>
            <div class="w-full">
                <h3>{{$product[0]['name']}}</h3>
                <div class="flex justify-between mt-8">
                    <p class="font-bold text-lg">{{$product[0]['price']}}</p>

                    @if (auth()->user() !== null && auth()->user()->id === $babylist['user_id'])
                        @if ($favorite_product->status !== 'paid')

                            {{-- delete item --}}
                            <form action="delete-saved-item" method="get">
                                <input type="hidden" name="product-id" value="{{$product[0]['id']}}">
                                <input type="hidden" name="babylist-id" value="{{$babylist['id']}}">
                                <button type='submit' class="remove-item">
                                    <i class="fa-solid fa-trash text-light-blue border border-light-blue px-4 py-2 rounded hover:text-white hover:bg-light-blue"></i>
                                </button>
                            </form>

                        @else
                            {{-- purchased item--}}
                            <div class="purchased-item">
                                <i class="fa-solid fa-check text-white px-4 py-2 rounded bg-light-green cursor-not-allowed"></i>
                            </div>
                        @endif


                    @else
                        {{-- add item to shoppingcart --}}
                        @if ($favorite_product->status !== 'paid')
                            <form action="/shoppingcart/add" method="post">
                                @csrf
                                <input type="hidden" name="product-id" value="{{$product[0]['id']}}">
                                <input type="hidden" name="babylist-id" value="{{$babylist['id']}}">

                                <button class="add-to-shoppingcart" type="submit">
                                    <i class="fa-solid fa-cart-shopping text-white bg-primair px-4 py-2 rounded hover:bg-primair-hover"></i>
                                </button>
                            </form>

                        @else
                            <div class="add-to-shoppingcart">
                                <i class="fa-solid fa-cart-shopping text-white bg-primair px-4 py-2 rounded cursor-not-allowed opacity-40"></i>
                            </div>
                        @endif
                    @endif

                </div>

            </div>
        </a>
        @endforeach
    </div>

</div>
@endsection

@section('scripts')
<script src="{{ asset('js/show-description-babylist.js') }}"></script>
@endsection
