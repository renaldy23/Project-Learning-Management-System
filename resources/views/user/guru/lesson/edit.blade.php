@extends('user.layout.app')

@section('content')
    <h4>Edit Lesson</h4>
    <div id="underline"></div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route("update.lesson",["id" => $lesson->id]) }}?course_id={{ $lesson->course_id }}" method="post" enctype="multipart/form-data">
                        @method("PUT")
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="title" class="form-control" value="{{ $lesson->title ?? old("title") }}">
                                    @error('title')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="course_explanation">Lesson Detail</label>
                                    <textarea id="summernote" name="lesson_detail">{!! $lesson->lesson_detail !!}</textarea>
                                    @error('lesson_detail')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 mb-2">
                                <a class="btn-sm btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    Tambah Bahan Ajar
                                </a>
                                <a class="btn btn-sm btn-danger" data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                                    Hapus Bahan Ajar
                                </a>
                                <div class="collapse mt-2" id="collapseExample">
                                    <div class="card card-body">
                                        <div class="increment control-group">
                                            <div class="form-group">
                                                <label for="bahan_ajar">Bahan Ajar</label><br>
                                                <input type="file" name="file[]" id="file" multiple>
                                            </div>
                                        </div>
                                        <div class="clone" style="display: none">
                                            <div class="form-group">
                                                <input type="file" name="file[]" id="file-clone" multiple>
                                            </div>
                                        </div>
                                        <a href="#" class="btn-sm btn btn-success mb-2" id="btn-add">
                                            <i class="fa fa-plus" aria-hidden="true"></i> 
                                            Add
                                        </a>
                                        <a href="#" class="btn-sm btn btn-danger mb-2" id="btn-remove">
                                            <i class="fa fa-trash" aria-hidden="true"></i> 
                                            Remove
                                        </a>
                                    </div>
                                </div>
                                <div class="collapse mt-2 @if(Session::has("success_deleted")) show @endif" id="collapseExample2">
                                    <div class="card card-body">
                                        @if ($lesson->bahanajar->count() == 0)
                                            <p class="text-muted">Belum ada bahan ajar yang di tambahkan</p>
                                        @else
                                            <ul style="list-style: none">
                                                @foreach ($lesson->bahanajar as $item)
                                                    <li>
                                                        <span>
                                                            <a href="{{ route("delete.bahanajar",["id" => $item->id]) }}" class="btn-sm btn btn-danger">
                                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                            </a>
                                                        </span>
                                                        {{ $item->content }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Edit</button>
                    </form>
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
            'height' : 200
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