@extends('user.layout.app')

@section('content')
    <h4>My Class</h4>
    <div id="underline"></div>
    @if ($kelas==null)
        <div class="alert alert-primary">
            Kamu belum menjadi wali kelas di kelas manapun!
        </div>
    @else
        <div class="row flex-column-reverse flex-sm-row">
            <div class="col-sm-8 col-md-12 mb-3 col-lg-8">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $kelas->nama_kelas }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $kelas->jurusan->nama_jurusan }}</h6>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-header">
                                                Students : {{ $kelas->siswa->count() }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-header">
                                                Courses : {{ $kelas->course->count() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-pills mb-3 nav-fill" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="pills-home-tab"
                                        data-toggle="pill" href="#pills-home" role="tab"
                                        aria-controls="pills-home" aria-selected="true">Students</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="pills-profile-tab"
                                        data-toggle="pill" href="#pills-profile" role="tab"
                                        aria-controls="pills-profile" aria-selected="false">List Course</a>
                                    </li>
                                </ul>
                                <div id="underline"></div>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active"
                                    id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>Username</th>
                                                    <th>Last Online</th>
                                                </tr>
                                            </thead>
                                            <tbody style="font-weight: normal">
                                                @foreach ($kelas->siswa as $s)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $s->name }}</td>
                                                        <td>{{ $s->username }}</td>
                                                        <td>{{ $s->last_online }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                @foreach ($kelas->course as $c)
                                                    <div class="card" style="font-weight: normal">
                                                        <div class="card-body">
                                                            <div class="d-flex justify-content-between">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <h5 class="card-title" style="font-size: 17px;">{{ $c->course_title }}</h5>
                                                                        <h6 class="card-subtitle mb-2 text-muted">{{ $c->guru->name }}</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        @if ($c->guru_id!=Auth::guard("teacher")->user()->id)
                                                                            <a href="{{ route("class.task.detail",["id" =>$c->id]) }}" class="btn-sm btn btn-primary">
                                                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                                            </a>
                                                                        @else
                                                                            <a href="{{ route("my.course") }}" class="btn-sm btn btn-primary">
                                                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                                            </a>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 mb-3 col-md-12 col-lg-4">
                <div class="accordion" id="accordionExample">
                    <div class="card " style="border-top: 2px solid #0076fa">
                        <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" style="color: #0076fa" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <span><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                                Information
                                <span class="float-right">
                                    <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
                                </span>
                            </button>
                        </h2>
                        </div>
                    
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            Pada halaman my class ini bila kamu menjadi walikelas dari sebuah kelas kamu dapat melihat info terkait siswa-siswa mu ,
                            dan juga course yang diikuti oleh ini .
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection