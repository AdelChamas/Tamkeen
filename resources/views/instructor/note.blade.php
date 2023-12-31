<x-user-layout>
    <x-slot name="content">
        <main class="instructor-main">
            @include('components.instructor-sidebar')
            <button class="sidebar-toggle btn btn-primary d-block d-md-none" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-dasharray="24" stroke-dashoffset="24" stroke-linecap="round" stroke-width="2"><path d="M5 5H19"><animate fill="freeze" attributeName="stroke-dashoffset" dur="0.2s" values="24;0"/></path><path d="M5 12H19"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.2s" dur="0.2s" values="24;0"/></path><path d="M5 19H19"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.4s" dur="0.2s" values="24;0"/></path></g></svg>
            </button>
            @vite('resources/js/responsive_sidebar.js')
            <div class="container">
                <h2>Edit {{ $note->title }}</h2>
                <x-alert></x-alert>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('instructorDashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('updateChapter', ['id' => App\Models\Chapter::where('note_id', $note->id)->get('id')[0]->id]) }}">Chapter</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $note->title }}</li>
                    </ol>
                </nav>
                <form method="post" action="{{ route("updateNote", ['id' => $note->id]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label" required>{{ __('forms.title') }}</label>
                        <input id="title" type="text" class="form-control" name="title" value="{{ $note->title }}">
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>
                    <div class="mb-3">
                        <label for="about" class="form-label">{{ __('general.note') }}</label>
                        <script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-webcomponent@2/dist/tinymce-webcomponent.min.js"></script>
                        <tinymce-editor
                            menubar="false"
                            api-key="your-tiny-cloud-api-key"
                            plugins="advlist lists"
                            toolbar="undo redo | blocks | bold italic backcolor |
                            alignleft aligncenter alignright alignjustify |
                            bullist numlist outdent indent | removeformat | help"
                            name="note"
                        >{{ $note->note }}</tinymce-editor>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('note')" />
                    <button type="submit" class="btn btn-primary">{{ __('forms.update') }}</button>
                </form>
            </div>
        </main>
    </x-slot>
</x-user-layout>
