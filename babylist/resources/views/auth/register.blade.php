<x-guest-layout>
    <x-auth-card>
        {{-- <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot> --}}


        <h1 class="title flex justify-center mb-4">{{__('Register')}}</h1>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Full name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            {{-- <div>
                <x-label for="first-name" :value="__('FirstName')" />

                <x-input id="first-name" class="block mt-1 w-full" type="text" name="first-name" :value="old('FirstName')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="last-name" :value="__('LastName')" />

                <x-input id="last-name" class="block mt-1 w-full" type="text" name="last-name" :value="old('LastName')" required autofocus />
            </div> --}}

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="items-center justify-center mt-4">
                <div class="flex items-center justify-center mt-12">
                    <x-button class="primair-btn">
                        {{ __('Register') }}
                    </x-button>
                </div>

                <div class="link-to-register mt-12">
                    <p>{{__('Do you already have an account?')}}</p>
                    <a href="{{ route('login') }}">{{__('Log in here')}}</a>
                </div>

            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
