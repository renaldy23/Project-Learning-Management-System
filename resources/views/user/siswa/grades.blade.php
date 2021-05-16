@extends('user.layout.app')

@section('content')
    <h4>Grade</h4>
    <div id="underline"></div>
        @if ($submission->count()==0)
            <p class="text-muted text-center">Nothing to Show!</p>
        @else
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
        @endif
@endsection

@push('script')
    <script>
        $(document).ready( function () {
            $('#grade-table').DataTable();
        });
    </script>
@endpush