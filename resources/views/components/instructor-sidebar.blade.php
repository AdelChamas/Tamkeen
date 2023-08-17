<style>
    @if(app()->getLocale() == 'ar')
        .btn-toggle::before{
        transform: rotate(180deg);
        }
    @endif
        #sidebar{
            height: 100vh;
            box-shadow: 1px 7px 3px 0 rgba(0,0,0,0.75);
        }
        .visible{
            display: block !important;
            width: 100% !important;
        }
        @media (max-width: 768px) {
            #sidebar {
                display: none;
            }
            .sidebar-toggle {
                display: block;
            }
        }

        .btn-toggle::before{
            width: 1.25em;
            line-height: 0;
            content: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='rgba%280,0,0,.5%29' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 14l6-6-6-6'/%3e%3c/svg%3e");
            transition: transform .35s ease;
            transform-origin: 0.5em 50%;
        }
        .btn-toggle[aria-expanded="true"]::before {
            transform: rotate(90deg);
        }
        .btn-toggle:hover, .btn-toggle:focus {
            color: rgba(0, 0, 0, .85);
            background-color: var(--tertiary);
        }
        .btn-toggle-nav a {
            padding: 0.1875rem 0.5rem;
            margin-top: 0.125rem;
            margin: 0 2rem;
        }
        .btn-toggle-nav a:hover {
            background-color: var(--tertiary);
        }
</style>

<div id='sidebar' class="flex-shrink-0 p-3" style="width: 280px;">
    <a href="{{ route('instructorDashboard') }}" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
        <span class="fs-5 fw-semibold">{{ auth()->user()->full_name }}</span>
    </a>
    <ul class="list-unstyled ps-0">
        <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="false">
                {{ __('general.courses') }}
            </button>
            <div class="collapse" id="home-collapse" style="">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="{{ route('instructorDashboard') }}" class="link-dark d-inline-flex text-decoration-none rounded">{{ __('instructor.all_courses') }}</a></li>
                    <li><a href="{{ route('newChapterNoCourse') }}" class="link-dark d-inline-flex text-decoration-none rounded">{{ __('instructor.new_chapter') }}</a></li>
                    <li><a href="{{ route('newLessonNoChapter') }}" class="link-dark d-inline-flex text-decoration-none rounded">{{ __('instructor.new_lesson') }}</a></li>
                    <li><a href="{{ route('newDiscussionNoChapter') }}" class="link-dark d-inline-flex text-decoration-none rounded">{{ __('instructor.new_discussion') }}</a></li>
                    <li><a href="{{ route('newNoteNoChapter') }}" class="link-dark d-inline-flex text-decoration-none rounded">{{ __('instructor.new_note') }}</a></li>
                </ul>
            </div>
        </li>

        <li class="border-top my-3"></li>
        <li class="mb-1">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
                {{ __('general.account') }}
            </button>
            <div class="collapse" id="account-collapse" style="">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="{{ route('profile.edit') }}" class="link-dark d-inline-flex text-decoration-none rounded">{{ __('instructor.profile') }}</a></li>
                    <li><a href="{{ route('studentDashboard') }}" class="link-dark d-inline-flex text-decoration-none rounded">{{ __('instructor.switch_to_student') }}</a></li>
                    <li>
                        <form method="post" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-primary my-2">{{ __('general.logout') }}</button>
                        </form>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</div>
