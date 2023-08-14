<x-user-layout>
    <x-slot name="content">
        <main class="instructor-main">
            @include('components.instructor-sidebar')
            <button class="sidebar-toggle btn btn-primary d-block d-md-none" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-dasharray="24" stroke-dashoffset="24" stroke-linecap="round" stroke-width="2"><path d="M5 5H19"><animate fill="freeze" attributeName="stroke-dashoffset" dur="0.2s" values="24;0"/></path><path d="M5 12H19"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.2s" dur="0.2s" values="24;0"/></path><path d="M5 19H19"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.4s" dur="0.2s" values="24;0"/></path></g></svg>
            </button>
            @vite('resources/js/responsive_sidebar.js')
            <div class="container">
                <h2>New Assessment</h2>
                <x-alert></x-alert>
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                @endif
                <form class="container" method="post" action="{{ route('newAssessment') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label" required>{{ __('forms.title') }}</label>
                        <input id="title" type="text" class="form-control" name="title" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="duration" class="form-label" required>{{ __('forms.duration') }}</label>
                        <input id="duration" type="number" name="duration" class="form-control">
                    </div>
                    <div class="text-muted">
                        {{ __('info.exams') }}
                    </div>
                    <div class="ex-container">
                        <div class="btns">
                            <button class="ex-btn" id="new-question">new question</button>
                            <button class="ex-btn" id="exam-submit">done</button>
                        </div>
                        <div class="ex-errors">

                        </div>
                        <div id="ex-questions">

                        </div>
                    </div>
                    @vite(['resources/js/exam.js', 'resources/css/exam.css'])
                    <div class="mb-3">
                        <label for="duration" class="form-label">Type</label>
                        <select class="form-select" aria-label="Default select example" name="type">
                            <option selected disabled>--- {{ __('general.assessment') }} ---</option>
                            <option value="1">{{ __('general.quiz') }}</option>
                            <option value="2">{{ __('general.exam') }}</option>
                        </select>
                    </div>

                    <input type="hidden" id="structure" name="structure">
                    <button type="submit" class="btn btn-primary" id="submit">{{ __('forms.add') }}</button>
                </form>
            </div>
        </main>
    </x-slot>
</x-user-layout>
