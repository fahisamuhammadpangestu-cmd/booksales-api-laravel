<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>Daftar Penulis</h1>
<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Kota Asal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($authors as $item)
        <tr>
            <td>{{ $item['name'] }}</td>
            <td>{{ $item['city'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>