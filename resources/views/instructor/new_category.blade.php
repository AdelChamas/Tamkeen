<x-user-layout>
    <x-slot name="content">
        <script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-webcomponent@2/dist/tinymce-webcomponent.min.js"></script>
        <main class="instructor-main">
            @include('components.instructor-sidebar')
           <button class="sidebar-toggle btn btn-primary d-block d-md-none" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-dasharray="24" stroke-dashoffset="24" stroke-linecap="round" stroke-width="2"><path d="M5 5H19"><animate fill="freeze" attributeName="stroke-dashoffset" dur="0.2s" values="24;0"/></path><path d="M5 12H19"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.2s" dur="0.2s" values="24;0"/></path><path d="M5 19H19"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.4s" dur="0.2s" values="24;0"/></path></g></svg>
            </button>
            @vite('resources/js/responsive_sidebar.js')
            <div class="container">
                <h2>{{ __('instructor.new_category') }}</h2>
                <x-alert></x-alert>
                <form name="new_course" method="post" action="{{ route('newCategory') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="category" class="form-label">{{ __('forms.category_name') }}</label>
                        <input type="text" id="category" class="form-control" name="category">
                    </div>
                    <button id="submit" type="submit" name="submit" class="btn btn-primary">{{ __('forms.create') }}</button>
                </form>
            </div>
        </main>
    </x-slot>
</x-user-layout>
