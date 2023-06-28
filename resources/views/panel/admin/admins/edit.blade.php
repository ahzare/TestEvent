@extends('panel.admin.master')
@section('css')
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #007bff !important;
            border-color: #006fe6 !important;
            color: #fff !important;
            padding: 0 10px !important;
            margin-top: 0.31rem !important;
        }
    </style>
@endsection
@section('body')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edite Admin</h4>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.admins.update', ['admin' => $admin]) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">Name <span style="color: red">*</span></label>
                                    <input type="text" name="name" required class="form-control" disabled
                                           id="name" placeholder="Enter Role Name" value="{{$admin->name}}">
                                    @error('name')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email <span style="color: red">*</span></label>
                                    <input type="text" name="email" required class="form-control" disabled
                                           id="email" placeholder="Enter Role Email" value="{{$admin->email}}">
                                    @error('email')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="roles">Roles</label>
                                    <select multiple="multiple" class="select2 w-100" name="roles[]" id="roles"
                                            data-placeholder="{{__('Select a Role')}}">
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}"
                                                {{in_array($role->id, $adminRoles) ? 'selected' : '' }}>{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('roles')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <button onclick="" class="btn btn-success" type="submit">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- Select2 -->
    <script src="{{asset('panel/plugins/select2/js/select2.full.min.js')}}"></script>

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })

    </script>

@endsection
