@if(session('info') != null)
    <div class="alert alert-info">
        {{ session('info') }}
    </div>
@elseif(session('success') != null)
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
