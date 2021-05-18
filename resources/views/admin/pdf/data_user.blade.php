<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        table, th, td {
            border: 1px solid black;
        }
        td{
            margin: 10px;
        }
    </style>
</head>
<body>
    <h4>Info User Login LMS Be-Smart</h4>
    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>Nama</th>
                <th>NIS</th>
                <th>Kelas</th>
                <th>Username</th>
                <th>Password</th>
            </tr>
        </thead>
        <tbody>
            @foreach($siswa as $s)
                <tr>
                    <td>{{$s->name}}</td>
                    <td>{{$s->nis}}</td>
                    <td>{{$s->kelas->nama_kelas}}</td>
                    <td>{{$s->username}}</td>
                    <td>{{ $s->password_without_hash }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>