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
                <th style="background-color: #c9e9ffea; font-weight: bold; height: 40px; text-align: center; width: 250px;">GURU</th>
                <th style="background-color: #c9e9ffea; font-weight: bold; height: 40px; text-align: center; width: 250px;">WALAS</th>
                <th style="background-color: #c9e9ffea; font-weight: bold; width: 150px; height: 40px; text-align: center;">CREATED_AT</th>
                <th style="background-color: #c9e9ffea; font-weight: bold; width: 150px; height: 40px; text-align: center;">UPDATED_AT</th>
            </tr>
            
        </thead>
        <tbody>
            @php
               $no = 1; 
            @endphp
            @foreach ($datakelas as $kelas)

            <tr>
                <th scope="row">{{$no++}}</th>
                <td >{{ $kelas->guru->namaguru }}</td>
                <td>{{ $kelas->walikelas->namagurukelas }}</td>
                <td>{{ $kelas->created_at->diffForhumans() }}</td>
                <td>{{ $kelas->updated_at->diffForhumans() }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>


