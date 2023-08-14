<x-user-layout>
    <x-slot name="content">
        <main class="instructor-main">
            @include('components.instructor-sidebar')
            <div class="instructor-dashboard">
                <section class="container">
                    <button class="sidebar-toggle btn btn-primary d-block d-md-none" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-dasharray="24" stroke-dashoffset="24" stroke-linecap="round" stroke-width="2"><path d="M5 5H19"><animate fill="freeze" attributeName="stroke-dashoffset" dur="0.2s" values="24;0"/></path><path d="M5 12H19"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.2s" dur="0.2s" values="24;0"/></path><path d="M5 19H19"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.4s" dur="0.2s" values="24;0"/></path></g></svg>
                    </button>
                    @vite('resources/js/responsive_sidebar.js')
                    <h2>{{ __('instructor.dashboard_title') }}</h2>
                    <a href="{{ route('newCourse') }}" class="btn btn-primary">{{ __('instructor.new_course') }}</a>
                    <x-alert></x-alert>
                    <div class="row">
                            <form class="my-2"  action="{{ route('addInstructor', ['course_id' => $course_id]) }}" method="post">
                                @csrf
                                <select name='instructor' class="form-select">
                                @foreach($instructors as $instructor)
                                    <option value={{ $instructor->id }}>{{ $instructor->email }}</option>
                                @endforeach
                                </select>
                                <button class="btn btn-primary my-2">
                                    {{ __('forms.add') }}
                                </button>
                            </form>
                    </div>
                    <div class="row mx-1">
                        <h2>{{ __('general.course_instructors') }}</h2>
                        <ul class="list-group" id="myList">
                            @foreach($course_instructors as $instructor)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $instructor->full_name }}</span>
                                    <a href="{{ route('removeInstructor', ['instructor_id' => $instructor->id, 'course_id' => $course_id]) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M7 21q-.825 0-1.413-.588T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.588 1.413T17 21H7Zm2-4h2V8H9v9Zm4 0h2V8h-2v9Z"/></svg>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
            </div>
        </main>

    </x-slot>
</x-user-layout>
