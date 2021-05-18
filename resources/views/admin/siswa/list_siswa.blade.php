@extends('admin.layout.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <a class="btn btn-primary mb-2" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                Tambah
            </a>
            <div class="collapse {{ $errors->any() ? "show" : "" }}" id="collapseExample" style="t">
                <div class="card card-body" style="position: relative;max-width: 100%">
                    <form action="{{ route("create.siswa") }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="nama_depan">Nama Depan</label>
                                    <input type="text" name="nama_depan" id="nama_depan" class="form-control" value="{{ old("nama_depan") ?? "" }}">
                                    @error('nama_depan')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="nama_belakang">Nama Belakang</label>
                                    <input type="text" name="nama_belakang" id="nama_belakang" class="form-control" value="{{ old("nama_belakang") ?? "" }}">
                                    @error('nama_belakang')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="nip">Nomor Induk Siswa</label>
                                    <input type="number" name="nis" id="nis" class="form-control" value="{{ old("nis") ?? "" }}">
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
                                        <option value="{{ $j->id }}">{{ $j->nama_jurusan }}</option>
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
                                        <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                                    @endforeach
                                </select>
                                @error('kelas')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 mt-3">
                                <label for="password">Password</label>
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
                        </div>
                        
                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-success">Create</button>
                        </div>
                    </form>
                </div>
            </div>

            @if (Session::has("siswa_created"))
                <div class="alert alert-success" role="alert">
                    <strong>{{ Session::get('siswa_created') }}</strong>
                </div>
            @elseif(Session::get("updated"))
                <div class="alert alert-success" role="alert">
                    <strong>{{ Session::get('updated') }}</strong>
                </div>
            @elseif(Session::has("deleted"))
                <div class="alert alert-warning" role="alert">
                    <strong>{{ Session::get("deleted") }}</strong>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-12 align-self-center">
                            <div class="form-group">
                                <select name="kelas_id" id="kelas_id" class="form-control">
                                    <option disabled selected>-- Pilih Kelas --</option>
                                    @foreach ($kelas as $k)
                                        <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 btn-eksport" style="display: none">
                            <a href="" class="btn-sm btn btn-success" id="btn-excel" target="_blank">
                                <i class="fas fa-file-excel"></i>
                                 Excel
                            </a>
                            <a href="" class="btn-sm btn btn-danger" id="btn-pdf" target="_blank">
                                <i class="fas fa-file-pdf"></i>
                                 PDF
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>NIS</th>
                                <th>Kelas</th>
                                <th>Jurusan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->username }}</td>
                                    <td>{{ $data->nis }}</td>
                                    <td>{{ $data->kelas->nama_kelas }}</td>
                                    <td>{{ $data->jurusan->nama_jurusan }}</td>
                                    <td>
                                        <a href="{{ route("edit.show.siswa",["id" => $data->id]) }}" class="btn-sm btn btn-success">
                                            <i class="fa fa-pencil-alt" aria-hidden="true"></i>
                                        </a>
                                        <a href="#" class="btn-sm btn btn-danger" data-toggle="modal" data-target="#modaldelete{{ $data->id }}">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                        <div class="modal fade" id="modaldelete{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form action="{{ route('delete.siswa',["id" => $data->id]) }}" method="post">
                                                    @csrf
                                                    @method("DELETE")
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Yakin mau menghapus data siswa?</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p class="mb-1">Nama : <strong>{{ $data->name }}</strong></p>
                                                            <p class="mb-1">Username : <strong>{{ $data->username }}</strong></p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-secondary">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>NIS</th>
                                <th>Kelas</th>
                                <th>Jurusan</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
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
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info" : true,
                "autoWidth": false,
            });
        });
    </script>
@endpush

@push('script')
    <script>
        $("#kelas_id").on("change",function(){
            $(".btn-eksport").css("display","inline-block")
            var kelas_id = $(this).val();
            $("#btn-excel").attr("href","/eksport/user/siswa?type=excel&kelas_id="+kelas_id);
            $("#btn-pdf").attr("href","/eksport/user/siswa?type=pdf&kelas_id="+kelas_id);
        })
    </script>
@endpush