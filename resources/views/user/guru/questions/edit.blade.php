@extends('user.layout.app')

@section('content')
    <h4>Edit Question</h4>
    <div id="underline"></div>
    <div class="card">
        <div class="card-body">
            <form action="{{ route("update.question",["id" => $question->id]) }}?quiz_id={{ $quiz_id }}" method="post">
                @csrf
                @method("PUT")
                <input type="hidden" name="question_number" value="{{ $question->number }}">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="question">Question</label>
                            <textarea name="question" id="summernote-head">{!! $question->question_title !!}</textarea>
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
                            <textarea name="option_a" id="summernote-rega">{!! $question->option_a !!}</textarea>
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
                            <textarea name="option_b" id="summernote-regb">{!! $question->option_b !!}</textarea>
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
                            <textarea name="option_c" id="summernote-regc">{!! $question->option_c !!}</textarea>
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
                            <textarea name="option_d" id="summernote-regd">{{ $question->option_d }}</textarea>
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
                            <input type="text" name="nilai" id="nilai" class="form-control" value="{{ $question->nilai }}">
                            @error('nilai')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="key">Kunci Jawaban</label>
                            <input type="text" name="key" id="key" class="form-control" value="{{ $question->key }}">
                            @error('key')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn-sm btn btn-primary">Edit</button>
            </form>
        </div>
    </div>
@endsection
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