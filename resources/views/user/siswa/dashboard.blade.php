@extends('user.layout.app')

@section('content')
    <h4>Dashboard</h4>
    <div id="underline"></div>

    <div class="alert alert-primary" role="alert">
        <h5>Selamat Datang , {{ Auth::user()->name }} ( Siswa )</h5>
        <p>Anda saat ini sedang berada pada halaman dashboard untuk siswa . 
            Mohon untuk cek apakah anda memiliki assignment atau pun sebuah course untuk diikuti!</p>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <span>
                <i class="fa fa-info-circle mr-1" aria-hidden="true"></i>
                Quick Action
            </span>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-12 mt-2">
            <div class="card">
                <div class="card-header">New Lesson</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Course</th>
                                    <th>Lesson</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($course as $item)
                                    <tr>
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td>{{ $item->course->course_title }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>
                                            <a href="{{ route("siswa.lesson.detail",["id" => $item->id]) }}" class="btn-sm btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 mt-2">
            <div class="card">
                <div class="card-header">Presensi Terkini</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Title</th>
                                    <th>Due Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($presences as $presence)
                                    <tr>
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td>{{ $presence->title }} {{ $presence->course_title }}</td>
                                        <td>{{ $presence->due_date }}</td>
                                        <td>
                                            @if ($presence->siswapresence->count()==0)
                                                <form action="{{ route("presence.attempt",["id" => $presence->id]) }}" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn-sm btn btn-success">Presence</button>
                                                </form>
                                            @else
                                                <p>Presence Confirmed</p>
                                            @endif
                                        </td>
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