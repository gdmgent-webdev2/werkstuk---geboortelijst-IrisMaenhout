@extends('layouts.master')

@section('content')
<x-auth-card>
    <h2 class="font-bold text-xl mt-12 mb-6 sm:mt-0 ">{{__('Enter the password')}}</h2>
    <form method="POST" action="{{$babylist_url}}">
        @csrf
        @if(Session::has('message'))
            <p class="text-red-400 mb-4">
                {{ Session::get('message') }}
            </p>
        @endif

        <div>
            <x-input id="password" class="block mt-1 w-full mb-14" type="password" name="password" :value="old('Password')"
                required autofocus />
        </div>

        <x-button class="primair-btn">
            {{ __('Go further') }}
        </x-button>
    </form>

</x-auth-card>
@endsection
