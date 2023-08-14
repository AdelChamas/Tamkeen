<x-user-layout>
    <x-slot name="content">
        <main class="instructor-main">
            @include('components.instructor-sidebar')
            <button class="sidebar-toggle btn btn-primary d-block d-md-none" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-dasharray="24" stroke-dashoffset="24" stroke-linecap="round" stroke-width="2"><path d="M5 5H19"><animate fill="freeze" attributeName="stroke-dashoffset" dur="0.2s" values="24;0"/></path><path d="M5 12H19"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.2s" dur="0.2s" values="24;0"/></path><path d="M5 19H19"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.4s" dur="0.2s" values="24;0"/></path></g></svg>
            </button>
            @vite('resources/js/responsive_sidebar.js')
            <div class="container">
                @if(isset($course))
                    <h2>{{ __('instructor.new_chapter') }} | <strong>{{ $course->title }}</strong></h2>
                    <x-alert></x-alert>
                    <form method="post" action="{{ route('newChapter', ['course_id' => $course->id]) }}">
                @else
                    <h2>{{ __('instructor.new_chapter') }}</h2>
                    <x-alert></x-alert>
                    <form method="post" action="{{ route('newChapterNoCourse') }}">
                @endif
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label" required>{{ __('forms.title') }}</label>
                        <input type="text" class="form-control" name="title" id='title'>
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>
                    <div class="mb-3">
                        <label for="assessment" class="form-label">{{ __('instructor.new_assessment') }}</label>
                        <a href="{{ route('newAssessment') }}" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd"><path d="M24 0v24H0V0h24ZM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018Zm.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022Zm-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01l-.184-.092Z"/><path fill="currentColor" d="M12 2v6.5a1.5 1.5 0 0 0 1.356 1.493L13.5 10H20v10a2 2 0 0 1-1.85 1.995L18 22H6a2 2 0 0 1-1.995-1.85L4 20V4a2 2 0 0 1 1.85-1.995L6 2h6Zm0 9.5a1 1 0 0 0-.993.883L11 12.5V14H9.5a1 1 0 0 0-.117 1.993L9.5 16H11v1.5a1 1 0 0 0 1.993.117L13 17.5V16h1.5a1 1 0 0 0 .117-1.993L14.5 14H13v-1.5a1 1 0 0 0-1-1Zm2-9.457a2 2 0 0 1 .877.43l.123.113L19.414 7a2 2 0 0 1 .502.84l.04.16H14V2.043Z"/></g></svg>
                        </a>
                        <select class="form-select" aria-label="Default select example" name="assessment" id="assessment">
                            <option selected disabled>--- {{ __('forms.assessment') }} ---</option>
                            @foreach($assessments as $assessment)
                                <option value="{{ $assessment->id }}">{{ $assessment->title }}</option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('assessment')" />
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label">{{ __('instructor.new_note') }}</label>
                            <select class="form-select" aria-label="Default select example" name="note" id="note">
                            <option selected disabled>--- {{ __('forms.note') }} ---</option>
                            @foreach($notes as $note)
                                <option value="{{ $note->id }}">{{ $note->title }}</option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('note')" />
                    </div>
                    @isset($courses)
                        <div class="mb-3">
                            <label for="course" class="form-label">{{ __('general.course') }}</label>
                            <a href="{{ route('newCourse') }}" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none"><path d="M24 0v24H0V0h24ZM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018Zm.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022Zm-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01l-.184-.092Z"/><path fill="currentColor" d="M9.52 3a2 2 0 0 1 1.561.75l1.4 1.75H20a2 2 0 0 1 2 2V19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.52Zm0 2H4v14h16V7.5h-7.52a2 2 0 0 1-1.561-.75L9.519 5ZM12 9a1 1 0 0 1 1 1v2h2a1 1 0 1 1 0 2h-2v2a1 1 0 1 1-2 0v-2H9a1 1 0 1 1 0-2h2v-2a1 1 0 0 1 1-1Z"/></g></svg>
                            </a>
                            <select class="form-select" aria-label="Default select example" name="course" id="course">
                                <option selected disabled>--- {{ __('general.course') }} ---</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('note')" />
                        </div>
                    @endisset
                    <button type="submit" class="btn btn-primary">{{ __('forms.add') }}</button>
                </form>
            </div>
        </main>
    </x-slot>
</x-user-layout>
