@extends('user.layout.app')

@section('content')
    <h4>Course</h4>
    <div id="underline"></div>
    <div class="row">
        @foreach ($kelas->course as $item)
            <div class="col-sm-3">
                <ul class="list-group">
                    <a href="" class="text-dark text-decoration-none">
                        <li class="list-group-item">
                            <p class="mb-1">{{ $item->course_title }}</p>
                            <a href="{{ route('siswa.course.detail',["id" => $item->id]) }}" class="btn-sm btn btn-primary">
                                Detail
                            </a>
                        </li>
                    </a>
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