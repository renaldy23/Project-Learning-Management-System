@extends('admin.layout.app')

@section('content')
    <a class="btn btn-primary mb-2" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        <i class="fa fa-plus-circle" aria-hidden="true"></i>
        Wali Kelas
    </a>
    <div class="collapse {{ $errors->any() ? "show" : "" }}" id="collapseExample">
        <div class="card card-body" style="position: relative;max-width: 100%">
            <form action="{{ route("create.walikelas") }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="nama">Nama WaliKelas</label>
                            <select name="nama" id="nama" class="form-control">
                                <option disabled selected>-- Pilih Guru --</option>
                                @foreach ($guru as $g)
                                    <option value="{{ $g->id }}">{{ $g->name }}</option>
                                @endforeach
                            </select>
                            @error('nama')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <select name="kelas" id="kelas" class="form-control">
                                <option disabled selected>-- Pilih Kelas --</option>
                                @foreach ($kelas as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                                @endforeach
                            </select>
                            @error('kelas')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-2">
                    <button type="submit" class="btn btn-success">Add</button>
                </div>
            </form>
        </div>
    </div>
    @if (Session::has('walikelas'))
        <div class="alert alert-success" role="alert">
            <strong>{{ Session::get('walikelas') }}</strong>
        </div>
    @endif
    <div class="row">
        @foreach ($jurusan as $item)
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <a href="" data-target="#datakelas{{ $item->id }}" data-toggle="modal">
                            {{ $item->nama_jurusan }}
                            <span class="float-right">
                                <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
                            </span>
                        </a>
                        <div class="modal fade" id="datakelas{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="exampleModalLabel">Daftar Kelas Jurusan {{ $item->nama_jurusan }}</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            @foreach ($item->kelas as $data)
                                                <div class="col-sm-6">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            {{ $data->nama_kelas }}
                                                            <p class="mb-0">ID Kelas : {{ $data->id }}</p>
                                                            <p>Walikelas : {{ $data->walikelas->name ?? "" }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection