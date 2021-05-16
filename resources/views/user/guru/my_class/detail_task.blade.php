@extends('user.layout.app')

@section('content')
    <h4>{{ $course->course_title}}</h4>
    <div id="underline"></div>
    @foreach ($task as $item)
        @if ($item->task->count()!=0)
        <p style="font-weight: normal" class="mb-1">{{ $item->title }}</p>
            <ul class="list-group mb-4">
                @foreach ($item->task as $data)
                    <li class="list-group-item" style="font-weight: normal">
                        <a href="{{ route("task.detail",["id" => $data->id]) }}">{{ $data->title }}</a>
                    </li>
                @endforeach
            </ul>
        @endif
    @endforeach
@endsection