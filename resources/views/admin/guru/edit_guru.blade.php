@extends('admin.layout.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route("edit.attempt.guru",["id" => request()->id]) }}" method="post">
                        @csrf
                        @method("PUT")
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ old("name") ?? $guru->name }}">
                                    @error('name')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="nip">NIP</label>
                                    <input type="number" name="nip" id="nip" class="form-control" value="{{ old("nip") ?? $guru->nip }}">
                                    @error('nip')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" id="username" class="form-control" value="{{ old("username") ?? $guru->username }}">
                                    @error('username')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="password1">New Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password1" name="password" aria-describedby="button-addon2">
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
                            <button type="submit" class="btn btn-primary">Submit</button>
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