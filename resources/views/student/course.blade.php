<x-study-course-layout>
    <x-slot name="content">
        <nav class="sidebar close">
            <header>
                <div class="image-text">
                    <span class="image">
                        <!-- Course Cover -->
                        <img src="{{ asset('storage/' . $course->image) }}" alt="">
                    </span>

                    <div class="text logo-text">
                        <span class="name">{{ $course->title }}</span>
                    </div>
                </div>
                <hr>
                <i class='toggle'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2" d="m9 5l7 7l-7 7"/>
                    </svg>
                </i>
            </header>


            <div class="menu-bar">
                <div>
                    {{ __('general.instructor')}} 
                    <a href="{{ route('instructorCourses', ['instructor_id' => $course->instructors()->wherePivot('main', 1)->first()->id]) }}">
                        {{ $course->instructors()->wherePivot('main', 1)->first()->full_name }}
                    </a>
                </div>
                <div>
                    {{ __('general.assistant')}} 
                    <a href="{{ route('instructorCourses', ['instructor_id' => $course->instructors()->wherePivot('main', 0)->first()->id]) }}">
                        {{ $course->instructors()->wherePivot('main', 0)->first()->full_name }}</div>
                    </a>
                @foreach($chapters as $chapter)
                    <div class="menu current">
                        <li class="btn btn-primary collapsed" data-bs-toggle="collapse"
                            href="#chapter-{{ $chapter->id }}-materials" role="button" aria-expanded="false"
                            aria-controls="chapter-{{ $chapter->id }}-materials">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m6 9l6 6l6-6"/>
                            </svg>
                            <span>{{ $chapter->title  }}</span>
                        </li>
                        
                        <ul class="menu-links collapse" id="chapter-{{$chapter->id}}-materials">
                            @php($lessons = App\Models\Lesson::where('chapter_id', $chapter->id)->get())
                            @foreach($lessons as $lesson)
                                <li class="nav-link">
                                    <a class="ch-item btn btn-primary @if(isset($lesson_->id) && $lesson->id == $lesson_->id) current @endif"
                                       href="{{ route('studyLesson', ['lesson_id' => $lesson->id, 'course_id' => $course->id]) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                  d="M5 22q-.825 0-1.413-.588T3 20V4q0-.825.588-1.413T5 2h12q.825 0 1.413.588T19 4v7.075q-.25-.05-.537-.063T18 11q-2.875 0-4.938 2.038T11 18q0 1.075.325 2.1t.95 1.9H5Zm13 1q-2.075 0-3.538-1.463T13 18q0-2.075 1.463-3.538T18 13q2.075 0 3.538 1.463T23 18q0 2.075-1.463 3.538T18 23Zm-.475-2.975l2.55-1.6q.225-.15.225-.425t-.225-.425l-2.55-1.6q-.275-.15-.525-.013t-.25.438v3.2q0 .3.25.438t.525-.013ZM7.75 10.55L9.5 9.5l1.75 1.05q.25.15.5 0t.25-.425V4H7v6.125q0 .275.25.425t.5 0Z"/>
                                        </svg>
                                        <span class="text nav-text">{{ $lesson->title }}</span>
                                    </a>
                                </li>
                                @isset($lesson_)
                                    @if($lesson_->id == $lesson->id)
                                        <div class="lesson-materials">
                                            @php($attachs = $lesson_->attachments)
                                            @php($quizes = App\Models\Assessment::where('id', $lesson_->quiz_id)->get())
                                            @for($i = 0; $i < sizeof($attachs); $i++)
                                                <li class="nav-link">
                                                    <a href="#" class="ch-item" download>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                             fill="currentColor" class="bi bi-paperclip"
                                                             viewBox="0 0 16 16">
                                                            <path
                                                                d="M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0V3z"/>
                                                        </svg>
                                                        <span class="text nav-text">{{ __('general.attachment') . ' ' . $i }}</span>
                                                    </a>
                                                </li>
                                            @endfor
                                            @foreach($quizes as $quiz)
                                                <li class="nav-link">
                                                    <a href="{{ route('lessonQuiz', ['quiz_id' => $quiz->id, 'course_id' => $course->id]) }}" class="btn btn-primary ch-item">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M14 15q.425 0 .738-.313t.312-.737q0-.425-.313-.737T14 12.9q-.425 0-.738.313t-.312.737q0 .425.313.738T14 15Zm-.75-3.2h1.5q0-.725.15-1.063t.7-.887q.75-.75 1-1.212t.25-1.088q0-1.125-.788-1.837T14 5q-1.025 0-1.788.575T11.15 7.1l1.35.55q.225-.625.613-.938T14 6.4q.6 0 .975.338t.375.912q0 .35-.2.663t-.7.787q-.825.725-1.012 1.137T13.25 11.8ZM8 18q-.825 0-1.413-.588T6 16V4q0-.825.588-1.413T8 2h12q.825 0 1.413.588T22 4v12q0 .825-.588 1.413T20 18H8Zm0-2h12V4H8v12Zm-4 6q-.825 0-1.413-.588T2 20V6h2v14h14v2H4ZM8 4v12V4Z"/></svg>
                                                        <span class="text nav-text">{{ $quiz->title }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </div>
                                    @endif
                                @endisset
                            @endforeach
                            @php($discussions = App\Models\Discussion::where('chapter_id', $chapter->id)->get())
                            @foreach($discussions as $discussion)
                                <div class="chapter-discussions">
                                    <li class="nav-link">
                                        <a class="ch-item btn btn-primary @if(isset($discussion_->id) && $discussion_->id == $discussion->id) current @endif"
                                           href="{{ route('chapterDiscussion', ['course_id' => $course->id, 'discussion_id' => $discussion->id]) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 viewBox="0 0 16 16">
                                                <path fill="currentColor"
                                                      d="M1.75 1h8.5c.966 0 1.75.784 1.75 1.75v5.5A1.75 1.75 0 0 1 10.25 10H7.061l-2.574 2.573A1.458 1.458 0 0 1 2 11.543V10h-.25A1.75 1.75 0 0 1 0 8.25v-5.5C0 1.784.784 1 1.75 1ZM1.5 2.75v5.5c0 .138.112.25.25.25h1a.75.75 0 0 1 .75.75v2.19l2.72-2.72a.749.749 0 0 1 .53-.22h3.5a.25.25 0 0 0 .25-.25v-5.5a.25.25 0 0 0-.25-.25h-8.5a.25.25 0 0 0-.25.25Zm13 2a.25.25 0 0 0-.25-.25h-.5a.75.75 0 0 1 0-1.5h.5c.966 0 1.75.784 1.75 1.75v5.5A1.75 1.75 0 0 1 14.25 12H14v1.543a1.458 1.458 0 0 1-2.487 1.03L9.22 12.28a.749.749 0 0 1 .326-1.275a.749.749 0 0 1 .734.215l2.22 2.22v-2.19a.75.75 0 0 1 .75-.75h1a.25.25 0 0 0 .25-.25Z"/>
                                            </svg>
                                            <span class="text nav-text">{{ $discussion->title }}</span>
                                        </a>
                                    </li>
                                </div>
                            @endforeach
                            @php($assessments = App\Models\Assessment::where('id', $chapter->assessment_id)->get())
                            @foreach($assessments as $assessment)
                                <div class="chapter-discussions">
                                    <li class="nav-link">
                                        <a class="btn btn-primary @if(isset($exam->id) && $assessment->id == $exam->id) current @endif"
                                           href="{{ route('chapterExam', ['course_id' => $course->id, 'exam_id' => $assessment->id]) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48"
                                                 viewBox="0 0 48 48">
                                                <path fill="currentColor" fill-rule="evenodd"
                                                      d="M39 13a3 3 0 0 0-3 3v2h6v-2a3 3 0 0 0-3-3Zm3 7h-6v16.5l3 4.5l3-4.5V20ZM6 9v30a3 3 0 0 0 3 3h22a3 3 0 0 0 3-3V9a3 3 0 0 0-3-3H9a3 3 0 0 0-3 3Zm14 6a1 1 0 0 1 1-1h8a1 1 0 1 1 0 2h-8a1 1 0 0 1-1-1Zm1 3a1 1 0 1 0 0 2h8a1 1 0 1 0 0-2h-8Zm-1 10a1 1 0 0 1 1-1h8a1 1 0 1 1 0 2h-8a1 1 0 0 1-1-1Zm1 3a1 1 0 1 0 0 2h8a1 1 0 1 0 0-2h-8Zm-9-3v3h3v-3h-3Zm-1-2h5a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1h-5a1 1 0 0 1-1-1v-5a1 1 0 0 1 1-1Zm6.707-10.293a1 1 0 0 0-1.414-1.414L13 17.586l-1.293-1.293a1 1 0 0 0-1.414 1.414L13 20.414l4.707-4.707Z"
                                                      clip-rule="evenodd"/>
                                            </svg>
                                            <span class="text nav-text">{{ $assessment->title }}</span>
                                        </a>
                                    </li>
                                </div>
                            @endforeach
                            @php($notes = App\Models\Note::where('id', $chapter->note_id)->get())
                            @foreach($notes as $note)
                                <div class="chapter-discussions">
                                    <li class="nav-link">
                                        <a class="btn btn-primary @if(isset($note_->id) && $note->id == $note_->id) current @endif"
                                           href="{{ route('chapterNote', ['course_id' => $course->id, 'note_id' => $note->id]) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="m30.348 11.35l-3.6-3.6h-20.2v35.8h29.6v-18.7"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="m30.948 10.55l-13 18.2l-1.5 12.6l11.5-5.3l13.3-18.4a.978.978 0 0 0-.2-1.4l-8.4-6a1.268 1.268 0 0 0-1.7.3Z"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M16.948 36.85a4.4 4.4 0 0 1 3.5 2.6m-2.5-10.7l10 7.3m1.2-22.9l10 7.4m-11.4-5.6l10.1 7.4m-26.6-1.8v-9.5c0-1.4 2.5-1.3 2.5 0v10.7c0 2.5-4.7 2.5-4.7 0V7.45c0-4 5.6-4 5.9 0"/></svg>
                                            <span class="text nav-text">{{ $note->title }}</span>
                                        </a>
                                    </li>
                                </div>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
                <div class="dropdown m-1">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                @if(app()->getLocale() == null)
                                    en
                                @else
                                    {{ app()->getLocale() }}                                
                                @endif
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="{{ route('lang', ['lang' => 'ar']) }}">ar</a></li>
                                    <li><a class="dropdown-item" href="{{ route('lang', ['lang' => 'en']) }}">en</a></li>
                                </ul>
                        </div>
                <div class="bottom-content">
                    <span>{{ $progress }} %</span>
                    <progress value="{{ $progress }}" max="100"></progress>
                </div>
                <a href="{{ route('certificate', ['course_id' => $course->id]) }}" class="btn btn-primary my-2">{{ __('general.certificate') }}</a>
            </div>

        </nav>

        <section class="home container">
        <x-alert></x-alert>
        @if(session('certificate_locked') != null)
            <div class="certificate-locked">
                {{ session('certificate_locked') }}
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M16 8a3 3 0 0 1 3 3v8a3 3 0 0 1-3 3H7a3 3 0 0 1-3-3v-8a3 3 0 0 1 3-3V6.5C7 4 9 2 11.5 2S16 4 16 6.5V8M7 9a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2H7m8-1V6.5A3.5 3.5 0 0 0 11.5 3A3.5 3.5 0 0 0 8 6.5V8h7m-3.5 6a1.5 1.5 0 0 0-1.5 1.5a1.5 1.5 0 0 0 1.5 1.5a1.5 1.5 0 0 0 1.5-1.5a1.5 1.5 0 0 0-1.5-1.5m0-1a2.5 2.5 0 0 1 2.5 2.5a2.5 2.5 0 0 1-2.5 2.5A2.5 2.5 0 0 1 9 15.5a2.5 2.5 0 0 1 2.5-2.5Z"/></svg>
            </div>
        @elseif(isset($lesson_))
                <div class="text">{{ $lesson_->title }}</div>
                <p>{{ $lesson_->description }}</p>
                <video
                    id="my-video"
                    class="video-js"
                    controls
                    preload="auto"
                    width="640"
                    height="264"
                    poster="{{ ($lesson_->poster) ? asset('storage/' . $lesson_->poster) : asset('storage/assets/logo.png') }}"
                    data-setup='{ "fluid" : true }'
                >
                    <source src="{{ asset('storage/' . $lesson_->video) }}" type="video/mp4"/>
                    <p class="vjs-no-js">
                        To view this video please enable JavaScript, and consider upgrading to a
                        web browser that
                        <a href="https://videojs.com/html5-video-support/" target="_blank"
                        >supports HTML5 video</a
                        >
                    </p>
                </video>
            @elseif(isset($discussion_))
                <div class="text">{{ $discussion_->title }}</div>
                <form action="{{ route('newMessage', ['discussion_id' => $discussion_->id]) }}" method="post"
                      class="mt-2">
                    @csrf
                    <textarea name="message" class="form-control" cols="30" rows="5"
                              placeholder="{{ __('discussion.discussion') }}" required></textarea>
                    <x-input-error :messages="$errors->get('message')" class="mt-2" />
                    <button class="btn btn-primary mt-2">{{ __('forms.add') }}</button>
                </form>
                <hr>
                @php($messages = App\Models\Message::where('discussion_id', $discussion_->id)->get())
                <div class="messages">
                    @php($messages_ = [])
                    @foreach($messages as $message)
                        <div class="card my-2" id="{{ $message->sender_id }}">
                            @if($message->sender->id == auth()->id())
                            @php(array_push($messages_, $message->id))
                            <form method='post' action="{{ route('deleteMessage', ['id' => $message->id]) }}" id='delete-message-{{ $message->id }}'>
                                @csrf
                                <button class='btn' id='delete-{{ $message->id }}'>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="red" d="M7 21q-.825 0-1.413-.588T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.588 1.413T17 21H7Zm2-4h2V8H9v9Zm4 0h2V8h-2v9Z"/></svg>
                                </button>
                            </form>
                            @endif
                            <div class="card-body">
                                <div class="author">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M12 1.25a4.75 4.75 0 1 0 0 9.5a4.75 4.75 0 0 0 0-9.5ZM8.75 6a3.25 3.25 0 1 1 6.5 0a3.25 3.25 0 0 1-6.5 0ZM12 12.25c-2.313 0-4.445.526-6.024 1.414C4.42 14.54 3.25 15.866 3.25 17.5v.102c-.001 1.162-.002 2.62 1.277 3.662c.629.512 1.51.877 2.7 1.117c1.192.242 2.747.369 4.773.369s3.58-.127 4.774-.369c1.19-.24 2.07-.605 2.7-1.117c1.279-1.042 1.277-2.5 1.276-3.662V17.5c0-1.634-1.17-2.96-2.725-3.836c-1.58-.888-3.711-1.414-6.025-1.414ZM4.75 17.5c0-.851.622-1.775 1.961-2.528c1.316-.74 3.184-1.222 5.29-1.222c2.104 0 3.972.482 5.288 1.222c1.34.753 1.961 1.677 1.961 2.528c0 1.308-.04 2.044-.724 2.6c-.37.302-.99.597-2.05.811c-1.057.214-2.502.339-4.476.339c-1.974 0-3.42-.125-4.476-.339c-1.06-.214-1.68-.509-2.05-.81c-.684-.557-.724-1.293-.724-2.601Z" clip-rule="evenodd"/></svg>
                                    <div class="name-time">
                                        <h5 class="card-title">{{ $message->sender->full_name }}</h5>
                                        <div class="meta d-flex">
                                            <h6 class="card-subtitle mb-2 text-muted">{{ $message->created_at->diffForHumans() }}</h6>
                                            @isset($message->receiver_id)
                                                <h6 class="card-subtitle mb-2 text-muted">{{ __('discussion.reply_to') }} <a
                                                        href="#{{$message->receiver_id}}">{{ $message->receiver->full_name }}</a>
                                                </h6>
                                            @endisset
                                        </div>

                                    </div>
                                </div>
                                <p class="card-text">{{ $message->content }}</p>
                                <a href="#" class="reply-btn" id="reply-{{$message->id}}">
                                    {{ __('discussion.reply') }}
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                              d="M10 9V5l-7 7l7 7v-4.1c5 0 8.5 1.6 11 5.1c-1-5-4-10-11-11z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                    <script>
                        @foreach($messages as $message)
                        document.getElementById('reply-' + {{ $message->id }}).addEventListener('click', () => {
                            reply({{ $message->id }}, {{ $message->sender_id }})
                        }, {once: true});
                        @endforeach
                        let messages_id = "{{ implode(',', $messages_) }}";
                        messages_id.split(',').forEach((message_id)=>{
                            document.getElementById('delete-' + message_id).addEventListener('click', (e)=>{
                                e.preventDefault();
                                if(confirm('Are you sure you want to delete the message?')){
                                    document.forms['delete-message-' + message_id].submit();
                                }
                            })
                        })
                        function reply(id, receiver) {
                            const form = document.createElement("form");
                            form.action = '{{ route('newMessage', ['discussion_id' => $discussion_->id]) }}';
                            form.method = 'post';
                            form.classList.add('d-flex');
                            form.style.padding = "10px";
                            const csrf = document.createElement('input');
                            csrf.type = 'hidden';
                            csrf.name = '_token';
                            csrf.value = '{{ csrf_token() }}'
                            const input = document.createElement("input");
                            input.name = 'message';
                            input.classList.add("form-control");
                            input.style.marginRight = "10px";
                            const hidden_input = document.createElement("input");
                            hidden_input.type = 'hidden';
                            hidden_input.name = 'receiver';
                            hidden_input.value = receiver;
                            const submit = document.createElement("button");
                            submit.classList.add("btn");
                            submit.classList.add("btn-primary");
                            submit.classList.add("mx-2");
                            submit.innerHTML = "{{ __('discussion.reply') }}";

                            form.appendChild(input);
                            form.appendChild(csrf);
                            form.appendChild(hidden_input);
                            form.appendChild(submit);
                            const container = document.getElementById('reply-' + id);
                            container.appendChild(form);
                        }
                    </script>
                </div>
            @elseif(isset($exam))
                <h2>{{ $exam->title }}</h2>
                <p class="text-danger">
                    You can submit the exam only once. Once it's submitted you cannot update it.
                </p>
                <h3 id="timer"></h3>
                @php($questions = json_decode($exam->structure, true))
                @php($_questions = [])
                <form method="post"
                      id="exam"
                      action="{{ route('assess', ['course_id' => $course->id, 'exam_id' => $exam->id]) }}">
                    @foreach($questions as $question)
                        <div class="card question mt-2">
                            <div class="card-body">
                                <h5 class="card-title">Q: {{ $question['Question'] }}</h5>
                                @php(array_push($_questions, $question['Question']))
                                <div class="card-text">
                                    <div id="options">
                                        @foreach($question['Choices'] as $key => $value)
                                            @php($choice_id = $key . $value)
                                            <div class="option">
                                                <label for="option{{ $choice_id }}"
                                                       class="checkmark">{{ $value }}</label>
                                                <input type="radio" id="option{{ $choice_id }}" value="{{ $key }}"
                                                       name="{{ $question['Question'] }}">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <input type="hidden" name="questions" value="{{ implode(',', $_questions) }}">
                    <button class="btn btn-primary my-2">Submit</button>
                </form>
                <script>
                    const time = {{ $exam->duration }};
                    const lockTimeInMilliseconds = parseInt(time, 10) * 60000;

                    function disableInteractiveElements() {
                        const elements = document.querySelectorAll("button, input, select, textarea, a");
                        elements.forEach(element => {
                            element.disabled = true;
                        });
                    }

                    function lockPage() {
                        disableInteractiveElements();

                        const message = "The exam duration is end. This page is locked. You cannot perform any actions.";
                        const lockMessageElement = document.createElement("div");
                        lockMessageElement.textContent = message;
                        document.getElementById("timer").appendChild(lockMessageElement);
                        setTimeout(() => {
                            document.forms['exam'].submit()
                        }, 1000)
                    }
                    setTimeout(lockPage, lockTimeInMilliseconds);

                    const currentTime = new Date().getTime();

                    const duration = lockTimeInMilliseconds + 2000;

                    // Calculate the target end time by adding 5 minutes to the current time
                    const targetEndTime = currentTime + duration;
                    // Update the countdown every second
                    const countdown = setInterval(updateCountdown, 1000);

                    function updateCountdown() {
                        const currentTime = new Date().getTime();

                        const timeRemaining = targetEndTime - currentTime;

                        if (timeRemaining <= 0) {
                            clearInterval(countdown);
                            document.getElementById("timer").innerHTML = "Time Expired!";
                        } else {
                            const hours = Math.floor(timeRemaining / (1000 * 60 * 60));
                            const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
                            const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

                            // Display the countdown in the "timer" div
                            document.getElementById("timer").innerHTML = `Time Remaining: ${hours}h ${minutes}m ${seconds}s`;
                        }
                    }
                </script>
            @elseif(isset($result))
                <div class="alert alert-success">You got {{ $result }}</div>
            @elseif(isset($quiz))
                <h2>{{ $quiz->title }}</h2>
                @php($questions = json_decode($quiz->structure, true))
                @php($_questions = [])
                <form method="post"
                      id="exam"
                      action="{{ route('assessQuiz', ['course_id' => $course->id, 'quiz_id' => $quiz->id]) }}">
                    @foreach($questions as $question)
                        <div class="card question mt-2">
                            <div class="card-body">
                                <h5 class="card-title">Q: {{ $question['Question'] }}</h5>
                                @php(array_push($_questions, $question['Question']))
                                <div class="card-text">
                                    <div id="options">
                                        @foreach($question['Choices'] as $key => $value)
                                            @php($choice_id = $key . $value)
                                            <div class="option">
                                                <label for="option{{ $choice_id }}"
                                                       class="checkmark">{{ $value }}</label>
                                                <input type="radio" id="option{{ $choice_id }}" value="{{ $key }}"
                                                       name="{{ $question['Question'] }}">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <input type="hidden" name="questions" value="{{ implode(',', $_questions) }}">
                    <button class="btn btn-primary my-2">Submit</button>
                </form>
            @elseif(isset($note_))
                <h2>{{ $note_->title }}</h2>
                <div>{!! $note_->note !!}</div>

            @endif

        </section>
    </x-slot>
</x-study-course-layout>
<link href="https://vjs.zencdn.net/8.3.0/video-js.css" rel="stylesheet"/>


