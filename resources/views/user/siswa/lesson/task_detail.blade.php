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
                            @if (date("Y-m-d H:i")==date("Y-m-d H:i" , strtotime($task->due_date)))
                                
                            @else
                                <p>Due Date <strong>{{ $task->due_date }}</strong></p>
                            @endif
                        </div>
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