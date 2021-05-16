@extends('admin.layout.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route("edit.attempt.siswa",["id" => $siswa->id]) }}" method="post">
                        @csrf
                        @method("PUT")
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="text" name="nama" id="nama" class="form-control" value="{{ old("nama") ?? $siswa->name }}">
                                    @error('nama')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" id="username" class="form-control" value="{{ old("username") ?? $siswa->username }}">
                                    @error('username')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="nip">Nomor Induk Siswa</label>
                                    <input type="number" name="nis" id="nis" class="form-control" value="{{ old("nis") ?? $siswa->nis }}">
                                    @error('nis')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="jurusan">Jurusan</label>
                                <select name="jurusan" id="jurusan" class="form-control">
                                    <option disabled selected>-- Pilih Jurusan --</option>
                                    @foreach ($jurusan as $j)
                                        @if ($j->id==$siswa->jurusan_id)
                                            <option value="{{ $j->id }}" selected>{{ $j->nama_jurusan }}</option>
                                        @else
                                            <option value="{{ $j->id }}">{{ $j->nama_jurusan }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('jurusan')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="kelas">Kelas</label>
                                <select name="kelas" id="kelas" class="form-control">
                                    <option disabled selected>-- Pilih Kelas --</option>
                                    @foreach ($kelas as $k)
                                        @if ($k->id==$siswa->kelas_id)
                                            <option value="{{ $k->id }}" selected>{{ $k->nama_kelas }}</option>
                                        @else
                                            <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('kelas')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 mt-3">
                                <label for="password">New Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" type="button" id="button-addon2" onclick="show(this)">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                                @error('password')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-6 mt-3">
                                <label for="password">Re-Type Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password2" name="password_confirmation" aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" type="button" id="button-addon2" onclick="show2(this)">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-success">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function show(event){
            var input = $("#password");

            if (input.attr('type')=="password") {
                input.attr('type','text')
                event.innerHTML = "<i class='fa fa-eye-slash' aria-hidden='true'></i>"
            }
            else{
                input.attr('type','password')
                event.innerHTML = "<i class='fa fa-eye' aria-hidden='true'></i>"
            }
        }
    </script>
@endpush
@push('script')
    <script>
        function show2(event){
            var input = $("#password2");

            if (input.attr('type')=="password") {
                input.attr('type','text')
                event.innerHTML = "<i class='fa fa-eye-slash' aria-hidden='true'></i>"
            }
            else{
                input.attr('type','password')
                event.innerHTML = "<i class='fa fa-eye' aria-hidden='true'></i>"
            }
        }
    </script>
@endpush