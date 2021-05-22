@extends('user.layout.app')

@section('content')
    <h4>{{ $quiz->title }}</h4>
    <div id="underline"></div>
    @if (Session::has("question_create"))
        <div class="alert alert-success" role="alert">
            <strong>{{ Session::get("question_create") }}</strong>
        </div>
    @elseif(Session::has('q_update'))
        <div class="alert alert-success" role="alert">
            <strong>{{ Session::get('q_update') }}</strong>
        </div>
    @elseif(Session::has('q_delete'))
        <div class="alert alert-warning" role="alert">
            <strong>{{ Session::get('q_delete') }}</strong>
        </div>
    @elseif(Session::has("openen_access"))
        <div class="alert alert-primary" role="alert">
            <strong>{{ Session::get("openen_access") }}</strong>
        </div>
    @endif
    <div class="row flex-column-reverse flex-sm-row">
        <div class="col-sm-8 mb-2">
            <div class="card">
                <div class="card-body">
                    <div class="alert alert-primary">
                        <p style="font-size: 16px">Note : Akses quiz tidak akan di buka apabila quiz tersebut 
                            tidak memiliki pertanyaan sesuai dengan jumlah pertanyaan yang sebelumnya telah di inputkan</p>
                    </div>
                    <hr>
                    <p class="mb-1">Instructions : 
                        @if ($quiz->instructions)
                            <div class="alert alert-success" role="alert">
                                <b>{!! $quiz->instructions !!}</b>
                            </div>
                        @else
                            -
                        @endif
                    </p>
                    <p class="mb-1">Attempt : {{ $quiz->allowed_attempt }} Times</p>
                    <p class="mb-1">Access : {{ Str::ucfirst($quiz->access_type) }}</p>
                    <p>Due Date : {{ $quiz->due_date }}</p>
                    <p>Question : {{ $quiz->number_of_question }} Number</p>
                    @php $nilai = 0; @endphp
                    @foreach ($quiz->question as $data)
                        @php $nilai += $data->nilai @endphp
                    @endforeach
                    <p>Max Point : {{ $nilai }} Points</p>
                    @if ($quiz->question->count()!=0)
                        <a class="" data-toggle="collapse" href="#collapsetwo" role="button" aria-expanded="false" aria-controls="collapsetwo">
                            Lihat Pertanyaan
                        </a>
                    @endif
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        @if ($quiz->question->count()==$quiz->number_of_question)
                            @if ($quiz->access_type!="Opened")
                                <form action="{{ route("open.access",["id" => $quiz->id]) }}" method="post">
                                    @csrf
                                    @method("PUT")
                                    <button type="submit" class="btn-sm btn btn-primary">Buka Akses</button>
                                </form>
                            @else
                                <p class="mb-1 align-self-center"><a href="{{ route("submitted.quiz",["id" => $quiz->id]) }}">Submitted : {{ $quiz->siswa->count() }}</a></p>
                            @endif
                        @else
                            <a class="btn btn-success btn-sm" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <i class="fas fa-pen-alt"></i>
                                Buat Pertanyaan
                            </a>
                        @endif
                        <div>
                            <a href="{{ route("edit.quiz", ["id" => $quiz->id]) }}?course_id={{ request()->course_id }}" class="btn-sm btn btn-info text-white">
                                Edit
                            </a>
                            <a href="#" class="btn-sm btn btn-danger" data-toggle="modal" data-target="#deletequiz{{ $quiz->id }}">
                                Delete
                            </a>
                            <div class="modal fade" id="deletequiz{{ $quiz->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{ route("delete.quiz",["id" => $quiz->id]) }}" method="post">
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
                                                <p class="mb-1">Title : <strong>{{ $quiz->title }}</strong></p>
                                                <p class="mb-1">Created At : <strong>{{ $quiz->created_at }}</strong></p>
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
            </div>
            <div class="collapse mt-2 {{ $errors->any() ? "show" : "" }}" id="collapseExample">
                <div class="card card-body">
                    <h5>Create Question</h5>
                    <p>Question Number {{ $quiz->question->count()+1 }}</p>
                    <hr>
                    <form action="{{ route("store.question") }}?quiz_id={{ $quiz->id }}" method="post">
                        @csrf
                        <input type="hidden" name="question_number" value="{{ $quiz->question->count()+1 }}">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="question">Question</label>
                                    <textarea name="question" id="summernote-head"></textarea>
                                    @error('question')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="question">Option A</label>
                                    <textarea name="option_a" id="summernote-rega"></textarea>
                                    @error('option_a')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="question">Option B</label>
                                    <textarea name="option_b" id="summernote-regb"></textarea>
                                    @error('option_b')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="question">Option C</label>
                                    <textarea name="option_c" id="summernote-regc"></textarea>
                                    @error('option_c')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="question">Option D</label>
                                    <textarea name="option_d" id="summernote-regd"></textarea>
                                    @error('option_d')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="nilai">Nilai Soal</label>
                                    <input type="text" name="nilai" id="nilai" class="form-control">
                                    @error('nilai')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="key">Kunci Jawaban</label>
                                    <input type="text" name="key" id="key" class="form-control">
                                    @error('key')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn-sm btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
            <div class="collapse mt-2 {{ isset(request()->page) ? "show" : "" }}" id="collapsetwo">
                <div class="card card-body">
                    @foreach ($quiz->question as $key => $q)
                        <div class="card mb-2">
                            <div class="card-header">
                                Number {{ $key+1 }}
                            </div>
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
                                <div class="row mt-4">
                                    <div class="col-sm-12">
                                        <p class="mb-1">Nilai : {{ $q->nilai }} Poin</p>
                                        <p class="mb-1">Kunci Jawaban : {{ $q->key }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route("edit.question",["id" => $q->id]) }}?quiz_id={{ $quiz->id }}" class="btn-sm btn btn-primary">
                                    <i class="fas fa-pen-alt"></i>
                                </a>
                                <a href="" class="btn-sm btn btn-danger" data-toggle="modal" data-target="#modaldeleteq{{ $q->id }}">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                                <div class="modal fade" id="modaldeleteq{{ $q->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="{{ route("delete.question",["id" => $q->id]) }}?course_id={{ request()->course_id }}&quiz_id={{ $quiz->id }}" method="post">
                                            @csrf
                                            @method("DELETE")
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Yakin mau menghapus</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="mb-1">Title : {!! $q->question_title !!}</p>
                                                    <p class="mb-1">Created At : <strong>{{ $q->created_at }}</strong></p>
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
                    @endforeach
                </div>
            </div>
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
                        Kamu baru saja membuat quiz baru dan pada halaman ini kamu dapat melihat detail quiz yang baru saja kamu buat .
                        Akses quiz ini akan otomatis closed apabila pertanyaan yang telah di buat tidak sesuai dengan jumlah pertanyaan yang kamu masukkan
                        saat membuat quiz baru . Saat pertanyaan telah terpenuhi akan ada tombol untuk membuka akses quiz .
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
@push('script')
    <script>
    $(function () {
        // Summernote
        $('#summernote-head').summernote({
            'height' : 185
        })
        $('#summernote-essay').summernote({
            'height' : 185
        })

        $('#summernote-rega').summernote({
            'height' : 145
        })
        $('#summernote-regb').summernote({
            'height' : 145
        })
        $('#summernote-regc').summernote({
            'height' : 145
        })
        $('#summernote-regd').summernote({
            'height' : 145
        })
    })
    </script>
@endpush