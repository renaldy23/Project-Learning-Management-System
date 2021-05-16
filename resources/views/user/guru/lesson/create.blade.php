@extends('user.layout.app')

@section('content')
    <h4>Create Lesson</h4>
    <div id="underline"></div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route("store.lesson") }}?course_id={{ request()->course_id }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="title" class="form-control">
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
                                    <textarea id="summernote" name="lesson_detail"></textarea>
                                    @error('lesson_detail')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
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
                        <button type="submit" class="btn btn-primary">Save</button>
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