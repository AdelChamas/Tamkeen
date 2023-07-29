<x-user-layout>
    <x-slot name="content">
        <main class="instructor-main">
            @include('components.instructor-sidebar')
            <button class="sidebar-toggle btn btn-primary d-block d-md-none" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-dasharray="24" stroke-dashoffset="24" stroke-linecap="round" stroke-width="2"><path d="M5 5H19"><animate fill="freeze" attributeName="stroke-dashoffset" dur="0.2s" values="24;0"/></path><path d="M5 12H19"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.2s" dur="0.2s" values="24;0"/></path><path d="M5 19H19"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.4s" dur="0.2s" values="24;0"/></path></g></svg>
            </button>
            @vite('resources/js/responsive_sidebar.js')
            <div class="container">
                @if(isset($chapter))
                    <h2>New Discussion for <strong>{{ $chapter->title }}</strong></h2>
                    <x-alert></x-alert>
                    <form method="post" action="{{ route('newDiscussion', ['chapter_id' => $chapter->id]) }}">
                @else
                    <h2>New Discussion</h2>
                    <x-alert></x-alert>
                    <form method="post" action="{{ route('newDiscussionNoChapter') }}">
                @endif
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">{{ __('forms.title') }}</label>
                        <input type="text" id="title" class="form-control" name="title">
                    </div>
                    <div class="mb-3">
                        <label for="question" class="form-label">{{ __('forms.question') }}</label>
                        <textarea type="text" id="question" name="question" class="form-control"></textarea>
                    </div>
                    @isset($chapters)
                        <div class="mb-3">
                            <label for="chapter" class="form-label">{{ __('general.chapter') }}</label>
                            <select class="form-select" aria-label="Default select example" name="chapter" id="chapter">
                                <option selected disabled>--- {{ __('general.chapter') }} ---</option>
                                @foreach($chapters as $chapter)
                                    <option value="{{ $chapter->id }}">{{ $chapter->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endisset
                    <button type="submit" class="btn btn-primary">{{ __('forms.add') }}</button>
                </form>
            </div>
        </main>
    </x-slot>
</x-user-layout>
