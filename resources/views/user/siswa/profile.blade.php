@extends('user.layout.app')

@section('content')
    <h4>My Profile</h4>
    <div id="underline"></div>
    @if (Session::has("updated_siswa"))
        <div class="alert alert-success" role="alert">
            <strong>{{ Session::get("updated_siswa") }}</strong>
        </div>
    @endif
    <div class="row">
        <div class="col-sm-12">
            <div class="card rounded shadow">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <p class="mb-0 align-self-center">Edit Profile</p>
                        <a href="" class="btn-sm btn btn-success" id="edit-profile">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="alert alert-primary" role="alert">
                        Kamu bebas mencustomize seluruh informasi profile kamu . Tetapi perlu diingat bahwa kamu perlu mengigat
                        perubahan apa saja yang telah kamu buat terkait informasi profile kamu , karena seluruh informasi profile kamu
                        saat ini dibuat oleh superadmin!
                    </div>
                    <form action="{{ route("edit.siswa" , ["id" => $siswa->id]) }}" method="post">
                        @csrf
                        @method("PUT")
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $siswa->name }}" readonly>
                            @error('name')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" value="{{ $siswa->username }}" readonly>
                            @error('username')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nis">NIP</label>
                            <input type="text" name="nis" id="nis" class="form-control" value="{{ $siswa->nis }}" readonly>
                            @error('nis')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="password1">New Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password1" name="password" aria-describedby="button-addon2" readonly>
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
                            <div class="col-sm-6">
                                <label for="password2">Re-Type Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password2" name="password_confirmation" aria-describedby="button-addon2" readonly>
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" type="button" id="button-addon2" onclick="show2(this)">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="btn-edit">
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
        var input = $("#password1");

        if (input.attr('type')=="password") {
            input.attr('type','text')
            event.innerHTML = "<i class='fa fa-eye-slash' aria-hidden='true'></i>"
        }
        else{
            input.attr('type','password')
            event.innerHTML = "<i class='fa fa-eye' aria-hidden='true'></i>"
        }
    }

    function show2(event) { 
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

@push('script')
    <script>
        $("#edit-profile").click(function(event){
            event.preventDefault();
            $("input").removeAttr("readonly",false);
            $("#btn-edit").append(`<button type="submit" class="btn-sm btn btn-primary mt-3">Edit</button>`);
            $(this).remove();
        })
    </script>
@endpush