<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th style="background-color: #c9e9ffea; font-weight: bold; height: 40px; text-align: center; width: 50px; ">ID</th>
                <th style="background-color: #c9e9ffea; font-weight: bold; height: 40px; text-align: center; width: 250px;">Nama</th>
                <th style="background-color: #c9e9ffea; font-weight: bold; height: 40px; text-align: center; width: 250px;">NIP</th>
                <th style="background-color: #c9e9ffea; font-weight: bold; width: 150px; height: 40px; text-align: center;">TEMPAT LAHIR</th>
                <th style="background-color: #c9e9ffea; font-weight: bold; width: 150px; height: 40px; text-align: center;">TANGGAL LAHIR</th>
                <th style="background-color: #c9e9ffea; font-weight: bold; width: 150px; height: 40px; text-align: center;">JENIS KELAMIN</th>
                <th style="background-color: #c9e9ffea; font-weight: bold; width: 150px; height: 40px; text-align: center;">CREATED_AT</th>
                <th style="background-color: #c9e9ffea; font-weight: bold; width: 150px; height: 40px; text-align: center;">UPDATED_AT</th>
            </tr>
            
        </thead>
        <tbody>
            @php
               $no = 1; 
            @endphp
            @foreach ($dataguru as $guru)

            <tr>
                <th scope="row">{{$no++}}</th>
                <td >{{ $guru->namaguru }}</td>
                <td>{{ $guru->user->nisn_nip }}</td>
                <td>{{ $guru->tempatlahir }}</td>
                <td>{{ $guru->tanggallahir }}</td>
                <td>{{ $guru->jeniskelamin }}</td>
                <td>{{ $guru->created_at->diffForhumans() }}</td>
                <td>{{ $guru->updated_at->diffForhumans() }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>


