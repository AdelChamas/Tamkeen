<x-user-layout>
    <x-slot name="content">
        <main class="instructor-main">
            @include('components.instructor-sidebar')
            <button class="sidebar-toggle btn btn-primary d-block d-md-none" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-dasharray="24" stroke-dashoffset="24" stroke-linecap="round" stroke-width="2"><path d="M5 5H19"><animate fill="freeze" attributeName="stroke-dashoffset" dur="0.2s" values="24;0"/></path><path d="M5 12H19"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.2s" dur="0.2s" values="24;0"/></path><path d="M5 19H19"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.4s" dur="0.2s" values="24;0"/></path></g></svg>
            </button>
            @vite('resources/js/responsive_sidebar.js')
            <div class="container">
                <h2>{{ $lesson->title }}</h2>
                <x-alert></x-alert>
                <form method="post" action="{{ route("updateLesson", ['id' => $lesson->id]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">{{ __('forms.title') }}</label>
                        <input id="title" type="text" class="form-control" name="title" value="{{ $lesson->title }}">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">{{ __('forms.description') }}</label>
                        <input id="description" type="text" class="form-control" name="description" value="{{ $lesson->description }}">
                    </div>
                    <div class="mb-3">
                        <video class="card-img-top" width="320" height="240" controls>
                            <source src="{{ asset('storage/' . $lesson->video) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <label for="video" class="form-label">{{ __('forms.video') }}</label>
                        <input type="file" id="video" class="form-control" name="video">
                    </div>
                    <div class="mb-3">
                        <label for="attachments" class="form-label">{{ __('forms.attachments') }}</label>
                        <input id="attachments" type="file" class="form-control" name="attachment" multiple>
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
                    <button type="submit" class="btn btn-primary">{{ __('forms.update') }}</button>
                </form>
            </div>
        </main>
    </x-slot>
</x-user-layout>
