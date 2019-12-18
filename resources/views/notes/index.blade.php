@extends('layouts.app')

@section('content')
  <div class="card card-body">
    <h3>List of notes</h3>
    <table class="table table-hover table-bordered table-sm small">
      <tr>
        <th>Author</th>
        <th>Content</th>
        <th>Timestamps</th>
        <th>Refers to</th>
      </tr>
      @foreach ($notes as $note)
        <tr>
          <td>{{ $note->author->fullname() }}</td>
          <td>{{ $note->content }}</td>
          <td width="180px">
            Created at: {{ $note->created_at->diffForHumans() }}<br>
            Updated at: {{ $note->updated_at->diffForHumans() }}</td>
          <td>
            @if ($note->referable_type === 'App\User')
              <i class="fa fa-user text-primary"></i>
              {{ $note->referable->fullname() }}
            @else
              <i class="fa fa-sticky-note-o text-danger"></i>
              <a href="{{ $note->referable->path() }}">
                {{ $note->referable->title }}
              </a>
            @endif
          </td>
        </tr>
      @endforeach
    </table>
    <div>
      {{ $notes->links() }}
    </div>
  </div>
@stop