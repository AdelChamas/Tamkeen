<x-guest-layout>
    <x-slot name="content">
        <div class="container">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <!-- Name -->
                <div>
                    <label for="name">{{ __('forms.name') }}</label>
                    <input id="name" class="form-control" type="text" name="name"  required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <label for="email">{{ __('forms.email') }}</label>
                    <input id="email" class="form-control" type="email" name="email" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <label for="password">{{ __('forms.password') }}</label>

                    <input id="password" class="form-control"
                           type="password"
                           name="password"
                           required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <label for="password_confirmation">{{ __('forms.confirm_password') }}</label>

                    <input id="password_confirmation" class="form-control"
                           type="password"
                           name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                        {{ __('forms.already_registered') }}
                    </a>

                    <button class="btn btn-primary">
                        {{ __('forms.register') }}
                    </button>
                </div>
            </form>
        </div>
    </x-slot>
</x-guest-layout>
