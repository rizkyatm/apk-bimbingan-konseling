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
                <th style="background-color: #c9e9ffea; font-weight: bold; height: 40px; text-align: center; width: 250px;">Peta Kerawanan</th>
               
            </tr>
            
        </thead>
        <tbody>
            @php
               $no = 1; 
            @endphp
            @foreach ($data as $peta)

            <tr>
                <th scope="row">{{$no++}}</th>
                <td >{{ $peta->jenispetakerawanan}}</td>
               
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>


