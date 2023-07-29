<x-guest-layout>
    <x-slot name="content">
        <div class="container">
            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div>
                    <label for="email">{{ __('forms.email') }}</label>
                    <input id="email" class="form-control" type="email" name="email" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <label for="password">{{ __('forms.password') }}</label>
                    <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
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
                    <button class="btn btn-primary">
                        {{ __('auth.reset_password') }}
                    </button>
                </div>
            </form>
        </div>
    </x-slot>
</x-guest-layout>
