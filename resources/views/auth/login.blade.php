<x-guest-layout>
    <x-slot name="content">
        <div class="container" style="margin-top: 8rem;">
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <div class="social w-100 d-flex justify-content-center" >
                <a href="{{ route('facebook') }}" style="height: 60px; width: 200px; background-color: #ededed; padding: 5px; border-radius: 10px" class="mx-2 d-flex align-items-center justify-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><path fill="#FFC107" d="M43.611 20.083H42V20H24v8h11.303c-1.649 4.657-6.08 8-11.303 8c-6.627 0-12-5.373-12-12s5.373-12 12-12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4C12.955 4 4 12.955 4 24s8.955 20 20 20s20-8.955 20-20c0-1.341-.138-2.65-.389-3.917z"/><path fill="#FF3D00" d="m6.306 14.691l6.571 4.819C14.655 15.108 18.961 12 24 12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4C16.318 4 9.656 8.337 6.306 14.691z"/><path fill="#4CAF50" d="M24 44c5.166 0 9.86-1.977 13.409-5.192l-6.19-5.238A11.91 11.91 0 0 1 24 36c-5.202 0-9.619-3.317-11.283-7.946l-6.522 5.025C9.505 39.556 16.227 44 24 44z"/><path fill="#1976D2" d="M43.611 20.083H42V20H24v8h11.303a12.04 12.04 0 0 1-4.087 5.571l.003-.002l6.19 5.238C36.971 39.205 44 34 44 24c0-1.341-.138-2.65-.389-3.917z"/></svg>
                    <strong class="mx-2">{{ __('forms.google') }}</strong>
                </a>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email">{{__('forms.email')}}</label>
                    <input id="email" class="form-control" type="email" name="email" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <label for="password">{{__('forms.password')}}</label>

                    <input id="password" class="form-control"
                           type="password"
                           name="password"
                           required autocomplete="current-password"/>

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="form-check mt-2">
                    <input class="form-check-input p-0" type="checkbox" name="remember" id="remember_me">
                    <label class="form-check-label" for="remember_me">
                        {{ __('forms.remember_me') }}
                    </label>
                </div>

                <div class="flex items-center justify-content-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="btn btn-primary" href="{{ route('password.request') }}">
                            {{ __('forms.forgot_password') }}
                        </a>
                    @endif

                    <button class="btn btn-primary">
                        {{ __('forms.login') }}
                    </button>
                </div>
            </form>
        </div>
    </x-slot>

</x-guest-layout>
