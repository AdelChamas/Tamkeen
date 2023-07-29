<x-user-layout>
    <x-slot name="content">
        <div class="container">
            <article>
                <h2>{{ __('student.instructor') }}</h2>
                <p>
                    {{ __('student.instructor_desc') }}
                </p>
            </article>
            <a href="{{ redirect()->back() }}">{{ __('student.cancel') }}</a>
            <form method="post" action="{{ route('registerInstructor') }}">
                @csrf
                <button type="submit" class="btn btn-primary">{{ __('student.proceed') }}</button>
            </form>
        </div>
    </x-slot>
</x-user-layout>
