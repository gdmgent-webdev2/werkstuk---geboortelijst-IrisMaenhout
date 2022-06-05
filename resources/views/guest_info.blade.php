@extends('layouts.master')

@section('content')
<div class="pt-16">
    <x-auth-card>
        <h1 class="font-bold text-2xl mb-8">{{__('Personal information')}}</h1>

        <form method="POST" action="/guest-info/save">

        @if (session('status'))
            <p class="text-red-400 mb-4">
                {{ session('status') }}
            </p>
        @endif

        @csrf

            {{-- @if ($babylist !== null)
                <input type="hidden" name="babylist-id" value="{{$babylist->id}}">
            @endif --}}


            <!-- Name -->
            <div>
                <x-label for="guest-first-name" :value="__('FirstName')"/>

                <x-input id="guest-first-name" class="block mt-1 w-full" type="text" name="guest-first-name"
                    :value="old('FirstName')" required autofocus/>
            </div>

            <div class="mt-4">
                <x-label for="guest-last-name" :value="__('LastName')" />

                <x-input id="guest-last-name" class="block mt-1 w-full" type="text" name="guest-last-name"
                    :value="old('LastName')" required autofocus/>
            </div>


            <!-- Email -->
            <div class="mt-4">
                <x-label for="guest-email" :value="__('Email')" />

                <x-input id="guest-email" class="block mt-1 w-full" type="email" name="guest-email"
                    :value="old('Email')" required autofocus/>
            </div>




            <div class="flex items-center justify-center mt-12 mb-12">
                <x-button class="primair-btn">
                    {{ __('Go further') }}
                </x-button>
            </div>

        </form>

    </x-auth-card>
</div>
@endsection
