@extends('user.layout.app')

@section('content')
    <h4>{{ $lesson->title }}</h4>
    <div id="underline"></div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    {!! $lesson->lesson_detail !!}
                    Bahan Ajar :
                    <ul>
                        @foreach ($lesson->bahanajar as $item)
                            <li>
                                <a href="{{ asset("bahanajar/".$item->content) }}">{{ $item->content }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer">
                    {{ $lesson->created_at->diffForHumans() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css-inline')
    <style>
        iframe{
            width: 500px;
            height: 300px;
        }
        @media screen and ( max-width: 600px){
            iframe{
                width: 500px;
            }
        }
        @media screen and ( max-width: 550px){
            iframe{
                width: 400px;
            }
        }
        @media screen and ( max-width: 435px){
            iframe{
                width: 330px;
            }
        }
        @media screen and ( max-width: 390px){
            iframe{
                width: 300px;
            }
        }
        @media screen and ( max-width: 310px){
            iframe{
                width: 230px;
            }
        }
    </style>
@endpush