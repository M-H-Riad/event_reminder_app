@extends('layouts.admin')

@section('content')
<div class="col-lg-12">

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Create Role</h5>

        <!-- Vertical Form -->
        <form action="{{ route('roles.store') }}" method="POST">
            @csrf
    
            <!-- Role Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Role Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Enter role name" value="{{ old('name') }}" required>
            </div>
    
            <!-- Permissions -->
            <div class="mb-3">
                <label class="form-label">Assign Permissions</label>
                <div class="row">
                    @foreach($permissions as $permission)
                        <div class="col-md-3">
                            <div class="form-check">
                                <input 
                                    class="form-check-input" 
                                    type="checkbox" 
                                    name="permissions[]" 
                                    value="{{ $permission->name }}" 
                                    id="permission_{{ $permission->id }}"
                                    {{ (is_array(old('permissions')) && in_array($permission->id, old('permissions'))) ? 'checked' : '' }}
                                >
                                <label class="form-check-label" for="permission_{{ $permission->id }}">
                                    {{ ucwords(str_replace('-', ' ', $permission->name)) }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
    
            <!-- Submit Button -->
            <a href="{{ route('roles.index') }}" class="btn btn-warning">Back</a>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
        

      </div>
    </div>
</div>


@endsection