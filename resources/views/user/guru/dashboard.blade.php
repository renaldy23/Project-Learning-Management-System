@extends('user.layout.app')

@section('content')
    <h4>Dashboard</h4>
    <div id="underline"></div>

    <div class="alert alert-primary" role="alert">
        <h5>Selamat Datang , {{ Auth::user()->name }} ( Guru )</h5>
        <p>Anda saat ini sedang berada pada halaman dashboard untuk guru . 
            Mohon untuk cek apakah anda memiliki lessons ataupun tugas yang harus diberikan kepada siswa!</p>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <p>
                <i class="fa fa-info-circle" aria-hidden="true"></i>
                Recent Information
                <hr>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    Newest Lessons
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Course</th>
                                    <th>Lesson Title</th>
                                    <th>Added At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lesson as $item)
                                    <tr>
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td>{{ $item->course->course_title }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->created_at->diffForHumans() }}</td>
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