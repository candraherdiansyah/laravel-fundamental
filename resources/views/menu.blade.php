<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <center><h1>{{$resto}}</h1></center>

    @foreach ($data as $value)
        Nama : {{ $value['nama_makanan'] }} <br>
        Harga: {{ $value['harga'] }} <br>
        Jumlah: {{ $value['jumlah'] }} <br>
        @php $total = $value['jumlah'] * $value['harga'];  @endphp
        Total: {{ $total }} <br>
        @if($total > 15000)
        Keterangan: get diskon 5%
        @else
        Keterangan: tidak dapat diskon
        @endif
        <hr>

    @endforeach
</body>
</html>
