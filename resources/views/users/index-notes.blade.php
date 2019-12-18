<td colspan="4">
  <div class="row">
    @can('viewAny', $notes->first())
      @foreach ($notes as $note)
        <div class="col-md-4 col-sm-6 mt-2">
          <div class="card card-body small mb-2">
            <div>{{ $note->created_at->diffForHumans() }}</div>
            <div>{{ $note->content }}</div>
          </div>
        </div>
      @endforeach
    @else
      <div class="col-md-12 alert alert-warning my-2">
        You have not permission to view any notes.
      </div>
    @endcan
  </div>
</td>
