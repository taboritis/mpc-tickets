@if ($errors->any())
  <div class="container mt-3">
    @foreach ($errors->all() as $error)
      <div class="alert alert-danger">
        {{ $error }}
      </div>
    @endforeach
  </div>
@endif
