@extends('layouts.master')

@section('content')
<div class="container">
    <h1 class="font-bold text-2xl mb-8">{{__('Overview babylists')}}</h1>
    <div class="cards grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach ($babylists as $babylist)
            <a href="babylist-{{strtolower($babylist->first_name_child)}}-{{strtolower(str_replace(' ', '-', $babylist->last_name_child))}}" class="card flex">
                <div class="img-card bg-[url('https://wij.nl/sites/default/files/baby-verzorging.jpg')]"></div>
                <div>
                    <h3 class="font-semibold">{{$babylist->first_name_child}} {{$babylist->last_name_child}}</h3>
                    <p>25 {{strtolower(__('Items'))}}</p>
                    <button class="border border-primair rounded text-primair px-2 py-1 mt-6 disabled:opacity-30"
                    @if ($babylist->closed)
                        disabled="true"
                    @endif
                    >{{__('Close list')}}</button>
                </div>
            </a>
        @endforeach

    </div>

    <div class="flex justify-end mt-12">
        <a href="/create-babylist" class="add_babylist mb-7"><i class="fa-solid fa-plus"></i></a>
    </div>



</div>
@endsection
