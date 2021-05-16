@extends('admin.layout.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route("edit.attempt.course",["id" => $course->id]) }}" method="post">
                        @csrf
                        @method("PUT")
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="title">Course Title</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ $course->course_title }}">
                                @error('title')
                                    <span class="text-danger mt-2">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col sm-6">
                                <label for="guru">Guru</label>
                                <select name="guru" id="guru" class="form-control">
                                    <option disabled selected>-- Pilih Guru --</option>
                                    @foreach ($guru as $g)
                                       @if ($g->id == $course->guru_id)
                                            <option value="{{ $g->id }}" selected>{{ $g->name }}</option>
                                       @else
                                            <option value="{{ $g->id }}">{{ $g->name }}</option>
                                       @endif
                                    @endforeach
                                </select>
                                @error('guru')
                                    <span class="text-danger mt-2">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 mt-2">
                                <label for="kelas">Kelas</label><br>
                                <select class="select2bs4" multiple="multiple" data-placeholder="Select a Class" style="width: 100%;" name="kelas[]">
                                    @foreach ($kelas as $k)
                                        @if (in_array($k->id,$classes_id))
                                            <option value="{{ $k->id }}" selected>{{ $k->nama_kelas }}</option>
                                        @else
                                            <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                {{-- <a class="btn-sm btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    Add Class
                                </a>
                                <a class="btn-sm btn btn-danger" data-toggle="collapse" href="#collapseTwo" role="button" aria-expanded="false" aria-controls="collapseTwo">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                    Remove Class
                                </a>
                                
                                <div class="collapse" id="collapseExample">
                                    <div class="card card-body mt-2">
                                        <select class="select2bs4" multiple="multiple" data-placeholder="Select a Class" style="width: 100%;" name="kelas[]">
                                            @foreach ($kelas as $k)
                                                <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="collapse @if(Session::has('class_deleted')) show @endif" id="collapseTwo">
                                    <div class="card card-body mt-2">
                                        <h6>Current Class</h6>
                                        <div class="row">
                                            @foreach ($course->kelas as $class)
                                                <div class="col-sm-4 mt-2">
                                                    <span>
                                                        <a href="{{ route("delete.course.class",
                                                        ["id" => $class->id,"course_id" => $course->id]) }}" class="btn-sm btn btn-danger">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </a>
                                                    </span>
                                                    {{ $class->nama_kelas }}
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-success">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css-inline')
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice{
            background-color: #343a40;
        }
        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: #6c757d; 
        }
    </style>
@endpush
@push('script')
    <script>
        $('.select2bs4').select2().data("select2").$container.find(".select2-selection").css('background-color', '#343a40');

    </script>
@endpush