@extends('user.layout.app')

@section('content')
    <h4>{{ $lesson->title }}</h4>
    <div id="underline"></div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    {!! $lesson->lesson_detail !!}
                    @if ($lesson->bahanajar->count()!=0)
                        Bahan Ajar :
                        <ul>
                            @foreach ($lesson->bahanajar as $item)
                                <li>
                                    <a href="{{ asset("bahanajar/".$item->content) }}">{{ $item->content }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="card-footer">
                    {{ $lesson->created_at->diffForHumans() }}
                </div>
            </div>
        </div>
    </div>
@endsection