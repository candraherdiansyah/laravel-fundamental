<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php $nama = "Candra"?>
   <h1> ini halaman buku</h1>
   <h2>Nama Saya: <?php echo $nama ?></h2>

   @php $now = Date('d M Y') @endphp
   <h3>Hari ini Tanggal {{$now}}</h3>
</body>
</html>
