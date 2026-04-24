<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>Daftar Buku</h1>
<ul>
    @foreach($books as $book)
        <li>
            <strong>Judul:</strong> {{ $book->title }} <br>
            <strong>Harga:</strong> Rp{{ number_format($book->price) }}
        </li>
        <hr>
    @endforeach
</ul>
</body>
</html>