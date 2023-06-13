<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th style="background-color: #c9e9ffea; font-weight: bold; height: 40px; text-align: center; width: 50px; ">ID</th>
                <th style="background-color: #c9e9ffea; font-weight: bold; height: 40px; text-align: center; width: 250px;">Nama</th>
                <th style="background-color: #c9e9ffea; font-weight: bold; height: 40px; text-align: center; width: 250px;">NISN</th>
                <th style="background-color: #c9e9ffea; font-weight: bold; width: 150px; height: 40px; text-align: center;">WALI KELAS</th>
                <th style="background-color: #c9e9ffea; font-weight: bold; width: 150px; height: 40px; text-align: center;">KELAS</th>
                <th style="background-color: #c9e9ffea; font-weight: bold; width: 150px; height: 40px; text-align: center;">GURU PEMBIMBING</th>
                <th style="background-color: #c9e9ffea; font-weight: bold; width: 150px; height: 40px; text-align: center;">CREATED_AT</th>
                <th style="background-color: #c9e9ffea; font-weight: bold; width: 150px; height: 40px; text-align: center;">UPDATED_AT</th>
            </tr>
            
        </thead>
        <tbody>
            @php
               $no = 1; 
            @endphp
            @foreach ($datasiswa as $siswa)

            <tr>
                <th scope="row">{{$no++}}</th>
                <td >{{ $siswa->namasiswa }}</td>
                <td>{{ $siswa->user->nisn_nip}}</td>
                <td>{{ $siswa->kelas->walikelas->namagurukelas}}</td>
                <td>{{ $siswa->kelas->kelas}}</td>
                <td>{{ $siswa->kelas->guru->namaguru}}</td>
                <td>{{ $siswa->created_at->diffForhumans() }}</td>
                <td>{{ $siswa->updated_at->diffForhumans() }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>