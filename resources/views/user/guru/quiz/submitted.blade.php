@extends('user.layout.app')

@section('content')
    <h4>Submitted for {{ $quiz->title }}</h4>
    <div id="underline"></div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route("eksport.submitted_quiz",["id" => $quiz->id]) }}" class="btn-sm btn btn-success">
                        <i class="fas fa-file-excel"></i>
                        &nbsp;Excel
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="submit-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Grade</th>
                                    <th>Attempt At</th>
                                    <th>Submitted At</th>
                                    <th>Duration</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($quiz->result as $r)
                                    @foreach ($quiz->siswa as $s)
                                        @if ($s->pivot->siswa_id==$r->siswa_id)
                                            <tr>
                                                <td scope="row">{{ $loop->iteration }}</td>
                                                <td>{{ $s->name }}</td>
                                                <td>{{ $s->kelas->nama_kelas }}</td>
                                                <td align="center">{{ $r->point }}/{{ $r->max_points }}</td>
                                                <td>{{ $s->pivot->attempt_at }}</td>
                                                <td>{{ $r->created_at }}</td>
                                                @php
                                                    $startTime  = \Carbon\Carbon::parse($s->pivot->attempt_at);
                                                    $endTime  = \Carbon\Carbon::parse($r->created_at);
                                                    $diff_in_days = $startTime->diff($endTime)->format('%H Hours %I Minutes %S Seconds');
                                                @endphp
                                                <td>{{ $diff_in_days }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
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
            $('#submit-table').DataTable();
        });
    </script>
@endpush