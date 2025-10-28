<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <fieldset>
        <legend>Data Siswa</legend>
        <table border=1>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kelas</th>
            </tr>
            @php $no = 1; @endphp
            @foreach ($data as $siswa)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$siswa['nama']}}</td>
                <td>{{$siswa['kelas']}}</td>
            </tr>
            @endforeach
        </table>
    </fieldset>
</body>

</html>
