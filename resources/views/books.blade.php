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
   <h1>Daftar Penulis</h1>
<ul>
    @foreach($books as $book)    
    <li>{{ $book->title }}</li>
    @endforeach
</ul>
</ul>
</body>
</html>