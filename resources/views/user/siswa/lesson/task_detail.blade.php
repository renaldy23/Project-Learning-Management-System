@extends('user.layout.app')

@section('content')
    @if (Session::has("submission_store"))
        <div class="alert alert-success" role="alert">
            <strong>{{ Session::get('submission_store') }}</strong>
        </div>
    @endif
    <h4>{{ $task->title }}</h4>
    <div id="underline"></div>
    <div class="row flex-column-reverse flex-sm-row">
        <div class="col-sm-8">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            {!! $task->desc !!}
                            @if ($task->detail->count()!=0)
                                Files : 
                                <ul>
                                    @foreach ($task->detail as $item)
                                        <li><a href="{{ asset("task_files/".$item->attach_files) }}">{{ $item->attach_files }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                        @if (date("Y-m-d H:i")>date("Y-m-d H:i" , strtotime($task->due_date)))
                            <div class="card-footer">
                                Overdue at <strong class="text-danger">{{ $task->due_date }}</strong>
                            </div>
                        @else
                            <div class="card-footer">
                                Due Date <strong>{{ $task->due_date }}</strong>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @if ($submission!=null)
                <h5 class="mt-3">Submission Status</h5>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th>Submitted</th>
                                    <td>{{ $submission->submitted_at }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{ $submission->status }}</td>
                                </tr>
                                <tr>
                                    <th>Text</th>
                                    <td>{!! $submission->online_text !!}</td>
                                </tr>
                                <tr>
                                    <th>Files</th>
                                    <td>
                                        @if ($submission->attach_files)
                                            <a href="{{ asset("submission_siswa/".$submission->attach_files) }}">
                                                {{ $submission->attach_files }}
                                            </a>
                                        @else
                                            Nothing to Show
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Comment</th>
                                    <td>{{ $submission->comment ?? "" }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        @if (date("Y-m-d H:i")<date("Y-m-d H:i" , strtotime($task->due_date)))
                            <a href="" class="btn btn-success" data-toggle="modal" data-target="#modaledit{{ $submission->id }}">
                                Edit
                            </a>
                        @endif
                        @if (Session::has("not_upload"))
                            <div class="alert alert-warning" role="alert">
                                {{ Session::get("not_upload") }}
                            </div>
                        @endif
                        <div class="modal fade" id="modaledit{{ $submission->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form action="{{ route("update.submission",["id" => $submission->id]) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method("PUT")
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit your Submission</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="text_online">Text Online</label>
                                                <textarea name="text_online" id="summernote2">{{ $submission->online_text }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="attach_files">Attached Files</label><br>
                                                <a class="btn-sm btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                        Tambah file baru
                                                </a>
                                                <a class="btn-sm btn btn-danger" data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample2">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                        Hapus file saat ini
                                                </a>
                                                <div class="collapse mt-2" id="collapseExample">
                                                    <div class="card card-body">
                                                        <input type="file" name="files" id="files">
                                                    </div>
                                                </div>
                                                <div class="collapse mt-2" id="collapseExample2">
                                                    <div class="card card-body">
                                                        @if ($submission->attach_files)
                                                            <a href="{{ asset("submission_siswa/".$submission->attach_files) }}">
                                                                {{ $submission->attach_files }}
                                                            </a>
                                                            <a href="{{ route("delete.file.submission",["id" => $submission->id]) }}" class="btn-sm btn btn-danger w-50">Delete</a> 
                                                        @else
                                                            <p class="text-muted">Tidak ada file yang ditambahkan</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($submission->grade!="")
                    <h5 class="mt-3">Graded</h5>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th>Grade</th>
                                    <td>{{ $submission->grade }}</td>
                                </tr>
                                <tr>
                                    <th>Graded At</th>
                                    <td>{{ $submission->graded_at }}</td>
                                </tr>
                                <tr>
                                    <th>Graded By</th>
                                    <td>{{ $submission->guru->name }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                @endif
            @else
                <form action="{{ route("task.add.submission",["id" => $task->id]) }}?course_id={{ request()->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mt-3">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="text_online">Online Text</label>
                                <textarea name="text_online" id="summernote"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label for="bahan_ajar">Attach Files</label><br>
                            <div class="card">
                                <div class="card-body">
                                    <div class="increment control-group">
                                        <div class="form-group">
                                            <input type="file" name="file" id="file" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mt-3">Submit</button>
                </form>
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
                        Pada halaman course ini kamu dapat melihat detail dari task yang diberikan guru , kumpulkan task 
                        yang telah kalian kerjakan . untuk mengumpulkan task yakni dengan
                        teks online atau attach file .
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
@push('script')
    <script>
        $(function () {
            // Summernote
            $('#summernote').summernote({
                'height' : 170
            })
        })
    </script>
    <script>
        $(function () {
            // Summernote
            $('#summernote2').summernote({
                'height' : 170
            })
        })
    </script>
@endpush
@push('script')
<script>
    $(document).ready(function(){
        $("#btn-add").click(function(){
            var file1 = $(".clone").html();
            $(".increment").after(file1)
        })
        $(".btn-danger").on("click",function(){ 
            $("#file-clone").remove();
        });
    })
</script>
@endpush