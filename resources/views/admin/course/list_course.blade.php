@extends('admin.layout.app')

@section('content')
    @if (Session::has("courses_created"))
        <div class="alert alert-success" role="alert">
            <strong>{{ Session::get('courses_created') }}</strong>
        </div>
    @elseif(Session::has("updated"))
        <div class="alert alert-success" role="alert">
            <strong>{{ Session::get("updated") }}</strong>
        </div>
    @elseif(Session::has("deleted"))
        <div class="alert alert-warning" role="alert">
            <strong>{{ Session::get("deleted") }}</strong>
        </div>
    @endif
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-12 mt-2">
                    <div class="bg-dark py-3 px-3 rounded-lg shadow">
                        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Create Course
                        </a>
                        <div class="collapse {{ $errors->any() ? "show" : '' }}" id="collapseExample">
                            <div class="card card-body" style="position: relative;max-width: 100%">
                                <form action="{{ route("create.course") }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="title">Course Title</label>
                                            <input type="text" name="title" id="title" class="form-control">
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
                                                    <option value="{{ $g->id }}">{{ $g->name }}</option>
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
                                        <div class="col-sm-12">
                                            <label for="kelas">Kelas</label>
                                            <select class="select2bs4" multiple="multiple" data-placeholder="Select a State"
                                            style="width: 100%;" name="kelas[]">
                                                @foreach ($kelas as $k)
                                                    <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end mt-3">
                                        <button type="submit" class="btn btn-success">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div style="height: 2px; background-color: grey;" class="mt-2 mb-2"></div>
                        @if ($courses->count() == 0)
                            <p class="text-center text-muted">Belum ada course untuk saat ini!</p>
                        @else
                            <div class="row">
                                @foreach ($courses as $course)
                                    <div class="col-sm-3">
                                        <div class="card shadow-lg">
                                            <div class="card-header" style="background-color: #6c757d">
                                                {{ Str::upper($course->course_title) }}
                                            </div>
                                            <div class="card-body">
                                                <p class="mb-1">Guru : {{ $course->guru->name }}</p>
                                                <p>Available For : {{ $course->kelas->count() }} Classes
                                            </div>
                                            <div class="card-footer"    style="background-color: #6c757d">
                                                <a href="{{ route("edit.show.course",["id" => $course->id]) }}" class="btn-sm btn btn-success">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <a href="{{ route("delete.course",["id" => $course->id]) }}" class="btn-sm btn btn-danger" data-toggle="modal" data-target="#modaldelete{{ $course->id }}">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </a>
                                                <div class="modal fade" id="modaldelete{{ $course->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <form action="{{ route("delete.course",["id" => $course->id]) }}" method="post">
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
                                                                    <p>Course Title : <strong>{{ $course->course_title }}</strong></p>
                                                                    <p>Guru : <strong>{{ $course->guru->name }}</strong></p>
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
                                @endforeach
                            </div>
                        @endif
                    </div>
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