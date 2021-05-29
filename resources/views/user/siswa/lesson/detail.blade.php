@extends('user.layout.app')

@section('content')
    @if (Session::has("presence_attempted"))
        <div class="alert alert-primary">
            <strong>{{ Session::get('presence_attempted') }}</strong>
        </div>
    @endif
    <h4>{{ $course->course_title }}</h4>
    <div id="underline"></div>
    <div class="row mt-2 flex-column-reverse flex-md-row">
        <div class="col-lg-8 mt-3 mw-100">
            <div class="card">
                <div class="card-header">
                    {{ $course->guru->name }}
                </div>
                <div class="card-body">
                    <div class="container mw-100">
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
                                <a class="nav-link" 
                                id="pills-quiz-tab" data-toggle="pill" href="#pills-quiz" role="tab" aria-controls="pills-quiz" 
                                aria-selected="false">Quiz</a>
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
                            <div class="tab-pane fade" id="pills-quiz" role="tabpanel" aria-labelledby="pills-quiz-tab">
                                <div class="row">
                                    <div class="col-sm-12">
                                        @foreach ($course->lesson as $item)
                                            @if ($item->quiz->count()!=0)
                                            <p style="font-weight: normal" class="mb-1">{{ $item->title }}</p>
                                                <ul class="list-group mb-4">
                                                    @foreach ($item->quiz as $data)
                                                        <li class="list-group-item" style="font-weight: normal">
                                                            <a href="{{ route("lesson.quiz.detail",["id" => $data->id]) }}?course_id={{ $course->id }}">{{ $data->title }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        @endforeach
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
                                                        {{ $p->title }}
                                                    </p>
                                                    @if ($p->siswapresence->count()==0)
                                                        <form action="{{ route("presence.attempt",["id" => $p->id]) }}" method="post">
                                                            @csrf
                                                            <button type="submit" class="btn-sm btn btn-success">Precense</button>
                                                        </form>
                                                    @else
                                                        @foreach ($p->siswapresence as $item)
                                                            @if ($item->status=="done")
                                                                <p class="text-muted mb-1" style="font-size: 15px;">Presence Confirmed</p>
                                                                <p class="mb-1 text-muted" style="font-size: 14px">Presence at {{ $item->created_at }}</p>
                                                            @elseif($item->status=="late")
                                                                @php
                                                                    $startTime  = \Carbon\Carbon::parse($item->created_at);
                                                                    $endTime  = \Carbon\Carbon::parse($p->due_date);
                                                                    $diff_in_days = $startTime->diff($endTime)->format('%D Days %H Hours %I Minutes %S Seconds');
                                                                @endphp
                                                                <p class="text-danger mb-1">Overdue By <br> {{ $diff_in_days }}</p>
                                                            @endif
                                                        @endforeach
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
            </div>
        </div>
        <div class="col-lg-4 mt-3">
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