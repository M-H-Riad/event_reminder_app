@extends('layouts.admin')

@section('content')

<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <div class="hgt">
            <h5 class="card-title">Role List</h5>
              
              <div class="bt mt-2"><a href="{{ route('roles.create') }}" class="btn btn-sm btn-primary">Create</a></div>
            </div>

            <!-- Roles Table -->
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Role Name</th>
                        <th>Permissions</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($roles as $role)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ ucwords(str_replace('-', ' ', $role->name)) }}</td>
                            <td>
                                @foreach($role->permissions as $permission)
                                    <span class="badge bg-secondary">{{ $permission->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @if ($role->name != "super-admin")
                                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>
                                    
                                    <!-- Delete Button with Confirmation -->
                                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this role?');">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No roles found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

          </div>
        </div>

      </div>
    </div>
</section>
@endsection