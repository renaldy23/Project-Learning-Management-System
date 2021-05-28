@extends('admin.layout.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-primary" role="alert">
                    <strong>Selamat Datang di Dashboard , {{ Auth::guard("admin")->user()->name }} ( Admin )</strong>
                    <p>Anda saat ini sedang berada di dashboard admin , di mana anda medapat role untuk mengatur aktivitas administrasi dari BESMART LMS . Mohon untuk tidak menyalahgunakan keuntungan yang anda miliki , Terimakasih!</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-outline card-warning">
                    <div class="card-header">
                        <h3 class="card-title">
                            <span class="text-warning">
                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                Informasi
                            </span>
                        </h3>

                        <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="display: block;">
                        Pada halaman dashboard admin dapat melihat lessons baru yang dibuat oleh 
                        guru dari suatu course , admin pun dapat melihat user yang sedang login ke sistem .
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        <!-- Info boxes -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">All Users</span>
                        <span class="info-box-number">
                            {{ $all_user }}
                        </span>
                    </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-building"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Kelas</span>
                    <span class="info-box-number">{{ $all_kelas->count() }}</span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-book"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Course</span>
                    <span class="info-box-number">{{ $all_course->count() }}</span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users-cog"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Admin</span>
                    <span class="info-box-number">{{ $all_admin->count() }}</span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>

    <div class="row flex-column-revers flex-sm">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header bg-primary">
                    New Lessons
                </div>
                <div class="card-body">
                    @if ($lesson->count()!=0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Lessons</th>
                                    <th>Course</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lesson as $item)
                                    <tr>
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->course->course_title }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-center">Nothing to Show</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">
                        <span>
                            Siswa Online
                        </span>
                    </h3>

                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="display: block;">
                    @if ($online_siswa->count()!=0)
                        <ul class="list-group list-group-flush">
                            @foreach ($online_siswa as $item)
                                <li class="list-group-item">{{ $item->jurusan->singkatan."".$item->nis }} - {{ $item->name }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-center">Nothing to Show</p>
                    @endif
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">
                        <span>
                            Guru Online
                        </span>
                    </h3>

                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="display: block;">
                    @if ($online_guru->count()!=0)
                        <ul class="list-group list-group-flush">
                            @foreach ($online_guru as $g)
                                <li class="list-group-item">G - {{ $g->name }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-center">Nothing to Show</p>
                    @endif
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection