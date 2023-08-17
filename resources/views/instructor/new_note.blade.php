<x-user-layout>
    <x-slot name="content">
        <main class="instructor-main">
            @include('components.instructor-sidebar')
            <button class="sidebar-toggle btn btn-primary d-block d-md-none" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-dasharray="24" stroke-dashoffset="24" stroke-linecap="round" stroke-width="2"><path d="M5 5H19"><animate fill="freeze" attributeName="stroke-dashoffset" dur="0.2s" values="24;0"/></path><path d="M5 12H19"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.2s" dur="0.2s" values="24;0"/></path><path d="M5 19H19"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.4s" dur="0.2s" values="24;0"/></path></g></svg>
            </button>
            @vite('resources/js/responsive_sidebar.js')
            <div class="container">
                @if(isset($chapter))
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('instructorDashboard') }}">{{ __('instructor.dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('instructorChapters', ['course_id' => $chapter->course_id]) }}">{{ __('general.chapters') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('updateChapter', ['id' => $chapter->id]) }}">{{ $chapter->title }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('instructor.new_note') }}</li>
                    </ol>
                </nav>
                <x-alert></x-alert>
                <h2>{{ __('instructor.new_note') }} | {{ $chapter->title }}</h2>
                <form method="post" action="{{ route("newNote", ['chapter_id' => $chapter->id]) }}" enctype="multipart/form-data">
                    @csrf
                @else
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('instructorDashboard') }}">{{ __('instructor.dashboard') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('instructor.new_note') }}</li>
                    </ol>
                </nav>
                <x-alert></x-alert>
                <h2>{{ __('instructor.new_note') }}</h2>
                <form method="post" action="{{ route("newNoteNoChapter") }}" enctype="multipart/form-data">
                    @csrf
                @endif
                    <div class="mb-3">
                        <label for="title" class="form-label" required>{{ __('forms.title') }}</label>
                        <input id="title" type="text" class="form-control" name="title">
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>
                    <div class="mb-3">
                        <label for="about" class="form-label">{{ __('general.note') }}</label>
                        <script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-webcomponent@2/dist/tinymce-webcomponent.min.js"></script>
                        <tinymce-editor
                            menubar="false"
                            api-key="your-tiny-cloud-api-key"
                            plugins="advlist lists"
                            toolbar="undo redo | blocks | bold italic backcolor |
                            alignleft aligncenter alignright alignjustify |
                            bullist numlist outdent indent | removeformat | help"
                            name="note"
                        ></tinymce-editor>
                    </div>
                    @isset($chapters)
                        <div class="mb-3">
                            <label for="chapter" class="form-label" required>{{ __('general.chapter') }}</label>
                            <select class="form-select" aria-label="Default select example" name="chapter" id="chapter">
                                <option selected disabled>--- {{ __('general.chapter') }} ---</option>
                                @foreach($chapters as $chapter)
                                    <option value="{{ $chapter->id }}">{{ $chapter->title }} | {{ $chapter->course->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endisset
                    <x-input-error class="mt-2" :messages="$errors->get('note')" />
                    <button type="submit" class="btn btn-primary">{{ __('forms.add') }}</button>
                </form>
            </div>
        </main>
    </x-slot>
</x-user-layout>
