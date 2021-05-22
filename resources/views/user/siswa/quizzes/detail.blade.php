@extends('user.layout.app')

@section('content')
    <h4>{{ $quiz->title }}</h4>
    <div id="underline"></div>
    <div class="row flex-column-reverse flex-sm-row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-body">
                    <div class="alert alert-primary">
                        <p style="font-size: 16px">Note : Jika tombol attempt quiz tidak muncul kemungkinan guru untuk course
                        ini belum membuka akses untuk quiz ini , silahkan untuk menghubungi guru yang bersangkutan</p>
                    </div>
                    <hr>
                    <p class="mb-1">Instructions : 
                        @if ($quiz->instructions)
                            <div class="alert alert-success">
                                <b>{!! $quiz->instructions !!}</b>
                            </div>
                        @else
                            -
                        @endif
                    </p>
                    <p class="mb-1">Attempt : {{ $quiz->allowed_attempt }} Times</p>
                    <p class="mb-1">Access : @if($quiz->siswa->count()==$quiz->allowed_attempt) Closed @else {{ Str::ucfirst($quiz->access_type) }} @endif</p>
                    <p>Due Date : {{ $quiz->due_date }}</p>
                    <p>Question : {{ $quiz->question->count() }} Number</p>
                </div>
                @if ($quiz->access_type=="Opened")
                    @if ($quiz->siswa->count()!=$quiz->allowed_attempt)
                        @if (date("Y-m-d H:i")>date("Y-m-d H:i" , strtotime($quiz->due_date)))
                            <div class="card-footer">Access Closed for this Quiz</div>
                        @else
                            <div class="card-footer">
                                <a href="" class="btn-sm btn btn-primary" data-toggle="modal" data-target="#modalattempt">Attempt Quiz Now</a>
                            </div>
                            <div class="modal fade" id="modalattempt" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="{{ route("attempt.quiz",["id" => $quiz->id]) }}" method="post">
                                                @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Attempt Now?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="mb-1">Title : {{ $quiz->title }}</p>
                                                <p class="mb-1">Total : {{ $quiz->question->count() }} Number</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Attempt</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="card-footer">
                            <a class="btn btn-sm btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                Review Answers
                            </a>
                        </div>
                    @endif
                @endif
            </div>
            <div class="collapse mt-2" id="collapseExample">
                <div class="card card-body">
                    <div class="row">
                        @foreach ($quiz->question as $key => $q)
                            @foreach ($quiz->answer as $a)
                                @if ($a->question_id==$q->id)
                                    <div class="col-sm-12">
                                        <div class="card mb-2">
                                            <div class="card-header">Number {{ $key+1 }}</div>
                                            <div class="card-body">
                                                <p>{!! $q->question_title !!}</p>
                                                <div class="row mt-4">
                                                    <div class="col-sm-12">
                                                        <span id="options">{!! "A . ".$q->option_a !!}</span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <span id="options">{!! "B . ".$q->option_b !!}</span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <span id="options">{!! "C . ".$q->option_c !!}</span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <span id="options">{!! "D . ".$q->option_d !!}</span>
                                                    </div>
                                                </div>
                                                @if ($a->option == $q->key)
                                                    <div class="alert alert-success mt-2">
                                                        <div class="d-flex justify-content-between">
                                                            <p class="mb-0">Your Answer : {{ $a->option }} <i style="font-size: 14px">(Correct)</i></p>
                                                            <p class="mb-0">{{ $q->nilai }} Points</p>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="alert alert-danger mb-0 mt-2">
                                                        <div class="d-flex justify-content-between">
                                                            <p class="mb-0">Your Answer : {{ $a->option }} <i style="font-size: 14px">(Wrong)</i></p>
                                                            <p class="mb-0">0 Points</p>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
            @if ($quiz->siswa->count()==$quiz->allowed_attempt)
                <div class="row mt-2">
                    <div class="col-sm-12">
                        <h5>Quiz Result</h5>
                        <div class="table-responsive">
                            <table class="table">
                                <thead style="background-color: #0076fa; color:white; text-align: center">
                                    <tr>
                                        <th>Correct</th>
                                        <th>Score</th>
                                        <th>Attempt At</th>
                                        <th>Submitted At</th>
                                        <th>Duration</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @foreach ($quiz->result as $r)
                                        @foreach ($quiz->siswa as $s)
                                            @if ($s->pivot->quiz_id == $r->quiz_id)
                                                <tr>
                                                    <td align="center">{{ $r->correct_answer }}/{{ $quiz->question->count() }}</td>
                                                    <td align="center">{{ $r->point }}/{{ $r->max_points }}</td>
                                                    <td align="center">{{ $s->pivot->attempt_at }}</td>
                                                    <td align="center">{{ $r->created_at }}</td>
                                                    @php
                                                        $startTime  = \Carbon\Carbon::parse($s->pivot->attempt_at);
                                                        $endTime  = \Carbon\Carbon::parse($r->created_at);
                                                        $diff_in_days = $startTime->diff($endTime)->format('%H Hours %I Minutes %S Seconds');
                                                    @endphp
                                                    <td align="center">{{ $diff_in_days }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="col-sm-4 mb-2">
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
                        Pada halaman ini kamu dapat melihat detail quiz yang sudah dibuat oleh guru untuk course ini , silahkan attempt
                        quiz ini saat akses quiz telah dibuka oleh guru course ini . Bila attempt yang diizinkan oleh guru lebih dari 1 ,
                        maka kamu dapat mengerjakan quiz ini lebih dari 1 kali .
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css-inline')
    <style>
        #options p{
            display: inline;
        }
    </style>
@endpush