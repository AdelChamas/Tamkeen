<x-user-layout>
    <x-slot name="content">
        <main class="instructor-main">
            @include('components.instructor-sidebar')
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('instructorDashboard') }}">{{ __('instructor.dashboard') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('general.chapters') }}</li>
                    </ol>
                </nav>
                <button class="sidebar-toggle btn btn-primary d-block d-md-none" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-dasharray="24" stroke-dashoffset="24" stroke-linecap="round" stroke-width="2"><path d="M5 5H19"><animate fill="freeze" attributeName="stroke-dashoffset" dur="0.2s" values="24;0"/></path><path d="M5 12H19"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.2s" dur="0.2s" values="24;0"/></path><path d="M5 19H19"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.4s" dur="0.2s" values="24;0"/></path></g></svg>
                </button>
                @vite('resources/js/responsive_sidebar.js')
                <h2>{{ __('general.chapters') }}</h2>
                <x-alert></x-alert>
                <div class="row">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">{{ __('instructor.title') }}</th>
                                <th scope="col">{{ __('instructor.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php($chapters_ids = [])
                                @foreach($chapters as $chapter)
                                    @php(array_push($chapters_ids, $chapter->id))
                                    <tr>
                                        <td>{{ $chapter->title }}</td>
                                        <td>
                                            <a href="{{ route('updateChapter', ['id' => $chapter->id]) }}" class="btn btn-primary my-1">{{ __('instructor.edit') }}</a>
                                            <form method="post" id="delete-chapter-{{$chapter->id}}" action="{{ route('deleteChapter', ['id' => $chapter->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button id="delete-{{$chapter->id}}" class="btn btn-danger">{{ __('instructor.delete') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                <script>
                                    let chapters = '{{ implode(',', $chapters_ids)}}'
                                    chapters.split(',').forEach(chapter_id => {
                                        document.getElementById('delete-' + chapter_id).addEventListener('click', function(e){
                                            e.preventDefault();
                                            if(confirm("Are you sure you want to delete the chapter?")){
                                                document.forms['delete-chapter-' + chapter_id].submit()
                                            }
                                        })
                                    })
                                </script>
                            </tbody>
                        </table>
                </div>
            </div>
        </main>
    </x-slot>
</x-user-layout>
