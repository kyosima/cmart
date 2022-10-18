<div class="container">
    @if (Session::has('success'))
        <p class="alert alert-success text-center">{{ Session::get('success') }}</p>
    @endif
    @if (Session::has('error'))
        <p class="alert alert-success text-center">{{ Session::get('error') }}</p>
    @endif
</div>
