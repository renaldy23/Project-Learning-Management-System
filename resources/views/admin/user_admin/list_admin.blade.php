@extends('admin.layout.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <a class="btn btn-primary mb-2" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                Tambah
            </a>
            <div class="collapse {{ $errors->any() ? "show" : "" }}" id="collapseExample" style="">
                <div class="card card-body" style="position: relative;max-width: 100%">
                    <form action="{{ route("create.admin") }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" id="nama" class="form-control" value="{{ old("nama") ?? "" }}">
                                    @error('nama')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" id="username" class="form-control" value="{{ old("username") ?? "" }}">
                                    @error('username')
                                        <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
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
            @if (Session::has("created_admin"))
                <div class="alert alert-success" role="alert">
                    <strong>{{ Session::get("created_admin") }}</strong>
                </div>
            @elseif(Session::has("updated"))
                <div class="alert alert-success" role="alert">
                    <strong>{{ Session::get('updated') }}</strong>
                </div>
            @elseif(Session::get("deleted"))
                <div class="alert alert-warning" role="alert">
                    <strong>{{ Session::get("deleted") }}</strong>
                </div>
            @endif
            <div class="card">
                <div class="card-header w-100">
                  <h3 class="card-title">
                    
                  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->username }}</td>
                                    <td>{{ Str::ucfirst($data->status) }}</td>
                                    <td>
                                        <a href="{{ route('edit.show.admin',["id" => $data->id]) }}" class="btn-sm btn btn-success"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>
                                        @if (Auth::guard("admin")->user()->id!=$data->id)
                                            <a href="#" class="btn-sm btn btn-danger" data-toggle="modal" data-target="#modaldelete{{ $data->id }}">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>
                                            <div class="modal fade" id="modaldelete{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="{{ route('delete.admin',["id" => $data->id]) }}" method="post">
                                                        @csrf
                                                        @method("DELETE")
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Yakin mau menghapus?</h5>
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
                                        @else
                                            
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-secondary">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["pdf"]
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