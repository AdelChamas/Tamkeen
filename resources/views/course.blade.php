<x-app-layout>
    <x-slot name="content">
        <section class="page-banner pt-200 pb-100 bg_cover" style="background-image:url({{ asset('storage/' . $course->image) }})">
            <div class=container>
                <x-alert></x-alert>
                <div class=row>
                    <div class=col-lg-12>
                        <div class="banner-content text-center">
                            <h1 class=text-white>{{ $course->title }}</h1>
                            <nav aria-label=breadcrumb>
                                <ol class=breadcrumb>
                                    <li class=breadcrumb-item><a href={{ route('home') }}>{{ __('navbar.home') }}</a></li>
                                    <li class="breadcrumb-item active" aria-current=page>{{ $course->title }}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id=course class="course-area pt-140">
            <div class=container>
                <div class=row>
                    <div class=col-lg-8>
                        <div class=single-course-wrapper>
                            <div class="course-title mb-30">
                                <h3 class=mb-20>{{ __('pages.overview') }}</h3>
                                <p>{!! $course->overview !!}</p>
                            </div>
                            <div class="course-description pb-20 border-bottom">
                                <h3 class=mb-20>{{ __('pages.about') }}</h3>
                                <p class=mb-30>{!! $course->about !!}</p>
                            </div>
                            <div class="course-included pt-50 pb-50 border-bottom">
                                <h3 class=mb-20>{{ __('pages.topics') }}</h3>
                                <div class=row>
                                    <div class=col-md-6>
                                        <ul>
                                            @php($topics = explode(',', $course->subjects))
                                            @foreach($topics as $topic)
                                                <li><i class="lni lni-checkmark"></i> {{ $topic }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="course-included pt-50 pb-50 border-bottom">
                                <h3 class=mb-20>{{ __('pages.outcomes') }}</h3>
                                <div class=row>
                                    <div class=col-md-6>
                                        <ul>
                                            @php($outcomes = explode(',', $course->outcomes))
                                            @foreach($outcomes as $outcome)
                                                <li><i class="lni lni-checkmark"></i> {{ $outcome }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @php($chapters = App\Models\Chapter::where('course_id', $course->id)->get())
                            @isset($chapters)
                                <div class="course-content pt-50 pb-35">
                                    <h3 class=mb-20>{{ __('pages.plan') }}</h3>
                                    <div class=accordion id=accordionExample>
                                        @for($i = 1; $i < sizeof($chapters); $i++)
                                            <div class=single-accordion>
                                                <div class=accordion-btn id=heading{{$i}}>
                                                    <button class="btn-block text-left" type=button data-bs-toggle=collapse data-bs-target="#collapse{{ $i }}" aria-expanded=true aria-controls=collapseOne>
                                                        Chapter {{ $i }}
                                                    </button>
                                                </div>
                                                <div id="collapse{{ $i }}" class="collapse @if($i == 1) show @else collapsed @endif" aria-labelledby=heading{{$i}} data-bs-parent="#accordionExample">
                                                    <div class=accordion-content>
                                                        {{ $chapters[$i]->title }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            @endisset
                        </div>
                    </div>
                    <div class=col-lg-4>
                        <div class=right-sidebar>
                            <div class="course-info mb-50">
                                <h3 class="mb-20 text-center">{{ __('pages.course_info') }}</h3>
                                <ul class=mb-30>
                                    <li class="d-flex justify-content-between">
                                        <span>{{ __('pages.discipline') }}:</span>
                                        <span class=text-right><a href="javascript:void(0)">{{ $course->category->category }}</a></span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <span>{{ __('pages.pre') }}: </span>
                                        <span class=text-right>{{ ($course->pre_requisites) ?? 'Nothing' }}</span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <span>{{ __('pages.price') }}:</span>
                                        <span class="text-right text-warning">{{ isset($course->price) ? '$'.$course->price : 'Free' }}</span>
                                    </li>
                                </ul>
                                @php($user = \App\Models\User::whereHas('coursesEnrolled', function($query) use ($course) {
                                    $query->where('course_id', $course->id);
                                })->get())
                                @if(isset($user[0]) && $user[0] == auth()->user())
                                    <a href="{{ route('studyCourse', ['id' => $course->id]) }}" class="main-btn btn-hover">Continue Learning</a>
                                @else
                                    <a href="{{ route('enroll', ['course_id' => $course->id]) }}" class="main-btn btn-hover">{{ isset($course->price) ? 'Purchase' : 'Enroll' }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </x-slot>
</x-app-layout>

