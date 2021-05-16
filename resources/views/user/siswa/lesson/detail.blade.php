@extends('user.layout.app')

@section('content')
    @if (Session::has("presence_attempted"))
        <div class="alert alert-primary">
            <strong>{{ Session::get('presence_attempted') }}</strong>
        </div>
    @endif
    <h4>{{ $course->course_title }}</h4>
    <div id="underline"></div>
    <div class="row mt-2">
        <div class="col-sm-8 mt-3 mw-100">
            <div class="container mw-100 bg-white p-3 shadow rounded-lg">
                <ul class="nav nav-pills mb-3 nav-fill" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" 
                        aria-selected="true">Lesson</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" 
                        id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" 
                        aria-selected="false">Task</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Presence</a>
                    </li>
                </ul>
                <div id="underline"></div>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="row">
                            <div class="col-sm-12">
                                <ul class="list-group mt-2">
                                    @foreach ($course->lesson as $item)
                                        <li class="list-group-item" style="font-weight: normal">
                                            <a href="{{ route("siswa.lesson.detail",["id" => $item->id]) }}">{{ $item->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row mt-3">
                                    <div class="col-sm-12">
                                        @foreach ($course->lesson as $item)
                                            @if ($item->task->count()!=0)
                                                <p style="font-weight: normal" class="mb-1">{{ $item->title }}</p>
                                                <ul class="list-group mb-4">
                                                    @foreach ($item->task as $data)
                                                        <li class="list-group-item" style="font-weight: normal">
                                                            <a href="{{ route("siswa.task.detail",["id" => $data->id]) }}">{{ $data->title }}</a>
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
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <div class="row">
                            <div class="col-sm-12">
                                <ul class="list-group">
                                    @foreach ($presence as $p)
                                        <li class="list-group-item">
                                            <p style="font-weight: normal" class="mb-1">
                                                {{ $p->presence->title }}
                                            </p>
                                            @if (date("Y-m-d H:i")>date("Y-m-d H:i" , strtotime($p->presence->due_date)))
                                                <p>Access Closed </p>
                                            @else
                                                <p style="font-weight: normal">Access opened until <strong>{{ $p->presence->due_date }}</strong></p>
                                                @if ($p->status=="done" && $p->siswa_id == Auth::guard("student")->user()->id)
                                                    <p class="text-muted" style="font-weight: normal; font-size: 15px">Presence Confirmed</p>
                                                @else
                                                    <form action="{{ route("presence.attempt",["id" => $p->presence->id]) }}" method="post">
                                                        @csrf
                                                        <button type="submit" class="btn-sm btn btn-success">Precense</button>
                                                    </form>
                                                @endif
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mt-3">
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
                        Pada halaman course ini kamu dapat melihat daftar lesson yang sudah di berikan oleh guru , 
                        lalu pada halaman ini juga kamu dapat melihat daftar task berdasarkan lesson yang sudah diberikan oleh guru . 
                        Dan jangan lupa untuk mengecek apakah ada presensi yang disediakan oleh guru
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection