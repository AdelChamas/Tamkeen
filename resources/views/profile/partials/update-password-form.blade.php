<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('profile.update_password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('profile.password_advice') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="current_password">{{ __('profile.current_password') }}</label>
            <input id="current_password" name="current_password" type="password" class="mt-1 form-control" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label for="password">{{ __('profile.new_password') }}</label>
            <input id="password" name="password" type="password" class="mt-1 form-control" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="password_confirmation">{{ __('forms.confirm_password') }}</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="form-control mt-1" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn btn-primary mt-1">{{ __('forms.save') }}</button>
            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('profile.saved') }}</p>
            @endif
        </div>
    </form>
</section>
