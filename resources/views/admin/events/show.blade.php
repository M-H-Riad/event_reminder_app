@extends('layouts.admin')

@section('content')
<div class="container">

    <div class="card mb-4">
        <div class="card-header mb-2">
            <h1>Event Details</h1>
        </div>
        <div class="card-body">
            
            <div class="mb-3">
                <strong>Event Title:</strong>
                <p>{{ $event->title }}</p>
            </div>

            <div class="mb-3">
                <strong>Reminder ID:</strong>
                <p>{{ $event->reminder_id }}</p>
            </div>

            <div class="mb-3">
                <strong>Start Time:</strong>
                <p>{{ $event->start_time }}</p>
            </div>

            <div class="mb-3">
                <strong>End Time:</strong>
                <p>{{ $event->end_time }}</p>
            </div>

            <div class="mb-3">
                <strong>Status:</strong>
                <p>{{ ucfirst($event->status) }}</p>
            </div>

            <div class="mb-3">
                <strong>Description:</strong>
                <p>{{ $event->description }}</p>
            </div>

            <div class="mb-3">
                <strong>Members:</strong>
                @if($event->members)
                    <ul>
                        @foreach(json_decode($event->members) as $member)
                            <li>{{ $member }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>No members assigned.</p>
                @endif
            </div>
        </div>
    </div>
    <div>
        <a href="{{ route('events.index') }}" class="btn btn-primary">Back to Event List</a>
    </div>
</div>

@endsection