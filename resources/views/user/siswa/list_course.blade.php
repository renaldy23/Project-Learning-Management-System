@extends('user.layout.app')

@section('content')
    <h4>Course</h4>
    <div id="underline"></div>
    <div class="row">
        @foreach ($kelas->course as $item)
            <div class="col-lg-4">
                <ul class="list-group mt-2">
                    <li class="list-group-item" style="max-height: 100%">
                        <p class="mb-1">{{ $item->course_title }}</p>
                        <a href="{{ route('siswa.course.detail',["id" => $item->id]) }}" class="btn-sm btn btn-primary">
                            Detail
                        </a>
                    </li>
                </ul>
            </div>
        @endforeach
    </div>
@endsection

@push('css-inline')
    <style>
        .list-group-item:last-child{
            border-radius: 10px!important
        }
    </style>
@endpush