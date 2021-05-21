@extends('user.layout.app')

@section('content')
    <h4>Edit Quiz {{ $quiz->title }}</h4>
    <div id="underline"></div>
    <div class="card rounded-lg">
        <div class="card-body">
            <form action="{{ route("update.quiz",["id" => $quiz->id]) }}?course_id={{ request()->course_id }}" method="post">
                @csrf
                @method("PUT")
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="title">Quiz Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old("title") ?? $quiz->title }}">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="lesson_id">Lessons <span class="text-danger">*</span></label>
                            <select name="lesson_id" id="lesson_id" class="form-control">
                                <option disabled selected>-- Choose Lesson</option>
                                @foreach ($lesson as $l)
                                    @if ($l->id==$quiz->lesson_id)
                                        <option value="{{ $l->id }}" selected>{{ $l->title }}</option>
                                    @else
                                        <option value="{{ $l->id }}">{{ $l->title }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('lesson_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="instructions">Quiz Instructions</label>
                            <textarea id="summernote" name="instructions">{{ old("instructions") ?? $quiz->instructions }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="amount_of_question" class="mb-0">Amount of Question <span class="text-danger">*</span></label><br>
                            <small style="font-size: 14px">( Jumlah pertanyaan yang akan ada di quiz ini )</small>
                            <input type="number" name="amount_of_question" id="amount_of_question" class="form-control" value="{{ old("amount_of_question") ?? $quiz->number_of_question }}">
                            @error('amount_of_question')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row input-date-time">
                    <div class="col-sm-12">
                        <label for="">Due Date : </label>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date" class="form-control" value="{{ old("date") ?? date("Y-m-d",strtotime($quiz->due_date)) }}">
                            @error('date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="time">Time</label>
                            <input type="time" name="time" id="time" class="form-control" value="{{ old("time") ?? date("H:i",strtotime($quiz->due_date)) }}">
                            @error('time')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
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