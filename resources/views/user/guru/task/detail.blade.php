@extends('user.layout.app')

@section('content')
    <h4>{{ $task->title }}</h4>
    <div id="underline"></div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    {!! $task->desc !!}
                    @if ($task->detail->count()!=0)
                        Files : 
                        <ul>
                            @foreach ($task->detail as $item)
                                <li><a href="{{ asset("task_files/".$item->attach_files) }}">{{ $item->attach_files }}</a></li>
                            @endforeach
                        </ul>
                    @endif
                    @if (date("Y-m-d H:i")==date("Y-m-d H:i" , strtotime($task->due_date)))
                        
                    @else
                        <p>Access opened until <strong>{{ $task->due_date }}</strong></p>
                    @endif
                </div>
                <div class="card-footer">
                    @if ($task->lesson->course->guru_id==Auth::guard("teacher")->user()->id)
                        <a href="{{ route("task.edit",["id" => $task->id]) }}?course_id={{ request()->course_id }}" class="btn-sm btn btn-success">
                            Edit
                        </a>
                        <a href="#" class="btn-sm btn btn-danger" data-toggle="modal" data-target="#modaldelete{{ $task->id }}">
                            Hapus
                        </a>
                    @endif
                    <div class="modal fade" id="modaldelete{{ $task->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route("task.delete",["id" => $task->id]) }}" method="post">
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
                                        <p>Title : <strong>{{ $task->title }}</strong></p>
                                        <p>Created at : <strong>{{ $task->created_at->diffForHumans() }}</strong></p>
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
    </div>
    <div class="row mt-3">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <p class="mb-0 align-self-center">Submitted</p>
                        @if ($task->lesson->course->guru_id == Auth::guard("teacher")->user()->id)
                            <a href="{{ route("submission.eksport",["id" => $task->id]) }}" class="btn-sm btn btn-success">
                                <i class="fas fa-file-excel"></i>
                                &nbsp;Eksport
                            </a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped" id="task-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Student</th>
                                    <th>Submitted at</th>
                                    <th>Status</th>
                                    <th class="text-center">Grade</th>
                                    <th>Comment</th>
                                    @if ($task->lesson->course->guru_id==Auth::guard("teacher")->user()->id)
                                        <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($task->submission as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->siswa->name }}</td>
                                        <td>{{ $data->submitted_at }}</td>
                                        <td>{{ $data->status }}</td>
                                        <td align="center">{{ $data->grade }}</td>
                                        <td>{{ $data->comment ?? "" }}</td>
                                        @if ($task->lesson->course->guru_id==Auth::guard("teacher")->user()->id)
                                            <td>
                                                @if ($data->status=="Submitted" || $data->status=="Missing")
                                                    <a href="" class="btn-sm btn btn-success"
                                                    data-toggle="modal" data-target="#modalgrade{{ $data->id }}">Grade Now</a>
                                                    <div class="modal fade" id="modalgrade{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <form action="{{ route("grade.create", ["id" => $data->id]) }}" method="post">
                                                                @csrf
                                                                @method("PUT")
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Grades</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <input type="number" name="grade" id="grade"
                                                                            class="form-control" placeholder="Give this submission a grade , range 10-100">
                                                                            @error('grade')
                                                                                <span class="text-danger">
                                                                                    {{ $message }}
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <textarea class="form-control" name="comment" rows="3" placeholder="Add Comment Here (Not Required)"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @endif
                                                <a href="" class="btn-sm btn btn-primary"
                                                data-toggle="modal" data-target="#modalsubmission{{ $data->id }}">Submission</a>
                                                <div class="modal fade" id="modalsubmission{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Submission Detail</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p class="mb-1">{{ $data->siswa->name }}</p>
                                                                @if ($data->online_text)
                                                                    {!! $data->online_text !!}
                                                                @else
                                                                    <a href="{{ asset("submission_siswa/$data->attach_files") }}">
                                                                        {{ $data->attach_files }}
                                                                    </a>
                                                                @endif
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready( function () {
            $('#task-table').DataTable();
        });
    </script>
@endpush