@extends('panel.admin.master')

@section('body')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            @can('role-create')
                                <button type="button" class="btn btn-default float-right" data-toggle="modal"
                                        data-target="#modal-add-form">
                                    Add New Role
                                </button>
                            @endcan
                            <h4>Roles</h4>
                        </div>

                        {{--start add form modal--}}
                        <div class="modal fade" id="modal-add-form">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add Role</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="card-body">
                                            <form method="POST" action="{{ route('admin.roles.store') }}">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="name">Name <span style="color: red">*</span></label>
                                                    <input type="text" name="name" required class="form-control"
                                                           id="name" placeholder="Enter Role Name"
                                                           value="{{old('name')}}">
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
                                                                   class="" value="{{$permission->id}}"
                                                                   id="permissions">
                                                            {{$permission->name}}</label>

                                                    @endforeach
                                                    @error('permissions')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                                <button class="btn btn-success" type="submit">Save</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--end add form modal--}}

                        @can('role-list')
                            @php $i=1 @endphp
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Name</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($roles as $role)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$role->name}}</td>
                                            <td>
                                                <div class="btn-group btn-group-sm float-left">
                                                    <a href="{{route('admin.roles.edit' , ['role' => $role])}}"
                                                       class="btn btn-info edit-role" title="Edit">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>

                                                    @if($role->name != \App\Models\Admin::SUPER_ADMIN_ROLE)
                                                        <form method="POST" class="btn-group btn-group-sm"
                                                              action="{{route('admin.roles.destroy' , ['role' => $role])}}">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="btn btn-danger edit-role"
                                                                    onclick="return confirm('Will be deleted. Sure?')"
                                                                    type="submit" title="Delete">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @if($errors->any())
        <script type="text/javascript">
            $(window).on('load', function () {
                $('#modal-add-form').modal('show');
            });
        </script>
    @endif
@endsection
