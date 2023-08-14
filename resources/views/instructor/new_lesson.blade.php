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
                    <h2>New Lesson | {{ $chapter->title }}</h2>
                    <x-alert></x-alert>
                    <form method="post" action="{{ route("newLesson", ['chapter_id' => $chapter->id]) }}" enctype="multipart/form-data">
                @else
                    <h2>{{ __('instructor.new_lesson') }}</h2>
                    <x-alert></x-alert>
                    <form method="post" action="{{ route("newLessonNoChapter") }}" enctype="multipart/form-data">
                @endif
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label" required>{{ __('forms.title') }}</label>
                        <input id="title" type="text" class="form-control" name="title">
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label" required>{{ __('forms.description') }}</label>
                        <input id="description" type="text" class="form-control" name="description">
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>
                    <div class="mb-3">
                        <label for="video" class="form-label" required>{{ __('forms.video') }}</label>
                        <input type="file" id="video" class="form-control" name="video">
                        <x-input-error class="mt-2" :messages="$errors->get('video')" />
                    </div>
                    <div class="mb-3">
                        <label for="poster" class="form-label">{{ __('forms.poster') }}</label>
                        <input type="file" id="poster" class="form-control" name="poster">
                        <x-input-error class="mt-2" :messages="$errors->get('poster')" />
                    </div>
                    <div class="mb-3">
                        <label for="attachments" class="form-label">{{ __('forms.attachments') }}</label>
                        <input id="attachments" type="file" class="form-control" name="attachment[]" multiple>
                        <x-input-error class="mt-2" :messages="$errors->get('attachment')" />
                    </div>
                    <div class="mb-3">
                        <label for="quiz" class="form-label">{{ __('forms.add_quiz') }}</label>
                        <select class="form-select" aria-label="Default select example" name="quiz" id="quiz">
                            <option selected disabled>--- {{ __('general.quiz') }} ---</option>
                            @foreach($assessments as $assessment)
                                <option value="{{ $assessment->id }}">{{ $assessment->title }}</option>
                            @endforeach
                        </select>
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
                    <x-input-error class="mt-2" :messages="$errors->get('chapter')" />
                    <button type="submit" class="btn btn-primary">{{ __('forms.add') }}</button>
                </form>
            </div>
        </main>
    </x-slot>
</x-user-layout>
