@extends('layouts.admin')

@section('content')
<div class="col-lg-12">

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Update Role</h5>

        <!-- Vertical Form -->
        <form action="{{ route('roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')
    
            <div class="form-group">
                <label for="name">Role Name</label>
                <input type="text" name="name" value="{{ $role->name }}" class="form-control" required>
            </div>
    
            <div class="form-group">
                <label for="permissions">Assign Permissions</label>
                <div class="row">
                    @foreach($permissions as $permission)
                        <div class="col-md-3">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                            <label>{{ $permission->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
    
            <button type="submit" class="btn btn-primary">Update Role</button>
            <a href="{{ route('roles.index') }}" class="btn btn-warning">Back</a>
        </form>
        

      </div>
    </div>
</div>

@endsection