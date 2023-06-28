@extends('panel.admin.master')

@section('body')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Admins</h4>
                        </div>

                        @php $i=1 @endphp

                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($admins as $admin)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$admin->name}}</td>
                                        <td>{{$admin->email}}</td>
                                        <td>
                                            @if(count($admin->getRoleNames()) > 0)
                                                @foreach($admin->getRoleNames() as $adminRole)
                                                    <span class="badge rounded-pill bg-green">{{ $adminRole }}</span>
                                                @endforeach
                                            @else No Role @endif
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm float-left">
                                                <a href="{{route('admin.admins.edit' , ['admin' => $admin])}}"
                                                   class="btn btn-info edit-role" title="Edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>

                                                <form method="POST" class="btn-group btn-group-sm"
                                                      action="{{route('admin.admins.destroy' , ['admin' => $admin])}}">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger edit-role"
                                                            onclick="return confirm('Will be deleted. Sure?')"
                                                            type="submit" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
