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
                        @php($courses_ = [])
                        @foreach($courses as $course)
                            @php(array_push($courses_, $course->id))
                            <div class="card col-md-3 mx-2 my-2" style="width: 18rem;">
                                @if($course->instructors()->wherePivot('instructor_id', auth()->id())->value('main') == 1)
                                <a href="{{ route('addInstructor', ['course_id' => $course->id]) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m9.25 22l-.4-3.2q-.325-.125-.613-.3t-.562-.375L4.7 19.375l-2.75-4.75l2.575-1.95Q4.5 12.5 4.5 12.337v-.674q0-.163.025-.338L1.95 9.375l2.75-4.75l2.975 1.25q.275-.2.575-.375t.6-.3l.4-3.2h5.5l.4 3.2q.325.125.613.3t.562.375l2.975-1.25l2.75 4.75l-2.575 1.95q.025.175.025.338v.674q0 .163-.05.338l2.575 1.95l-2.75 4.75l-2.95-1.25q-.275.2-.575.375t-.6.3l-.4 3.2h-5.5Zm2.8-6.5q1.45 0 2.475-1.025T15.55 12q0-1.45-1.025-2.475T12.05 8.5q-1.475 0-2.488 1.025T8.55 12q0 1.45 1.012 2.475T12.05 15.5Zm0-2q-.625 0-1.063-.438T10.55 12q0-.625.438-1.063t1.062-.437q.625 0 1.063.438T13.55 12q0 .625-.438 1.063t-1.062.437ZM12 12Zm-1 8h1.975l.35-2.65q.775-.2 1.438-.588t1.212-.937l2.475 1.025l.975-1.7l-2.15-1.625q.125-.35.175-.737T17.5 12q0-.4-.05-.787t-.175-.738l2.15-1.625l-.975-1.7l-2.475 1.05q-.55-.575-1.212-.962t-1.438-.588L13 4h-1.975l-.35 2.65q-.775.2-1.437.588t-1.213.937L5.55 7.15l-.975 1.7l2.15 1.6q-.125.375-.175.75t-.05.8q0 .4.05.775t.175.75l-2.15 1.625l.975 1.7l2.475-1.05q.55.575 1.213.963t1.437.587L11 20Z"/></svg>
                                </a>
                                @endif
                                <img src="{{ asset('storage/' . $course->image) }}" class="card-img-top" alt="{{ $course->title }}" style="width: 100%; height: 100%">
                                <div class="card-body">
                                    <a href="{{ route('instructorCourse', ['id' => $course->id]) }}" class="card-title">{{ $course->title }}</a>
                                    <h3 class="badge bg-primary">{{ $course->category->category }}</h3>
                                    <div class="meta">
                                        <span class="my-2">{{ __('instructor.chapters_nb') }}: <strong>{{ sizeof(App\Models\Chapter::where('course_id', $course->id)->get()) }}</strong></span><br>
                                        <span class="my-2">{{ __('instructor.students') }}: <strong>{{ sizeof(App\Models\Course::where('id', $course->id)->get()[0]->students) }}</strong></span><br>
                                        <a class="my-2 btn btn-primary" href="{{ route('instructorChapters', ['course_id' => $course->id]) }}">Chapters</a>
                                    </div>
                                    <form class="my-2" id="delete-course-{{$course->id}}" action="{{ route('deleteCourse', ['id' => $course->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button id="delete-{{$course->id}}" class="btn btn-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/></svg>
                                        </button>
                                    </form>
                                    <a href="{{ route('updateCourse', ['id' => $course->id]) }}" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m19.3 8.925l-4.25-4.2l1.4-1.4q.575-.575 1.413-.575t1.412.575l1.4 1.4q.575.575.6 1.388t-.55 1.387L19.3 8.925ZM17.85 10.4L7.25 21H3v-4.25l10.6-10.6l4.25 4.25Z"/></svg>
                                    </a>
                                    <a href="{{ route('newChapter', ['course_id' => $course->id])  }}" class="btn btn-primary">Continue</a>
                                </div>
                            </div>
                        @endforeach
                        <script>
                            let courses_id = '{{ implode(',', $courses_) }}';
                            console.log(courses_id.split(',')[0]);
                            courses_id.split(',').forEach((course_id)=>{
                                document.getElementById('delete-' + course_id).addEventListener('click', (e)=>{
                                    e.preventDefault();
                                    if(confirm('Are you sure you want to delete the course?')){
                                        document.forms['delete-course-' + course_id].submit();
                                    }
                                })
                            })
                        </script>
                    </div>
                </section>
            </div>
        </main>

    </x-slot>
</x-user-layout>
