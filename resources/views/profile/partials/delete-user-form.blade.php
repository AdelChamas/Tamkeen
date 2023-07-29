<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('profile.delete_account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('profile.delete_notice') }}
        </p>

        <form id="delete" method="post" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')

            <div class="mt-6">
                <label for="password"class="sr-only">{{ __('forms.password') }}</label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    class="form-control"
                    placeholder="{{ __('forms.password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <button id="delete-btn" class="btn btn-danger my-1" class="ml-3">
                {{ __('profile.delete_account') }}
            </button>
        </form>
    </header>

    <script>
        document.getElementById('delete-btn').addEventListener('click', (e) => {
            e.preventDefault();
            if(confirm({{__('profile.delete_notice')}})){
                document.forms['delete'].submit();
            }
        });

    </script>
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
    </x-modal>
</section>
