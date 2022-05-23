@extends('layouts.master')

@section('content')
<div class="pt-16">
    <x-auth-card>
        <h1 class="font-bold text-2xl mb-8">{{__('Share babylist')}}</h1>

        <form method="POST">
            {{-- <form method="POST" action="{{ route('create_babylist') }}"> --}}
            @csrf

            <!-- Email -->
            <div class="email-adresses">
                <div>
                    <label for="email-1">{{__('Person 1: email')}}</label>

                    <x-input id="email-1" class="block mt-1 w-full email-input" type="text" name="email-1"
                        :value="old('Person 1: email')" required autofocus />
                </div>
            </div>


            <div class="flex justify-end mb-12 mt-4">
                <button class="underline text-light-blue add-email">{{__('Add new person')}}</button>
            </div>

            <x-button class="primair-btn">
                {{ __('Share') }}
            </x-button>
        </form>

    </x-auth-card>
</div>

@endsection


@section('scripts')
    <script src="{{ asset('js/share-add-email.js') }}"></script>
@endsection
