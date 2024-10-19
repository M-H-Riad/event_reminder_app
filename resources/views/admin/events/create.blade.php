@extends('layouts.admin')

@section('content')
<div class="col-lg-12">

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">{{ isset($event) ? 'Edit Event' : 'Create Event' }}</h1></h5>
        <form action="{{ isset($event) ? route('events.update', $event) : route('events.store') }}" method="POST" id="event-form">
            @csrf
            @if(isset($event))
                @method('PUT')
            @endif
    
            <div class="mb-3">
                <label for="title" class="form-label">Event Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $event->title ?? '') }}" required>
            </div>
    
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description">{{ old('description', $event->description ?? '') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="start_time" class="form-label">Start Time</label>
                <input type="datetime-local" class="form-control" id="start_time" name="start_time" value="{{ old('start_time', isset($event) ? $event->start_time : '') }}">
            </div>
    
            <div class="mb-3">
                <label for="end_time" class="form-label">End Time</label>
                <input type="datetime-local" class="form-control" id="end_time" name="end_time" value="{{ old('end_time', isset($event) ? $event->end_time : '') }}">
            </div>

            @if(isset($event))
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="upcoming" {{ old('status', $event->status) == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                        <option value="completed" {{ old('status', $event->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
            @endif
    
            <div class="mb-3">
                <label for="members" class="form-label">Members (Emails, comma-separated)</label>
                <textarea class="form-control" id="members" name="members" required placeholder="Enter emails, separated by commas (e.g. email1@example.com, email2@example.com)">{{ old('members', isset($event) ? implode(',', json_decode($event->members)) : '') }}</textarea>
            </div>            
    
            <a href="{{ route('events.index') }}" class="btn btn-warning">Back</a>
            <button type="submit" class="btn btn-success">{{ isset($event) ? 'Update Event' : 'Create Event' }}</button>
        </form>
        

      </div>
    </div>
</div>


@endsection