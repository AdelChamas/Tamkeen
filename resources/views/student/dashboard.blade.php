<x-user-layout>
    <x-slot name="content">
        <main class="instructor-main">
            <x-student-sidebar></x-student-sidebar>
            <section class="student-dashboard">
                <section>
                    <button class="sidebar-toggle btn btn-primary d-block d-md-none" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-dasharray="24" stroke-dashoffset="24" stroke-linecap="round" stroke-width="2"><path d="M5 5H19"><animate fill="freeze" attributeName="stroke-dashoffset" dur="0.2s" values="24;0"/></path><path d="M5 12H19"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.2s" dur="0.2s" values="24;0"/></path><path d="M5 19H19"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.4s" dur="0.2s" values="24;0"/></path></g></svg>
                    </button>
                    @vite('resources/js/responsive_sidebar.js')
                    @if(sizeof($courses) == 0)
                        <h2>{{ __('student.no_courses') }} <a class="text-primary" href="{{ route('courses') }}">{{ __('student.get_started') }}</a></h2>
                    @else
                        <h2>{{ __('student.continue') }}</h2>
                    @endif
                    <x-alert></x-alert>
                    <div class="row">
                        @if(! auth()->user()->hasVerifiedEmail())
                            <a href="{{ route('verification.notice') }}" class="btn btn-info">{{ __('student.verify') }}</a>
                        @endif
                        @foreach($courses as $course)
                            <div class="card" style="width: 18rem; padding: 0">
                                <img src="{{ asset('storage/' . $course->image) }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <a href="{{ route('studyCourse', ['id' => $course->id]) }}" class="card-title">{{ $course->title }}</a>
                                    <h3 class="badge bg-primary">{{ $course->category->category }}</h3>
                                    <a href="{{ route('studyCourse', ['id' => $course->id]) }}" class="btn btn-primary">{{ __('student.continue') }}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            </section>
        </main>

    </x-slot>
</x-user-layout>
