@extends('user.layout.app')

@section('content')
    <h4>{{ $presence->title }}</h4>
    <div id="underline"></div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="presence-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Presence At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($presence->siswapresence as $siswa)
                                    <tr>
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td>{{ $siswa->siswa->name }}</td>
                                        <td>{{ $siswa->status }}</td>
                                        <td>{{ $siswa->created_at }}</td>
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
@push('script')
    <script>
        $(document).ready( function () {
            $('#presence-table').DataTable();
        });
    </script>
@endpush