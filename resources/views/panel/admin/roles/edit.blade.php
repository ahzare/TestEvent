@extends('panel.admin.master')

@section('body')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edite Role</h4>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.roles.update', ['role' => $role]) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">Name <span style="color: red">*</span></label>
                                    <input type="text" name="name" required class="form-control"
                                          @if($role->name == \App\Models\Admin::SUPER_ADMIN_ROLE) disabled @endif
                                           id="name" placeholder="Enter Role Name" value="{{$role->name}}">
                                    @error('name')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group" style="display: grid;">
                                    <label for="permissions">Permissions</label>
                                    @foreach($permissions as $permission)
                                        <label>
                                            <input type="checkbox" name="permissions[]"
                                                   @if($role->name == \App\Models\Admin::SUPER_ADMIN_ROLE) disabled @endif
                                                   class="" value="{{$permission->id}}" id="permissions"
                                                {{in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                                            {{$permission->name}}</label>
                                    @endforeach
                                    @error('permissions')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <button onclick="" class="btn btn-success" type="submit">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
