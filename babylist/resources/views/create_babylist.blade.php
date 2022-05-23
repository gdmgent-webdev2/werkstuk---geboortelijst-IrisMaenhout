@extends('layouts.master')

@section('content')
<div class="pt-16">
    <x-auth-card>
        <h1 class="font-bold text-2xl mb-8">{{__('Create babylist')}}</h1>

        <form method="POST" action="{{ route('create_babylist.save') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="first-name-child" :value="__('FirstName child')"/>

                <x-input id="first-name-child" class="block mt-1 w-full" type="text" name="first-name-child"
                    :value="old('FirstName child')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="last-name-child" :value="__('LastName child')" />

                <x-input id="last-name-child" class="block mt-1 w-full" type="text" name="last-name-child"
                    :value="old('LastName child')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required />
            </div>

            <!-- Image uploaden -->
            <div class="mt-4">
                <x-label for="baby_upload" :value="__('Picture (optional)')" />

                <input type="file" name="baby_upload" id="baby_upload" class="block mt-1">
            </div>


            <!-- Message -->
            <div class="mt-4">
                <x-label for="message" :value="__('Message')" />

                <x-textarea id="message" class="block mt-1 w-full" type="text" name="message"
                    :value="old('Message')" required autofocus />
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
