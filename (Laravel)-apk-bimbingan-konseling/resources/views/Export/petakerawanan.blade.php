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
                <th style="background-color: #c9e9ffea; font-weight: bold; height: 40px; text-align: center; width: 50px; ">NO</th>
                <th style="background-color: #c9e9ffea; font-weight: bold; height: 40px; text-align: center; width: 250px;">Nama</th>
                <th style="background-color: #c9e9ffea; font-weight: bold; height: 40px; text-align: center; width: 50px;">NISN</th>
                <th style="background-color: #c9e9ffea; font-weight: bold; height: 40px; text-align: center; width: 100px;">jenis kelamin</th>
                <th style="background-color: #c9e9ffea; font-weight: bold; height: 40px; text-align: center; width: 10em;">Sering Sakit</th>
                <th style="background-color: #c9e9ffea; font-weight: bold; height: 40px; text-align: center; width: 10em;">Sering Izin</th>
                <th style="background-color: #c9e9ffea; font-weight: bold; height: 40px; text-align: center; width: 10em;">Sering Alpa</th>
                <th style="background-color: #c9e9ffea; font-weight: bold; height: 40px; text-align: center; width: 15em;">Sering Terlambat</th>
                <th style="background-color: #c9e9ffea; font-weight: bold; height: 40px; text-align: center; width: 10em;">Bolos</th>
                <th style="background-color: #c9e9ffea; font-weight: bold; height: 40px; text-align: center; width: 15em;">Kelainan Jasmani</th>
                <th style="background-color: #c9e9ffea; font-weight: bold; height: 40px; text-align: center; width: 20em;">Minat Belajar Berkurang</th>
                <th style="background-color: #c9e9ffea; font-weight: bold; height: 40px; text-align: center; width: 20em;">Tidak Mengerjakan Tugas</th>
                <th style="background-color: #c9e9ffea; font-weight: bold; height: 40px; text-align: center; width: 15em;">Melanggar Aturan</th>
                <th style="background-color: #c9e9ffea; font-weight: bold; height: 40px; text-align: center; width: 15em;">Sering Bercanda</th>
                <th style="background-color: #c9e9ffea; font-weight: bold; height: 40px; text-align: center; width: 15em;">Perilaku Konfrontatif</th>
                <th style="background-color: #c9e9ffea; font-weight: bold; height: 40px; text-align: center; width: 15em;">Sering Berkelahi</th>
                <th style="background-color: #c9e9ffea; font-weight: bold; height: 40px; text-align: center; width: 20em;">Memiliki Gangguan Emosi</th>
                <th style="background-color: #c9e9ffea; font-weight: bold; height: 40px; text-align: center; width: 20em;">Kehilangan Orang Tua</th>
                <th style="background-color: #c9e9ffea; font-weight: bold; height: 40px; text-align: center; width: 15em;">Mengalami Trauma</th>
                <th style="background-color: #c9e9ffea; font-weight: bold; height: 40px; text-align: center; width: 15em;">Sering Mencuri</th>
                <th style="background-color: #c9e9ffea; font-weight: bold; height: 40px; text-align: center; width: 20em;">Keterbatasan Fisik</th>
                <th style="background-color: #c9e9ffea; font-weight: bold; height: 40px; text-align: center; width: 20em;">Gangguan Pendengaran</th>
                <th style="background-color: #c9e9ffea; font-weight: bold; height: 40px; text-align: center; width: 20em;">Gangguan Penglihatan</th>
                <th style="background-color: #c9e9ffea; font-weight: bold; height: 40px; text-align: center; width: 20em;">Gangguan Motorik</th>
               
            </tr>
            
        </thead>
        <tbody>
            @php
               $no = 1; 
            @endphp
            @foreach ($data as $peta)
            <tr>
                <th style="text-align: center" scope="row">{{$no++}}</th>
                <td >{{ $peta->siswa->namasiswa}}</td>
                <td style="text-align: center" >{{ $peta->siswa->user->nisn_nip}}</td>
                <td >{{ $peta->siswa->jeniskelamin}}</td>
                <td style="text-align: center" >{{ $peta->kolom1}}</td>
                <td style="text-align: center" >{{ $peta->kolom2}}</td>
                <td style="text-align: center" >{{ $peta->kolom3}}</td>
                <td style="text-align: center" >{{ $peta->kolom4}}</td>
                <td style="text-align: center" >{{ $peta->kolom5}}</td>
                <td style="text-align: center" >{{ $peta->kolom6}}</td>
                <td style="text-align: center" >{{ $peta->kolom7}}</td>
                <td style="text-align: center" >{{ $peta->kolom8}}</td>
                <td style="text-align: center" >{{ $peta->kolom9}}</td>
                <td style="text-align: center" >{{ $peta->kolom10}}</td>
                <td style="text-align: center" >{{ $peta->kolom11}}</td>
                <td style="text-align: center" >{{ $peta->kolom12}}</td>
                <td style="text-align: center" >{{ $peta->kolom13}}</td>
                <td style="text-align: center" >{{ $peta->kolom14}}</td>
                <td style="text-align: center" >{{ $peta->kolom15}}</td>
                <td style="text-align: center" >{{ $peta->kolom16}}</td>
                <td style="text-align: center" >{{ $peta->kolom17}}</td>
                <td style="text-align: center" >{{ $peta->kolom18}}</td>
                <td style="text-align: center" >{{ $peta->kolom19}}</td>
                <td style="text-align: center" >{{ $peta->kolom10}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>


