<x-guest-layout>
    <x-slot name="content">
        <div class="container">
            <div class="mb-4 text-sm text-gray-600">
                {{ __('auth.forgot_msg') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email">Email</label>
                    <input id="email" class="form-control" type="email" name="email" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button class="btn btn-primary">
                        {{ __('auth.reset_link') }}
                    </button>
                </div>
            </form>
        </div>
    </x-slot>
</x-guest-layout>
