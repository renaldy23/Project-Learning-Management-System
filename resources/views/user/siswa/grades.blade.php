@extends('user.layout.app')

@section('content')
    <h4>Grade</h4>
    <div id="underline"></div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills nav-fill mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Task</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Quiz</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent" style="font-weight: normal">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover" id="grade-table">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Course</th>
                                                            <th>Task</th>
                                                            <th>Grade</th>
                                                            <th>Graded By</th>
                                                            <th>Graded At</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($submission as $data)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $data->task->lesson->course->course_title }}</td>
                                                                <td>{{ $data->task->title }}</td>
                                                                <td>{{ $data->grade }}</td>
                                                                <td>{{ "G - ".$data->guru->name }}</td>
                                                                <td>{{ $data->graded_at }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table" id="quiz=table">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Course Name</th>
                                                            <th>Quiz Name</th>
                                                            <th>Point</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($quiz as $q)
                                                            @foreach ($q->result as $r)
                                                                @foreach ($q->siswa as $s)
                                                                    @if ($s->pivot->siswa_id==$r->siswa_id)
                                                                        <tr>
                                                                            <td scope="row">{{ $loop->iteration }}</td>
                                                                            <td>{{ $q->lesson->course->course_title }}</td>
                                                                            <td>{{ $q->title }}</td>
                                                                            <td>{{ $r->point }}/{{ $r->max_points }}</td>
                                                                            <td><a href="{{ route("lesson.quiz.detail",["id" => $q->id]) }}">Lihat</a></td>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                            @endforeach
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">{{ $quiz->links() }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@push('script')
    <script>
        $(document).ready( function () {
            $('#grade-table').DataTable();
        });
    </script>
@endpush
@push('css-inline')
    <style>
        .active{
            font-weight: normal!important;
        }
    </style>
@endpush