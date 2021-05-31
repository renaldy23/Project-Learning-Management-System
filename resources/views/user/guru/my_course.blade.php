@extends('user.layout.app')

@section('content')
    <h4>My Course</h4>
    <div id="underline"></div>
    @if (Session::has("success_create_lesson"))
        <div class="alert alert-success" role="alert">
            <strong>{{ Session::get('success_create_lesson') }}</strong>
        </div>
    @elseif(Session::has("success_update_lesson"))
        <div class="alert alert-success" role="alert">
            <strong>{{ Session::get("success_update_lesson") }}</strong>
        </div>
    @elseif(Session::has("success_delete_lesson"))
        <div class="alert alert-warning" role="alert">
            <strong>{{ Session::get("success_delete_lesson") }}</strong>
        </div>
    @elseif(Session::has("updated_task"))
        <div class="alert alert-success" role="alert">
            <strong>{{ Session::get('updated_task') }}</strong>
        </div>
    @elseif(Session::has("created_task"))
        <div class="alert alert-success" role="alert">
            <strong>{{ Session::get('created_task') }}</strong>
        </div>
    @elseif(Session::has("deleted_task"))
        <div class="alert alert-success" role="alert">
            <strong>{{ Session::get('deleted_task') }}</strong>
        </div>
    @elseif(Session::has("presence_deleted"))
        <div class="alert alert-warning" role="alert">
            <strong>{{ Session::get('presence_deleted') }}</strong>
        </div>
    @elseif(Session::has("quiz.create"))
        <div class="alert alert-success" role="alert">
            <strong>{{ Session::get('quiz.create') }}</strong>
        </div>
    @elseif(Session::has("quiz_update"))
        <div class="alert alert-success" role="alert">
            <strong>{{ Session::get('quiz_update') }}</strong>
        </div>
    @elseif(Session::has("quiz_deleted"))
        <div class="alert alert-warning" role="alert">
            <strong>{{ Session::get('quiz_deleted') }}</strong>
        </div>
    @elseif($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @elseif(Session::has('presence_created'))
        <div class="alert alert-success">
            <strong>{{ Session::get("presence_created") }}</strong>
        </div>
    @endif
    <div class="row flex-column-reverse flex-sm-row">
        <div class="col-sm-8 mt-2 mb-2">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{ $my_course->course_title }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mt-3">
                                <div class="col-sm-4">
                                    <div class="card rounded-lg" style="max-width: 18rem;">
                                        <div class="card-header">Kelas : {{ $my_course->kelas->count() }}</div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card rounded-lg" style="max-width: 18rem;">
                                        <div class="card-header">Lessons : {{ $my_course->lesson->count() }}</div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card rounded-lg" style="max-width: 18rem;">
                                        <div class="card-header">Task : {{ $tasks->count() }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12 mw-100">
                    <div class="container mw-100 bg-white p-3">
                        <ul class="nav nav-pills mb-3 nav-fill" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link 
                                @if(Session::has("updated_task") 
                                || Session::has("created_task") || Session::has("deleted_task") || Session::has("presence_deleted") || Session::has("quiz.create")
                                || Session::has("presence_created") || Session::has("quiz_create") || Session::has("quiz_update")) @else active @endif" 
                                id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" 
                                aria-selected="true">Lesson</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link 
                                @if(Session::has("updated_task") || Session::has("created_task") || Session::has("deleted_task")) active @endif" 
                                id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" 
                                aria-selected="false">Task</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link 
                                @if(Session::has('quiz_create') || Session::has('quiz_update')) active @endif" 
                                id="pills-quiz-tab" data-toggle="pill" href="#pills-quiz" role="tab" aria-controls="pills-quiz" 
                                aria-selected="false">Quiz</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link @if(Session::has('presence_created') || Session::has("presence_deleted")) active @endif" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Presence</a>
                            </li>
                        </ul>
                        <div id="underline"></div>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade 
                                @if(Session::has("updated_task") || Session::has("created_task") 
                                || Session::has("deleted_task") || Session::has('presence_deleted') 
                                || Session::has("presence_created") || Session::has("quiz_create") || Session::has("quiz_update")) @else show active @endif" 
                                id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <a href="{{ route("create.lesson") }}?course_id={{ $my_course->id }}" class="btn-sm btn btn-success">
                                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                            New Lessons
                                        </a>
                                        <ul class="list-group mt-2">
                                            @foreach ($my_course->lesson as $item_lesson)
                                                <li class="list-group-item" style="font-weight: normal">
                                                    <div class="row">
                                                        <div class="col-10">
                                                            <a href="{{ route("detail.lesson",["id" => $item_lesson->id]) }}">
                                                                {{ $item_lesson->title }}
                                                            </a>
                                                        </div>
                                                        <div class="col-2">
                                                            <div class="dropdown d-flex justify-content-end">
                                                                <a class="e" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                                </a>
                                                            
                                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                                    <a class="dropdown-item" href="{{ route("duplicate.lesson",["id" => $item_lesson->id]) }}">
                                                                        <span>
                                                                            <i class="fas fa-copy"></i>
                                                                            Duplicate
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade 
                                @if(Session::has("updated_task") || Session::has("created_task") || Session::has("deleted_task")) show active @endif" 
                                id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <a href="{{ route('task.create') }}?course_id={{ $my_course->id }}" class="btn-sm btn btn-success">
                                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                            New Tasks
                                        </a>
                                        <div class="row mt-3">
                                            <div class="col-sm-12">
                                                @foreach ($my_course->lesson as $item)
                                                    @if ($item->task->count()!=0)
                                                    <p style="font-weight: normal" class="mb-1">{{ $item->title }}</p>
                                                        <ul class="list-group mb-4">
                                                            @foreach ($item->task as $data)
                                                                <li class="list-group-item" style="font-weight: normal">
                                                                    <a href="{{ route("task.detail",["id" => $data->id]) }}?course_id={{ $my_course->id }}">{{ $data->title }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade
                            @if(Session::has("quiz_create") || Session::has("quiz_update")) show active @endif" id="pills-quiz" role="tabpanel" aria-labelledby="pills-quiz-tab">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <a href="{{ route('create.quiz') }}?course_id={{ $my_course->id }}" class="btn-sm btn btn-success">
                                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                            New Quiz
                                        </a>
                                        <div class="row mt-3">
                                            <div class="col-sm-12">
                                                @foreach ($my_course->lesson as $item)
                                                    @if ($item->quiz->count()!=0)
                                                    <p style="font-weight: normal" class="mb-1">{{ $item->title }}</p>
                                                        <ul class="list-group mb-4">
                                                            @foreach ($item->quiz as $data)
                                                                <li class="list-group-item" style="font-weight: normal">
                                                                    <a href="{{ route("detail.quiz",["id" => $data->id]) }}?course_id={{ $my_course->id }}">{{ $data->title }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade @if(Session::has("presence_deleted") || Session::has("presence_created")) show active @endif" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <a href="" class="btn-sm btn btn-success" data-toggle="modal" data-target="#modalpresence">
                                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                            New Presence
                                        </a>
                                        <div class="row mt-3">
                                            <div class="col-sm-12">
                                                <ul class="list-group">
                                                    @foreach ($presence as $p)
                                                        <li class="list-group-item" style="font-weight: normal">
                                                            <div class="row align-self-center">
                                                                <div class="col-sm-10">
                                                                    <p class="mb-1">{{ $p->title }}</p>
                                                                    @if (date("Y-m-d H:i")>date("Y-m-d H:i" , strtotime($p->due_date)))
                                                                        <p>Access Closed </p>
                                                                    @else
                                                                        <p>Access opened until <strong>{{ $p->due_date }}</strong></p>
                                                                    @endif
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <div class="d-flex justify-content-end">
                                                                        <a href="" class="btn-sm btn btn-danger mr-1" data-toggle="modal" data-target="#deletepresence{{ $p->id }}">
                                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                                        </a>
                                                                        <a href="{{ route("presence.detail",["id" => $p->id]) }}" class="btn-sm btn btn-primary">
                                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                                        </a>
                                                                        <div class="modal fade" id="deletepresence{{ $p->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog">
                                                                                <form action="{{ route("presence.delete",["id" => $p->id]) }}" method="post">
                                                                                    @csrf
                                                                                    @method("DELETE")
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title" id="exampleModalLabel">Yakin mau menghapus?</h5>
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                <span aria-hidden="true">&times;</span>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <p class="mb-1">Title : <strong>{{ $p->title }}</strong></p>
                                                                                            <p>Created at : <strong>{{ $p->created_at->diffForHumans() }}</strong></p>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="modalpresence" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('presence.create') }}?course_id={{ $my_course->id }}" method="post">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Buat Presensi Baru</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="due_date">Due Date</label>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="date" name="date" id="date" class="form-control" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="time" name="time" id="time" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-sm-4 mt-2 mb-2">
            <div class="accordion" id="accordionExample">
                <div class="card " style="border-top: 2px solid #0076fa">
                    <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left" style="color: #0076fa" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <span><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                            Information
                            <span class="float-right">
                                <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
                            </span>
                        </button>
                    </h2>
                    </div>
                
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        Pada halaman my course ini kamu dapat melihat kelas yang terdaftar pada course/pelajaran ini , lalu kamu pun bisa menambah lesson yang akan dipelajari oleh siswa
                        dan juga bisa menambahkan presensi untuk mendata kehadiran siswa.
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
@endsection