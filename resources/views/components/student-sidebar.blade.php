<style>
    #sidebar{
        height: 500px;
        box-shadow: 1px 7px 3px 0 rgba(0,0,0,0.75);
        color: var(--fifth) !important;
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

    .visible{
        display: block !important;
        width: 100% !important;
    }

    @media (max-width: 576px) {
        #sidebar {
            display: none;
        }
        .sidebar-toggle {
            display: block;
        }
    }
    .btn-toggle:hover, .btn-toggle:focus {
        color: rgba(0, 0, 0, .85);
        background-color: #d2f4ea;
    }
    .btn-toggle-nav a {
        padding: 0.1875rem 0.5rem;
        margin-top: 0.125rem;
        margin-left: 1.25rem;
    }
    .btn-toggle-nav a:hover {
        background-color: var(--primary);
    }

    #sidebar .links{
        display: flex;
        flex-direction: column;
        justify-content: space-around;
    }

    #sidebar .links a{
        padding: 10px;
        margin: 10px 0;
    }

    #sidebar .current{
        background: var(--fifth);
    }

</style>

<div id='sidebar' class="flex-shrink-0 p-3" style="width: 280px;">
    <a href="{{ route('profile.edit') }}" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
        <span class="fs-5 fw-semibold">{{ auth()->user()->full_name }}</span>
    </a>
    <ul class="links list-unstyled ps-0">
        <a href="{{ route('forYou') }}" class="btn btn-primary">{{ __('student.for_you') }}</a>
        <a href="{{ route('editPreferences') }}" class="btn btn-primary">{{ __('student.preferences') }}</a>
        @if(auth()->user()->role == 2)
            <a href="{{ route('instructorDashboard') }}" class="btn btn-primary">{{ __('student.to_instructor') }}</a>
        @endif
        <form method="post" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-primary">{{ __('general.logout') }}</button>
        </form>
    </ul>
</div>
