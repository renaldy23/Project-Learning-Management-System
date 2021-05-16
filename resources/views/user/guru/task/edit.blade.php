@extends('user.layout.app')

@section('content')
    <h4>Edit {{ $task->title }}</h4>
    <div id="underline"></div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route("task.update",["id" => $task->id]) }}" method="post">
                        @csrf
                        @method("PUT")
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="title">Task Title</label>
                                    <input type="text" name="title" id="title" class="form-control" value="{{ $task->title ?? old("title") }}">
                                    @error('title')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="lesson">For Lesson</label>
                                    <select name="lesson" id="lesson" class="form-control">
                                        @foreach ($lessons as $lesson)
                                            @if ($lesson->id == $task->lesson_id)
                                                <option value="{{ $lesson->id }}" selected>{{ $lesson->title }}</option>
                                            @else
                                                <option value="{{ $lesson->id }}">{{ $lesson->title }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('lesson')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="desc">Task Description</label>
                                    <textarea id="summernote" name="desc">{!! $task->desc ?? old("desc") !!}</textarea>
                                    @error('desc')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="due_date">Due Date</label>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="date" name="date" id="date" class="form-control mt-2" value="{{ date("Y-m-d",strtotime($task->due_date)) }}">
                                            @error('date')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="time" name="time" id="time" class="form-control mt-2" value="{{ date("H:i",strtotime($task->due_date)) }}">
                                            @error('time')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Edit</button>
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