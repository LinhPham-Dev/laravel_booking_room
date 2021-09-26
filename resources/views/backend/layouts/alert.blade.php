@if (Session::has('success'))
<div class="alert alert-success alert-dismissible fade show py-3" role="alert">
    <strong>{{ Session::get('success') }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<div class="alert alert-primary" role="alert">
  A simple primary alert—check it out!
</div>

@elseif (Session::has('error'))
<div class="alert alert-danger alert-dismissible fade show py-3" role="alert">
    <strong>{{ Session::get('error') }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
