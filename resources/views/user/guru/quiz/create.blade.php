@extends('user.layout.app')

@section('content')
    <h4>Create New Quiz</h4>
    <div id="underline"></div>
    <div class="card rounded-lg">
        <div class="card-body">
            <form action="{{ route("store.quiz") }}?course_id={{ request()->course_id }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="title">Quiz Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old("title") }}">
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
                                    <option value="{{ $l->id }}">{{ $l->title }}</option>
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
                            <textarea id="summernote" name="instructions"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="amount_of_question" class="mb-0">Amount of Question <span class="text-danger">*</span></label><br>
                            <small style="font-size: 14px">( Jumlah pertanyaan yang akan ada di quiz ini )</small>
                            <input type="number" name="amount_of_question" id="amount_of_question" class="form-control" value="{{ old("amount_of_question") }}">
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
                            <input type="date" name="date" id="date" class="form-control" value="{{ old("date") }}">
                            @error('date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="time">Time</label>
                            <input type="time" name="time" id="time" class="form-control" value="{{ old("time") }}">
                            @error('time')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="attempt">Attempt Allowed <span class="text-danger">*</span></label><br>
                            <input type="radio" name="attempt" id="attempt" value="1"> Only 1 Times<br>
                            <input type="radio" name="attempt" id="attempt2" value="custom" @error('multi_attempt')
                                checked
                            @enderror @if(Session::has("not_greather_than_2")) checked @endif> Customize<br>
                            @error('attempt')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row attempt-times" @if($errors->any() || Session::has("not_greather_than_2")) style="display: flex @else style="display: none @enderror"> 
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="multi_attempt">Number of Attempt</label>
                            <input type="number" name="multi_attempt" id="multi_attempt" class="form-control">
                            @error('multi_attempt')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @if (Session::has("not_greather_than_2"))
                                <span class="text-danger">{{ Session::get("not_greather_than_2") }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
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
@push('script')
    <script>

        $("#attempt2").on("click",function(){
            $(".attempt-times").css("display","flex")
        })
        $("#attempt").on("click",function(){
            $(".attempt-times").css("display","none")
        })
    </script>
@endpush