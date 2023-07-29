<x-user-layout>
    <x-slot name="content">
        <main class="instructor-main">
            @include('components.instructor-sidebar')
            <button class="sidebar-toggle btn btn-primary d-block d-md-none" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-dasharray="24" stroke-dashoffset="24" stroke-linecap="round" stroke-width="2"><path d="M5 5H19"><animate fill="freeze" attributeName="stroke-dashoffset" dur="0.2s" values="24;0"/></path><path d="M5 12H19"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.2s" dur="0.2s" values="24;0"/></path><path d="M5 19H19"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.4s" dur="0.2s" values="24;0"/></path></g></svg>
            </button>
            @vite('resources/js/responsive_sidebar.js')
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('instructorDashboard') }}">{{ __('instructor.dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('instructorChapters', ['course_id' => $chapter->course_id]) }}">{{ __('general.chapters') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $chapter->title }}</li>
                    </ol>
                </nav>
                <hr>
                <ul>
                    <a href="{{ route('newAssessment', ['course_id' => $chapter->course_id]) }}" class="btn btn-primary m-2">{{ __('instructor.new_assessment') }}</a>
                    <a href="{{ route('newNote', ['chapter_id' => $chapter->id]) }}" class="btn btn-primary m-2">{{ __('instructor.new_note') }}</a>
                    <a href="{{ route('newLesson', ['chapter_id' => $chapter->id]) }}" class="btn btn-primary">{{ __('instructor.new_lesson') }}</a>
                </ul>
                <hr>
                <h2>{{ $chapter->title }}</h2>
                <x-alert></x-alert>
                <form class="pb-5" method="post" action="{{ route('updateChapter', ['id' => $chapter->id]) }}">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">{{ __('forms.title') }}</label>
                        <input type="text" class="form-control" name="title" id='title' value='{{ $chapter->title }}'>
                    </div>
                    <div class="mb-3">
                        <label for="assessment" class="form-label">{{ __('forms.add_assessment') }}</label>
                        <a href="{{ route('newAssessment', ['course_id' => $chapter->course_id]) }}" class="btn btn-primary m-2">New Assessment</a>
                        <select class="form-select" aria-label="Default select example" name="assessment" id="assessment">
                            <option selected disabled>--- {{ __('forms.assessment') }} ---</option>
                            @foreach($assessments as $assessment)
                                <option value="{{ $assessment->id }}" @if($assessment->id == $chapter->assessment_id) selected @endif>{{ $assessment->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label">{{ __('forms.add_note') }}</label>
                        <a href="{{ route('newChapter', ['course_id' => $chapter->course_id]) }}" class="btn btn-primary m-2">{{ __('forms.new_note') }}</a>
                        <select class="form-select" aria-label="Default select example" name="note" id="note">
                            <option selected disabled>--- {{ __('forms.note') }} ---</option>
                            @foreach($notes as $note)
                                <option value="{{ $note->id }}" @if($note->id == $chapter->note_id) selected @endif>{{ $note->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('forms.update') }}</button>
                </form>
                <hr>
                <div class="mt-5">
                    <h2>{{ __('general.lessons') }}</h2>
                    <a href="{{ route('newLesson', ['chapter_id' => $chapter->id]) }}" class="btn btn-primary">{{ __('instructor.new_lesson') }}</a>
                    <div class="row">
                        @php($lessons_ids = [])
                        @foreach($lessons as $lesson)
                            @php(array_push($lessons_ids, $lesson->id))
                            <div class="card m-3 col-md-5">
                                <video class="card-img-top" width="320" height="240" controls>
                                    <source src="{{ asset('storage/' . $lesson->video) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <div class="card-body">
                                    <a class="card-title" href="{{ route('studyLesson', ['course_id' => $chapter->course_id, 'lesson_id' => $lesson->id]) }}">{{ $lesson->title }}</a>
                                    <p class="card-text">{{ $lesson->description }}</p>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <a class="btn btn-info my-1" href="{{ route('updateLesson', ['id' => $lesson->id]) }}">{{ __('instructor.edit') }}</a>
                                            <form id="delete-lesson-{{$lesson->id}}" action="{{ route('deleteLesson', ['id' => $lesson->id]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button id="delete-{{$lesson->id}}" class="btn btn-danger" type="submit">{{ __('instructor.delete') }}</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <script>
                            let lessons = '{{ implode(',', $lessons_ids)}}'
                            lessons.split(',').forEach(lesson_id => {
                                document.getElementById('delete-' + lesson_id).addEventListener('click', function(e){
                                    e.preventDefault();
                                    if(confirm("Are you sure you want to delete the lesson?")){
                                        document.forms['delete-lesson-' + lesson_id].submit()
                                    }
                                })
                            })
                        </script>
                    </div>
                </div>
                <hr>
                <div class="mt-5">
                    <h2>{{ __('general.discussions') }}</h2>
                    <a href="{{ route('newDiscussion', ['chapter_id' => $chapter->id]) }}" class="btn btn-primary">{{ __('instructor.new_discussion') }}</a>
                    <div class="row">
                        @php($discussion_ids = [])
                        @foreach($discussions as $discussion)
                            @php(array_push($discussion_ids, $discussion->id))
                            <div class="card m-3 col-md-5">
                                <div class="card-body">
                                    <a href="{{ route('updateDiscussion', ['id' => $discussion->id]) }}" class="card-title">{{ $discussion->title }}</a>
                                    <p class="card-text">{{ $discussion->question }}</p>
                                    <p class="card-text"><small class="text-muted">{{ sizeof(App\Models\Message::where('discussion_id', $discussion->id)->get()) }} {{ __('general.messages') }}</small></p>
                                    <div class="row">
                                        <a class="btn btn-primary col-sm-5" href="{{ route('updateDiscussion', ['id' => $discussion->id]) }}">{{ __('instructor.edit') }}</a>
                                        <form id="delete-discussion-{{$discussion->id}}" action="{{ route('deleteDiscussion', ['id' => $discussion->id]) }}" method="post" class='col-sm-5'>
                                            @csrf
                                            @method('DELETE')
                                            <button id="delete-{{$discussion->id}}" type="submit" class="btn btn-danger">{{ __('instructor.delete') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <script>
                            let discussions = '{{ implode(',', $discussion_ids)}}'
                            discussions.split(',').forEach(discussion_id => {
                                document.getElementById('delete-' + discussion_id).addEventListener('click', function(e){
                                    e.preventDefault();
                                    if(confirm("Are you sure you want to delete the discussion?")){
                                        document.forms['delete-discussion-' + discussion_id].submit()
                                    }
                                })
                            })
                        </script>
                    </div>
                </div>
                <div class="mt-5">
                    <h2>{{ __('general.notes') }}</h2>
                    <a href="{{ route('newNote', ['chapter_id' => $chapter->id]) }}" class="btn btn-primary">{{ __('instructor.new_note') }}</a>
                    <div class="row">
                        @php($notes_ids = [])
                        @foreach($notes as $note)
                            @php(array_push($notes_ids, $note->id))
                            <div class="card m-3 col-md-5">
                                <div class="card-body">
                                    <a href="{{ route('updateNote', ['id' => $note->id]) }}" class="card-title">{{ $note->title }}</a>
                                    <p class="card-text">{{ $note->title }}</p>
                                    <div class="row">
                                        <a href="{{ route('updateNote', ['id' => $note->id]) }}" class="btn btn-primary col-sm-5">Edit</a>
                                        <form id="delete-note-{{$note->id}}" action="{{ route('deleteNote', ['id' => $note->id]) }}" method="post" class="col-sm-5">
                                            @csrf
                                            @method('DELETE')
                                            <button id="delete-{{$note->id}}" type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <script>
                            let notes = '{{ implode(',', $notes_ids)}}'
                            notes.split(',').forEach(note_id => {
                                document.getElementById('delete-' + note_id).addEventListener('click', function(e){
                                    e.preventDefault();
                                    if(confirm("Are you sure you want to delete the note?")){
                                        document.forms['delete-note-' + note_id].submit()
                                    }
                                })
                            })
                        </script>
                    </div>
                </div>
            </div>
        </main>
    </x-slot>
</x-user-layout>
