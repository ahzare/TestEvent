@extends('panel.admin.master')

@section('body')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Event details</h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="row mt-3 ml-1 mr-1">
                                <div class="col-md-3 col-sm-6 col-12">
                                    <div class="info-box">
                                        <div class="info-box-content">
                                            <span class="info-box-text">Title:</span>
                                            <span class="info-box-number">
                                                @if($event->title) {{$event->title}} @else Unknown @endif
                                            </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 col-12">
                                    <div class="info-box">

                                        <div class="info-box-content">
                                            <span class="info-box-text">Description:</span>
                                            <span class="info-box-number">
                                                @if($event->desc) {{$event->desc}} @else Unknown @endif
                                            </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 col-12">
                                    <div class="info-box">

                                        <div class="info-box-content">
                                            <span class="info-box-text">Number of Participants:</span>
                                            <span
                                                class="info-box-number">{{number_format($event->users->count())}}</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 col-12">
                                    <div class="info-box">

                                        <div class="info-box-content">
                                            <span class="info-box-text">Number of Files:</span>
                                            <span
                                                class="info-box-number">{{number_format($event->files->count())}}</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                </div>

                                {{-- <div class="col-md-3 col-sm-6 col-12">
                                     <div class="info-box">

                                         <div class="info-box-content">
                                             <span class="info-box-text">Status:</span>
                                             <span class="info-box-number
                                             @if($event->status == \App\Models\Payment::STATUS_SUCCESS) text-green
                                             @elseif($event->status == \App\Models\Payment::STATUS_FAILED) text-red
                                             @endif">{{$event->status}}</span>
                                         </div>
                                         <!-- /.info-box-content -->
                                     </div>
                                 </div>--}}
                            </div>
                        </div>
                    </div>
                    {{--                            @can('event-list')--}}

                    <div class="card">
                        <div class="card-header">
                            <h4>Participants details</h4>
                        </div>
                        <div class="card-body p-0">
                            @php $i=1 @endphp
                            <div class="card-body p-0">
                                <table class="table table-striped table-responsive-lg">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Registered Date</th>
                                        <th>Files</th>
                                        <th>Earned</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($event->users as $user)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->pivot->registered_date}}</td>
                                            <td>{{number_format($user->eventFiles($event)->count())}}</td>
                                            <td>{{number_format($user->pivot->earned)}}</td>

                                            <td>
                                                {{--<div class="btn-group btn-group-sm float-left">
                                                    <a href="{{route('admin.events.edit' , ['event' => $user])}}"
                                                       class="btn btn-info edit-role" title="Edit">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>

                                                    <a href="{{route('admin.events.show' , ['event' => $user])}}"
                                                       class="btn btn-primary edit-role" title="Edit">
                                                        <i class="fas fa-eye"></i>
                                                    </a>

                                                    <form method="POST" class="btn-group btn-group-sm"
                                                          action="{{route('admin.events.destroy' , ['event' => $user])}}">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger edit-role"
                                                                onclick="return confirm('Will be deleted. Sure?')"
                                                                type="submit" title="Delete">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>--}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{--                        @endcan--}}

                    <div class="card">
                        <div class="card-header">
                            <h4>Files details</h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-header p-2">
                                        <ul class="nav nav-pills">
                                            <li class="nav-item"><a class="nav-link active" href="#all"
                                                                    data-toggle="tab">{{__('All')}}</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#images"
                                                                    data-toggle="tab">{{__('Images')}}</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#videos"
                                                                    data-toggle="tab">{{__('Videos')}}</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#audios"
                                                                    data-toggle="tab">{{__('Audios')}}</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#documents"
                                                                    data-toggle="tab">{{__('Documents')}}</a></li>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="active tab-pane" id="all">
                                                <div class="row">
                                                    @foreach($event->files as $file)
                                                        @if($file->type == \App\Utils\FileManager::FILE_TYPE_IMAGE)
                                                            <div class="col-md-12 col-lg-6 col-xl-4">
                                                                <div class="info-box">
                                                                    <a href="{{url($file->url)}}" target="_blank"
                                                                       class="info-box-icon bg-info">
                                                                        <img class="card-img-top"
                                                                             src="{{asset($file->url)}}"
                                                                             alt=""></a>

                                                                    <div class="info-box-content">
                                                                        <span class="info-box-text">{{$file->title}}</span>
                                                                        <span class="info-box-number">{{$file->desc}}</span>
                                                                        <span class="info-box-number">{{$file->user->email}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if($file->type == \App\Utils\FileManager::FILE_TYPE_VIDEO)
                                                            <div class="col-md-12 col-lg-6 col-xl-4">
                                                                <div class="info-box">
                                                                    <a href="{{asset($file->url)}}" target="_blank"
                                                                       class="info-box-icon bg-info">
                                                                        <i class="far fa-play-circle"></i>
                                                                    </a>

                                                                    <div class="info-box-content">
                                                                        <span class="info-box-text">{{$file->title}}</span>
                                                                        <span class="info-box-number">{{$file->desc}}</span>
                                                                        <span class="info-box-number">{{$file->user->email}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if($file->type == \App\Utils\FileManager::FILE_TYPE_AUDIO)
                                                            <div class="col-md-12 col-lg-6 col-xl-4">
                                                                <audio controls>
                                                                    <source src="{{asset($file->url)}}"
                                                                            type="audio/ogg">
                                                                    <source src="{{asset($file->url)}}"
                                                                            type="audio/mpeg">
                                                                </audio>
                                                            </div>
                                                        @endif
                                                        @if($file->type == \App\Utils\FileManager::FILE_TYPE_DOC)
                                                            <div class="col-md-12 col-lg-6 col-xl-4">
                                                                <div class="info-box">
                                                                    <a href="{{url($file->url)}}"
                                                                       class="info-box-icon bg-info"><i
                                                                            class="fa fa-download"></i></a>

                                                                    <div class="info-box-content">
                                                                        <span class="info-box-text">{{$file->title}}</span>
                                                                        <span class="info-box-number">{{$file->desc}}</span>
                                                                        <span class="info-box-number">{{$file->user->email}}</span>
                                                                    </div>
                                                                    <!-- /.info-box-content -->
                                                                </div>
                                                                <!-- /.info-box -->
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="images">
                                                <div class="row">
                                                    @foreach($event->files as $file)
                                                        @if($file->type == \App\Utils\FileManager::FILE_TYPE_IMAGE)
                                                            <div class="col-md-12 col-lg-6 col-xl-4">
                                                                <div class="info-box">
                                                                    <a href="{{url($file->url)}}" target="_blank"
                                                                       class="info-box-icon bg-info">
                                                                        <img class="card-img-top"
                                                                             src="{{asset($file->url)}}"
                                                                             alt=""></a>

                                                                    <div class="info-box-content">
                                                                        <span class="info-box-text">{{$file->title}}</span>
                                                                        <span class="info-box-number">{{$file->desc}}</span>
                                                                        <span class="info-box-number">{{$file->user->email}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="videos">
                                                <div class="row">
                                                    @foreach($event->files as $file)
                                                        @if($file->type == \App\Utils\FileManager::FILE_TYPE_VIDEO)
                                                            <div class="col-md-12 col-lg-6 col-xl-4">
                                                                <div class="info-box">
                                                                    <a href="{{asset($file->url)}}" target="_blank"
                                                                       class="info-box-icon bg-info">
                                                                        <i class="far fa-play-circle"></i>
                                                                    </a>

                                                                    <div class="info-box-content">
                                                                        <span class="info-box-text">{{$file->title}}</span>
                                                                        <span class="info-box-number">{{$file->desc}}</span>
                                                                        <span class="info-box-number">{{$file->user->email}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="audios">
                                                <div class="row">
                                                    @foreach($event->files as $file)
                                                        @if($file->type == \App\Utils\FileManager::FILE_TYPE_AUDIO)
                                                            <div class="col-md-12 col-lg-6 col-xl-4">
                                                                <audio controls>
                                                                    <source src="{{asset($file->url)}}"
                                                                            type="audio/ogg">
                                                                    <source src="{{asset($file->url)}}"
                                                                            type="audio/mpeg">
                                                                </audio>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="documents">
                                                <div class="row">
                                                    @foreach($event->files as $file)
                                                        @if($file->type == \App\Utils\FileManager::FILE_TYPE_DOC)
                                                            <div class="col-md-12 col-lg-6 col-xl-4">
                                                                <div class="info-box">
                                                                    <a href="{{url($file->url)}}"
                                                                       class="info-box-icon bg-info"><i
                                                                            class="fa fa-download"></i></a>

                                                                    <div class="info-box-content">
                                                                        <span class="info-box-text">{{$file->title}}</span>
                                                                        <span class="info-box-number">{{$file->desc}}</span>
                                                                        <span class="info-box-number">{{$file->user->email}}</span>
                                                                    </div>
                                                                    <!-- /.info-box-content -->
                                                                </div>
                                                                <!-- /.info-box -->
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                            <!-- /.tab-pane -->
                                        </div>
                                        <!-- /.tab-content -->
                                    </div><!-- /.card-body -->
                                    <!-- /.card -->
                                </div>
                                <!-- /.col -->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
@endsection
