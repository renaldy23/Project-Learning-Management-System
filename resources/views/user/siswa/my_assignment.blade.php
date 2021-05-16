@extends('user.layout.app')

@section('content')
    <h4>My Submission</h4>
    <div id="underline"></div>
    <div class="row">
        @foreach ($submission as $item)
            <div class="col-sm-12">
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="card-title">{{ $item->task->title }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $item->submitted_at }} , {{ $item->status }}</h6>
                                    <p class="card-text">
                                        {!! $item->online_text ?? "<a href='/submission_siswa/$item->attach_files'>$item->attach_files</a>" !!}
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <a href="{{ route("siswa.task.detail",["id" => $item->task_id]) }}" class="btn-sm btn btn-success">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection