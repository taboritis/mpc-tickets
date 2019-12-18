@extends('layouts.app')

@section('content')
  <div class="card card-body">
    <h3>{{ $ticket->title }} <small>({{ $ticket->id }})</small></h3>
    <div class="row">
      <div class="col-md-8">
        <div class="text-secondary">
          {{ $ticket->content }}
        </div>
        <div class="d-flex justify-content-around mt-4">
          <div class="mr-auto">
            <i class="fa fa-user text-primary mr-2"></i>
            Requested by: {{ $ticket->author->fullname() }}
          </div>
          <div>
            <i class="fa fa-map-pin text-danger mr-2"></i>
            Assigned To: {{ $ticket->assignedTo->fullname() }}
          </div>
        </div>
      </div>
      <div class="col-md-4 text-right">
        <div>Created at: {{ $ticket->created_at->diffForHumans() }}</div>
        <div>Updated at: {{ $ticket->updated_at->diffForHumans() }}</div>
        @if($ticket->closed_at != null)
          <div>Closed at: {{ Carbon\Carbon::parse($ticket->closed_at)->diffForHumans() }}</div>
        @endif
      </div>
    </div>
  </div>
@stop