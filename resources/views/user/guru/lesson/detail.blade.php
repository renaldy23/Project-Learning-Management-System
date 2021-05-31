@extends('user.layout.app')

@section('content')
    <h4>{{ $lesson->title }}</h4>
    <div id="underline"></div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    {!! $lesson->lesson_detail !!}
                    <p>Bahan ajar : </p>
                    <ul>
                        @foreach ($lesson->bahanajar as $item)
                            <li>
                                <a href="{{ asset("bahanajar/".$item->content) }}">{{ $item->content }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <p style="font-size: 14px">Last modified at {{ $lesson->updated_at->diffForHumans() }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route("edit.lesson",["id" => $lesson->id]) }}" class="btn-sm btn btn-success">Edit</a>
                    <a href="#" class="btn-sm btn btn-danger" data-toggle="modal" data-target="#deletelesson{{ $lesson->id }}">Delete</a>
                    <div class="modal fade" id="deletelesson{{ $lesson->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route("delete.lesson",["id" => $lesson->id]) }}" method="post">
                                @csrf
                                @method("DELETE")
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Yakin mau menghapus lesson ini?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="mb-1">Title : <strong>{{ $lesson->title }}</strong></p>
                                        <p>Created at : <strong>{{ $lesson->created_at->diffForHumans() }}</strong></p>
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
@endsection
@push('css-inline')
    <style>
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