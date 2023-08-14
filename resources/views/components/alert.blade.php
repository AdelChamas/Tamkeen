@if(session('info') != null)
    <div class="alert alert-info my-2">
        {{ session('info') }}
    </div>
@elseif(session('success') != null)
    <div class="alert alert-success my-2">
        {{ session('success') }}
    </div>
@endif