@extends('layouts.guruLayouts')

@section('contentAdmin')
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                  <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                  <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Data Siswa</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Data Siswa</h6>
              </nav>
              <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                  <!-- tidak di isi -->
                </div>
                <ul class="navbar-nav  justify-content-end">
                  <li class="nav-item d-flex align-items-center position-relative">
                    <a href="javascript:;" class="nav-link text-body font-weight-bold px-0" id="signInDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      @if (Auth::check())
                        @if ($user->guru)
                          <img src="{{ asset('fotoguru/'.$user->guru->foto) }}" alt="Profile Picture" class="me-sm-1 rounded-circle" style="width: 32px; height: 32px; object-fit: cover; vertical-align: middle;">
                        @else
                          <i class="fa fa-user me-sm-1"></i>
                        @endif
                        <span class="d-sm-inline d-none">{{ $user->name }}</span>
                      @endif
                    </a> 
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="signInDropdown" style="top: 15px;">
                      <li>
                        <a class="dropdown-item" href="{{route('logout')}}">Log Out</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="edit-profile">Edit Profile</a>
                      </li>
                    </ul>
                  </li>  
                </ul>
              </div>
            </div>
          </nav>
          <!-- End Navbar -->
          <div class="container-fluid py-4">
            <div class="row" >
              <div class="col-12"  >
                <div class="card mb-4" style="height: max-content; min-height: 500px">
                  <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <div id="murid-container" class="px-4">
                          <div class="card-header pb-0" style="display: flex; justify-content: space-between;">
                            <h3>Data Murid Kelas {{ $kelasguru->kelas }}</h3>
                            <div style="margin-right:0px ">
                                <a class="btn btn-primary" id="tambah-jadwal" href="/exportpetakerawanansiswa/{{$kelasguru->walikelas->id}}">Export Exel</a>
                            </div>
                          </div>
                          <table class="table mx-auto">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Murid</th>
                                    <th>NISN</th>
                                    <th>jenis kelamin</th>
                                    <th>status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswa as $index => $dataMurid)
                                    <tr class="justify-content-center">
                                        <td style="padding-left: 23px;">{{ $index + 1 }}</td>
                                        <td style="padding-left: 23px;">{{ $dataMurid->namasiswa }}</td>
                                        <td style="padding-left: 23px;">{{ $dataMurid->user->nisn_nip }}</td>
                                        <td style="padding-left: 23px;">{{ $dataMurid->jeniskelamin }}</td>
                                        <td style="padding-left: 35px;">
                                            @if ($dataMurid->petakerawanan && $dataMurid->petakerawanan->siswa_id == $dataMurid->id)
                                                <i class="fas fa-check text-success"></i>
                                            @else
                                                <i class="fas fa-times text-danger"></i>
                                            @endif
                                        </td>
                                        <td style="text-align: right;">
                                          <a href="/Kerawanan/{{$dataMurid->id}}" class="btn btn-primary">Detail</a>
                                      </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>                        
                        </div>                        
                    </div>                                                  
                  </div>
                </div>
              </div>
            </div>
          </div>
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
@endsection