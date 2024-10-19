@extends('layouts.admin')

@section('content')

<section class="section">
    <div class="row">
      <div class="col-lg-12">

         <!-- Import CSV -->
        <div class="card mb-4">
            <div class="card-header mb-2">
                <h5>Import Events from CSV</h5>
            </div>
            <div class="card-body">
                <!-- Download Demo CSV Button -->
                <a href="{{ route('events.demo-csv') }}" class="btn btn-secondary mb-3">Download Demo CSV</a>

                <!-- CSV Import Form -->
                <form action="{{ route('events.import-csv') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="csv_file" class="form-label">Choose CSV file to import events</label>
                        <input type="file" class="form-control" id="csv_file" name="csv_file" required>
                    </div>
                    <button type="submit" class="btn btn-success">Import CSV</button>
                </form>
            </div>
        </div>

        <div class="card">
          <div class="card-body">
            <div class="hgt">
            <h5 class="card-title">Event List</h5>
              
              <div class="bt mt-2"><a href="{{ route('events.create') }}" class="btn btn-sm btn-primary">Create</a></div>
            </div>

            <!-- Event Table -->
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>Reminder ID</th>
                        <th>Title</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                    <tr>
                        <td>{{ $event->reminder_id }}</td>
                        <td>{{ $event->title }}</td>
                        <td>{{ $event->start_time }}</td>
                        <td>{{ $event->end_time }}</td>
                        <td>{{ ucfirst($event->status) }}</td>
                        <td>
                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-info"  title="Show"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('events.edit', $event) }}" class="btn btn-warning"  title="Edit"><i class="bi bi-pencil-square"></i></a>
                            <form action="{{ route('events.destroy', $event) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"  title="Delete" onclick="return confirm('Are you sure you want to delete this item?');"><i class="bi bi-trash"></i></button>
                            </form>

                            <a href="{{ route('events.send-reminder', $event->id) }}" class="btn btn-info" title="Send Reminder"><i class="bi bi-alarm"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

          </div>
        </div>

      </div>
    </div>
</section>
@endsection