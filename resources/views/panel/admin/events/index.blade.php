@extends('panel.admin.master')

@section('body')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            @can('event-create')
                                <button type="button" class="btn btn-default float-right" data-toggle="modal"
                                        data-target="#modal-add-form">
                                    Add New Event
                                </button>
                            @endcan
                            <h4>Events</h4>
                        </div>

                        {{--start add form modal--}}
                        <div class="modal fade" id="modal-add-form">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add Event</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="card-body">
                                            <form method="POST" action="{{ route('admin.events.store') }}">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="title">Title <span style="color: red">*</span></label>
                                                    <input type="text" name="title" required class="form-control"
                                                           id="title" placeholder="Enter Event Title"
                                                           value="{{old('title')}}">
                                                    @error('title')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="desc">Description <span
                                                            style="color: red">*</span></label>
                                                    <input type="text" name="desc" required class="form-control"
                                                           id="desc" placeholder="Enter Event Description"
                                                           value="{{old('desc')}}">
                                                    @error('desc')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="start_date">Start Date Time <span
                                                            style="color: red">*</span></label>
                                                    <input type="datetime-local" name="start_date" required
                                                           class="form-control" id="start_date"
                                                           placeholder="Enter Start Date Time"
                                                           value="{{(old('start_date')) ? old('start_date') : now()}}">
                                                    @error('start_date')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="end_date">End Date Time <span
                                                            style="color: red">*</span></label>
                                                    <input type="datetime-local" name="end_date" required
                                                           class="form-control" id="end_date"
                                                           placeholder="Enter Start Date Time"
                                                           value="{{(old('end_date')) ? old('end_date') : now()}}">
                                                    @error('end_date')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="reward_for_register">Reward For Register <span
                                                            style="color: red">*</span></label>
                                                    <input type="number" min="0" name="reward_for_register" required
                                                           class="form-control" id="reward_for_register"
                                                           placeholder="Enter Reward For Register"
                                                           value="{{old('reward_for_register')}}">
                                                    @error('reward_for_register')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="reward_for_file">Reward For File <span
                                                            style="color: red">*</span></label>
                                                    <input type="number" min="0" name="reward_for_file" required
                                                           class="form-control" id="reward_for_file"
                                                           placeholder="Enter Reward For File"
                                                           value="{{old('reward_for_file')}}">
                                                    @error('reward_for_file')
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

                        @can('event-list')
                            @php $i=1 @endphp
                            <div class="card-body p-0">
                                <table class="table table-striped table-responsive-lg">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Reward For Register</th>
                                        <th>Reward For File</th>
                                        <th>Created By</th>
                                        <th>Participants</th>
                                        <th>Files</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($events as $event)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$event->title}}</td>
                                            <td>{{$event->desc}}</td>
                                            <td>{{$event->start_date}}</td>
                                            <td>{{$event->end_date}}</td>
                                            <td>{{number_format($event->reward_for_register)}}</td>
                                            <td>{{number_format($event->reward_for_file)}}</td>
                                            <td>{{!is_null($event->creator) ? $event->creator->name : ''}}</td>
                                            <td>{{number_format($event->users->count())}}</td>
                                            <td>{{number_format($event->files->count())}}</td>

                                            <td>
                                                <div class="btn-group btn-group-sm float-left">
                                                    <a href="{{route('admin.events.edit' , ['event' => $event])}}"
                                                       class="btn btn-info edit-role" title="Edit">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>

                                                    <a href="{{route('admin.events.show' , ['event' => $event])}}"
                                                       class="btn btn-primary edit-role" title="Edit">
                                                        <i class="fas fa-eye"></i>
                                                    </a>

                                                    <form method="POST" class="btn-group btn-group-sm"
                                                          action="{{route('admin.events.destroy' , ['event' => $event])}}">
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
    @if(session('success'))
        <script type="text/javascript">
            $(window).on('load', function () {
                $(document).Toasts('create', {
                    class: 'bg-success',
                    title: '{{__('Result')}}',
                    // subtitle: 'Request successfully created',
                    body: '{{session('success')}}'
                })
            });
        </script>
    @endif
@endsection
