<x-app-layout>
    <x-slot name="content">
        <section class="page-banner pt-200 pb-100 bg_cover" style="background-image:url({{ asset('storage/assets/hero-bg.jpg') }})">
            <div class=container>
                <x-alert></x-alert>

                <div class=row>
                    <div class=col-lg-12>
                        <div class="text-center banner-content">
                            <h1 class=text-white>{{ __('pages.courses') }}</h1>
                            <nav aria-label=breadcrumb>
                                <ol class=breadcrumb>
                                    <li class=breadcrumb-item><a href="{{ route('home')  }}">{{ __('navbar.home') }}</a></li>
                                    <li class="breadcrumb-item active" aria-current=page>{{ __('pages.courses') }}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section id=courses class="course-area pt-140">
            <div class=container>
                <div class=row>
                    <div class="mx-auto col-xl-6 col-lg-7 col-md-10">
                        <div class="text-center section-title mb-50">
                            @if(isset($category))
                                <h2 class="mb-15 wow fadeInUp" data-wow-delay=.2s>{{ $category->category }} {{ __('pages.courses') }}</h2>
                            @else
                                <h2 class="mb-15 wow fadeInUp" data-wow-delay=.2s>{{ __('pages.courses') }}</h2>
                            @endif
                            <p class="wow fadeInUp" data-wow-delay=.4s>{{ __('pages.courses_desc') }}</p>
                        </div>
                    </div>
                </div>
                <div class="row mb-30">
                    @auth
                        <a class="text-info my-2" href="{{ route('editPreferences') }}">{{ __('pages.preferences') }}</a>
                    @endauth
                    <hr>
                    @if(strpos(request()->headers->get('referer'), 'student/') !== false && strpos(url()->current(), 'student') !== false)
                        @foreach($courses as $course)
                            <div class="col-xl-4 col-lg-4 col-md-6">
                                <div class="single-course wow fadeInUp" data-wow-delay=.2s>
                                    <div class=course-img>
                                        <a href={{ route('course', ['id' => $course[0]->id]) }}>
                                            <img src="{{ asset('storage/' . $course[0]->image) }}" alt="" data-pagespeed-url-hash=1975346514 onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                                        </a>
                                    </div>
                                    <div class=course-info>
                                        <h4><a href={{ route('course', ['id' => $course[0]->id]) }}>{{ $course[0]->title }}</a></h4>
                                        <div class=course-meta>
                                            <div class=meta-item>
                                                <i class="lni lni-user"></i>
                                                <span>{{ sizeof($course[0]->students) }}</span>
                                            </div>
                                            <div class=meta-item>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="256" height="256" viewBox="0 0 256 256"><path fill="currentColor" d="m231.65 194.55l-33.19-157.8a16 16 0 0 0-19-12.39l-46.81 10.06a16.08 16.08 0 0 0-12.3 19l33.19 157.8A16 16 0 0 0 169.16 224a16.25 16.25 0 0 0 3.38-.36l46.81-10.06a16.09 16.09 0 0 0 12.3-19.03ZM136 50.15v-.09l46.8-10l3.33 15.87L139.33 66Zm10 47.38l-3.35-15.9l46.82-10.06l3.34 15.9Zm70 100.41l-46.8 10l-3.33-15.87l46.8-10.07l3.33 15.85v.09ZM104 32H56a16 16 0 0 0-16 16v160a16 16 0 0 0 16 16h48a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16ZM56 48h48v16H56Zm48 160H56v-16h48v16Z"/></svg>
                                                <span>{{ sizeof($course[0]->chapters) }}</span>
                                            </div>
                                            <div class=price>
                                                <span>{{ isset($course[0]->price) ? '$' . $course[0]->price : 'Free'  }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        @foreach($courses as $course)
                            <div class="col-xl-4 col-lg-4 col-md-6">
                                <div class="single-course wow fadeInUp" data-wow-delay=.2s>
                                    <div class=course-img>
                                        <a href={{ route('course', ['id' => $course->id]) }}>
                                            <img src="{{ asset('storage/' . $course->image) }}" alt="" data-pagespeed-url-hash=1975346514 onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                                        </a>
                                    </div>
                                    <div class=course-info>
                                        <h4><a href={{ route('course', ['id' => $course->id]) }}>{{ $course->title }}</a></h4>
                                        <div class=course-meta>
                                            <div class=meta-item>
                                                <i class="lni lni-user"></i>
                                                <span>{{ sizeof($course->students) }}</span>
                                            </div>
                                            <div class=meta-item>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="256" height="256" viewBox="0 0 256 256"><path fill="currentColor" d="m231.65 194.55l-33.19-157.8a16 16 0 0 0-19-12.39l-46.81 10.06a16.08 16.08 0 0 0-12.3 19l33.19 157.8A16 16 0 0 0 169.16 224a16.25 16.25 0 0 0 3.38-.36l46.81-10.06a16.09 16.09 0 0 0 12.3-19.03ZM136 50.15v-.09l46.8-10l3.33 15.87L139.33 66Zm10 47.38l-3.35-15.9l46.82-10.06l3.34 15.9Zm70 100.41l-46.8 10l-3.33-15.87l46.8-10.07l3.33 15.85v.09ZM104 32H56a16 16 0 0 0-16 16v160a16 16 0 0 0 16 16h48a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16ZM56 48h48v16H56Zm48 160H56v-16h48v16Z"/></svg>
                                                <span>{{ sizeof($course->chapters) }}</span>
                                            </div>
                                            <div class=price>
                                                <span>{{ isset($course->price) ? '$' . $course->price : 'Free'  }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>
        <a href="#" class="back-to-top btn-hover"><i class="lni lni-chevron-up"></i></a>
    </x-slot>
</x-app-layout>
