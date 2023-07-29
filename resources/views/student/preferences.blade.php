<x-user-layout>
    <x-slot name="content">
        <div class="student-dashboard">
            <x-student-sidebar></x-student-sidebar>
            <section>
                <h2>{{ __('student.preferences') }}</h2>
                <p>{{ __('student.pre_desc') }}</p>
                <x-alert></x-alert>
                <form method="post" action="{{ route('setPreferences') }}">
                    @csrf
                    @foreach($categories as $category)
                        <div class="form-check mt-3">
                            <label class="form-check-label" for="{{$category->category}}">
                                {{ $category->category }}
                            </label>
                            <input class="form-check-input p-0" type="checkbox" name="{{ $category->id }}" id="{{$category->category}}" @if(auth()->user()->preferences()->where('category_id', $category->id)->exists()) checked @endif>
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary">{{ __('forms.save') }}</button>
                </form>
            </section>
        </div>
    </x-slot>
</x-user-layout>
