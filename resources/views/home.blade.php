<x-app-layout>
    <x-slot name="content">
        <x-alert></x-alert>

        <!--====== PRELOADER PART START ======-->
        <div class="preloader">
            <div class="loader">
                <div class="ytp-spinner">
                    <div class="ytp-spinner-container">
                        <div class="ytp-spinner-rotator">
                            <div class="ytp-spinner-left">
                                <div class="ytp-spinner-circle"></div>
                            </div>
                            <div class="ytp-spinner-right">
                                <div class="ytp-spinner-circle"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--====== PRELOADER PART ENDS ======-->


        <!--====== HERO PART START ======-->
        <section id="home" class="hero-area bg_cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-5 offset-xl-7 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                        <div class="hero-content">
                            <h2 class="mb-30 wow fadeInUp" data-wow-delay=".2s">{{ __('_home.company') }}</h2>
                            <p class="wow fadeInUp" data-wow-delay=".4s">
                                {{ __('_home.slogan') }}
                            </p>
                            <div class="hero-btns">
                                <a href="#courses" class="main-btn wow fadeInUp" data-wow-delay=".6s">{{ __('navbar.courses') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero-left">
                <img src="{{ asset('storage/assets/hero-img.png') }}" alt="">
                <img src="{{ asset('storage/assets/dot-shape.svg') }}" alt="" class="shape">
            </div>
        </section>
        <!--====== HERO PART END ======-->

        <!--====== SKILL PART START ======-->
        <section id="skill" class="skill-area pt-170">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-7 col-md-10 mx-auto">
                        <div class="section-title text-center">
                            <h2 class="mb-15 wow fadeInUp" data-wow-delay=".2s">{{ __('_home.skills_title') }}</h2>
                            <p class="wow fadeInUp" data-wow-delay=".4s">{{ __('_home.skills_desc') }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="single-skill wow fadeInUp" data-wow-delay=".2s">
                            <div class="skill-icon">
                                <i class="lni lni-pencil-alt"></i>
                            </div>
                            <div class="skill-content">
                                <h4>{{ __('_home.learn')  }}</h4>
                                <p>{{ __('_home.learn_desc') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="single-skill wow fadeInUp" data-wow-delay=".4s">
                            <div class="skill-icon">
                                <i class="lni lni-grid-alt"></i>
                            </div>
                            <div class="skill-content">
                                <h4>{{ __('_home.collection') }}</h4>
                                <p>{{ __('_home.collection_desc') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="single-skill wow fadeInUp" data-wow-delay=".6s">
                            <div class="skill-icon">
                                <i class="lni lni-certificate"></i>
                            </div>
                            <div class="skill-content">
                                <h4>{{ __('_home.instructors') }}</h4>
                                <p>{{ __('_home.instructors_desc') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--====== SKILL PART ENDS ======-->

        <!--====== COURSES PART START ======-->
        <section id="courses" class="course-area pt-140 pb-170">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-7 col-md-10 mx-auto">
                        <div class="section-title text-center mb-50">
                            <h2 class="mb-15 wow fadeInUp" data-wow-delay=".2s">{{ __('_home.popular_courses') }}</h2>
                            <p class="wow fadeInUp" data-wow-delay=".4s">{{ __('_home.popular_courses_desc') }}</p>
                        </div>
                    </div>
                </div>
                <div class="row mb-30">
                    @foreach($courses as $course)
                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <div class="single-course wow fadeInUp" data-wow-delay=".2s">
                                <div class="course-img">
                                    <a href="{{route('course', ['id' => $course->id])}}">
                                        <img src="{{ asset('storage/' . $course->image) }}" alt="">
                                    </a>
                                </div>
                                <div class="course-info">
                                    <h4><a href="{{route('course', ['id' => $course->id])}}">{{ $course->title }}</a></h4>
                                    <div class="course-meta">
                                        <div class="meta-item">
                                            <i class="lni lni-user"></i>
                                            <span>{{ sizeof($course->students) }}</span>
                                        </div>
                                        <div class="meta-item">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="256" height="256" viewBox="0 0 256 256"><path fill="currentColor" d="m231.65 194.55l-33.19-157.8a16 16 0 0 0-19-12.39l-46.81 10.06a16.08 16.08 0 0 0-12.3 19l33.19 157.8A16 16 0 0 0 169.16 224a16.25 16.25 0 0 0 3.38-.36l46.81-10.06a16.09 16.09 0 0 0 12.3-19.03ZM136 50.15v-.09l46.8-10l3.33 15.87L139.33 66Zm10 47.38l-3.35-15.9l46.82-10.06l3.34 15.9Zm70 100.41l-46.8 10l-3.33-15.87l46.8-10.07l3.33 15.85v.09ZM104 32H56a16 16 0 0 0-16 16v160a16 16 0 0 0 16 16h48a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16ZM56 48h48v16H56Zm48 160H56v-16h48v16Z"/></svg>
                                            <span>{{ sizeof($course->chapters) }}</span>
                                        </div>
                                        <div class="meta-item">
                                            <span>{{ isset($course->price) ? '$' . $course->price : 'Free' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="view-all-btn text-center">
                            <a href="{{ route('courses') }}" class="main-btn">{{ __('_home.view_courses') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--====== COURSES PART ENDS ======-->

        <!--====== CATEGORIES PART START ======-->
        <section class="categories-area pt-170 pb-170">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10 mx-auto">
                        <div class="section-title text-center">
                            <h2 class="wow fadeInUp" data-wow-delay=".2s">{{ __('_home.top_categories') }}</h2>
                            <p class="wow fadeInUp" data-wow-delay=".4s">{{ __('_home.top_categories_desc') }}</p>
                        </div>
                    </div>
                </div>
                    <div class="row mb-30">
                        @foreach($categories as $category)
                            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                                <a href="{{ route('courseCategory', ['category_id' => $category->id]) }}" class="d-block category-wrapper">
                                    <div class="single-category">
                                        {!! App\Custom\Icons::getIcon(strtolower($category->category)) !!}
                                        <h3>{{ $category->category }}</h3>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
{{--                <div class="row">--}}
{{--                    <div class="col-xl-12">--}}
{{--                        <div class="view-all-btn text-center">--}}
{{--                            <a href="{{ route('courses') }}" class="main-btn">{{ __('_home.view_categories') }}</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </section>
        <!--====== CATEGORIES PART ENDS ======-->


        <!--====== BACK TOP TOP PART START ======-->
        <a href="#" class="back-to-top btn-hover"><i class="lni lni-chevron-up"></i></a>
        <!--====== BACK TOP TOP PART ENDS ======-->


    </x-slot>
</x-app-layout>
