@extends('panel.admin.master')

@section('body')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edite Event</h4>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.events.update', ['event' => $event]) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="title">Title <span style="color: red">*</span></label>
                                    <input type="text" name="title" required class="form-control"
                                           @if($event->name == \App\Models\Admin::SUPER_ADMIN_ROLE) disabled @endif
                                           id="title" placeholder="Enter Event Title" value="{{$event->title}}">
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
                                           value="{{$event->desc}}">
                                    @error('desc')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="start_date">Start Date Time <span style="color: red">*</span></label>
                                    <input type="datetime-local" name="start_date" required
                                           class="form-control" id="start_date" placeholder="Enter Start Date Time"
                                           value="{{$event->start_date}}">
                                    @error('start_date')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="end_date">End Date Time <span style="color: red">*</span></label>
                                    <input type="datetime-local" name="end_date" required
                                           class="form-control" id="end_date" placeholder="Enter Start Date Time"
                                           value="{{$event->end_date}}">
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
                                           value="{{$event->reward_for_register}}">
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
                                           value="{{$event->reward_for_file}}">
                                    @error('reward_for_file')
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
