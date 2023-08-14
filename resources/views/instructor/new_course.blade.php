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
                <h2>{{ __('instructor.new_course') }}</h2>
                <x-alert></x-alert>
                <form name="new_course" method="post" action="{{ route('newCourse') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label" required>{{ __('forms.title') }}</label>
                        <input type="text" id="title" class="form-control" name="title">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label" required>{{ __('forms.price') }}</label>
                        <input type="number" id="price" name="price" class="form-control">
                        <div class="form-text">{{ __('forms.price_free') }}</div>
                    </div>
                    <div class="mb-3">
                        <label for="overview" class="form-label">{{ __('forms.overview') }}</label>
                        <tinymce-editor
                            menubar="false"
                            api-key="your-tiny-cloud-api-key"
                            toolbar="undo redo | blocks | bold italic backcolor |
                            alignleft aligncenter alignright alignjustify |
                            bullist numlist outdent indent | removeformat | help"
                            name="overview"
                        ></tinymce-editor>
                    </div>
                    <div class="mb-3">
                        <label for="subjects" class="form-label" required>{{ __('forms.subjects') }}</label>
                        <input type="text" name="subjects" class="form-control" id="subjects" />
                    </div>
                    <div class="mb-3">
                        <label for="subjects" class="form-label" required>{{ __('forms.outcomes') }}</label>
                        <input type="text" name="outcomes" class="form-control" id="outcomes" />
                    </div>
                    <div class="mb-3">
                        <label for="pre" class="form-label">{{ __('forms.pre') }}</label>
                        <textarea class="form-control" name="pre" rows="4" id="pre"></textarea>
                        <div class="form-text">{{ __('forms.blank_pre') }}</div>
                    </div>
                    <div class="mb-3">
                        <label for="about" class="form-label">{{ __('forms.about') }}</label>
                        <tinymce-editor
                            menubar="false"
                            api-key="your-tiny-cloud-api-key"
                            toolbar="undo redo | blocks | bold italic backcolor |
                            alignleft aligncenter alignright alignjustify |
                            bullist numlist outdent indent | removeformat | help"
                            name="about"
                        ></tinymce-editor>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label" required>{{ __('forms.image') }}</label>
                        <input type="file" id="image" class="form-control" name="image">
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label" required>{{ __('forms.category') }}</label>
                        <select class="form-select" id="category" aria-label="Default select example" name="category">
                            <option selected>Open this select menu</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button id="submit" type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </main>
    </x-slot>
</x-user-layout>
