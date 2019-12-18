@extends('layouts.app')

@section('content')
  <div class="card card-body">
    <div class="d-flex">
      <h4>List of Users</h4>
    </div>
    <table class="table table-hover table-sm">
      <tr>
        <th width="15%">Name</th>
        <th width="15%">Surname</th>
        <th>Email</th>
        <th width="100px"></th>
      </tr>
      @foreach($users as $user)
        <tr data-toggle="collapse" data-target="#collapsedNotes{{ $user->id  }}">
          <td>{{ $user->name }}</td>
          <td>{{ $user->surname }}</td>
          <td>{{ $user->email }}</td>
          <td class="text-right">
            <div class="d-flex">
              <div class="text-center mr-auto">
                @if ($user->notes->count())
                  <i class="fa fa-sticky-note-o text-danger mr-1"></i>{{ $user->notes->count() }}
                @endif
              </div>
              <div class="text-center ml-2">
                <i class="fa fa-check-square-o text-primary ml-1"></i> {{ $user->tickets_number }}
              </div>
            </div>
          </td>
        </tr>
        <tr class="collapse" id="collapsedNotes{{ $user->id }}">
          @if ($user->notes->count())
            @include('users.index-notes', [ 'notes' => $user->notes ])
          @endif
        </tr>
      @endforeach
    </table>
    <div class="d-flex justify-content-center">
      {{ $users->links() }}
    </div>
  </div>
@stop