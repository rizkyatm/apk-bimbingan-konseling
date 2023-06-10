@extends('layouts.guruLayouts')

@section('contentAdmin')
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                  <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                  <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">ini halaman guru bk</h6>
              </nav>
              <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                  <!-- tidak di isi -->
                </div>
                <ul class="navbar-nav  justify-content-end">
                  <li class="nav-item d-flex align-items-center position-relative">
                    <a href="javascript:;" class="nav-link text-body font-weight-bold px-0" id="signInDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fa fa-user me-sm-1"></i>
                      @if (Auth::check())
                        <span class="d-sm-inline d-none">
                            Selamat datang,{{ Auth::user()->name }}
                        </span>
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
          <!-- isi start -->
          <div class="container-fluid py-4">
            <div class="row" >
              <div class="col-4" >
                <div class="card" style="height: 410px;">
                <div class="profile-picture pt-6 pl-2 pr-5 d-block align-items-center text-center" style="margin: 0 auto;  ">
                  <div class="foto-container" style="margin: 0 auto; width: 200px; height: 200px;">
                    <img src="{{ asset('fotoguru/'.$user->guru->foto) }}" alt="Foto Pengguna" id="foto">
                  </div>
                  <h5 class="mt-2" style="font-weight: bold; font-size: 18px;">{{ $user->guru->namaguru }}</p>
                  <p class="" style="font-size: 13px; margin-top: -10px;">Guru Bimbingan & Konseling</p>
                </div>
                </div>
              </div>
              <div class="col-8" >
                <div class="card mb-4" style="height: auto;">
                  {{-- ////////// tampilan profil start ////////// --}}
                  <div class="card-body" id="profile-info">
                    <div class="profile-header">
                      <div class="profile-info">
                        <h4 class="card-title" style="font-weight: bold;">Profil Pengguna</h4>
                      </div>
                    </div>
                    <div class="card-text-row">
                        <div class="d-flex mb-1">
                          <h6 class="" style="width: 30%;">Nama</h6>
                          <h6 class="" style="width: 2%;">:</h6>
                          <p>{{ $user->guru->namaguru }}</p>
                        </div>
                        <div class="d-flex mb-1">
                          <h6 style="width: 30%;">NIP</h6>
                          <h6 class="" style="width: 2%;">:</h6>
                          <p>{{ $user->nisn_nip }}</p>
                        </div>
                        <div class="d-flex mb-1">
                          <h6 style="width: 30%;">Tempat Lahir</h6>
                          <h6  style="width: 2%;">:</h6>
                          <p>{{ $user->guru->tempatlahir }}</p>
                        </div>
                        <div class="d-flex mb-1">
                          <h6 style="width: 30%;">Tanggal Lahir</h6>
                          <h6 class="" style="width: 2%;">:</h6>
                          <p>{{ $user->guru->tanggallahir }}</p>
                        </div>
                      <div class="d-flex mb-1">
                        <h6 style="width: 30%;">Jenis Kelamin</h6>
                        <h6 class="" style="width: 2%;">:</h6>
                        <p>{{ $user->guru->jeniskelamin }}</p>
                      </div>
                    </div>
                    <button class="btn" style="background-color: #4BBBFA; color: white; padding: 10px 37px;" onclick="editProfile()">Edit</button>
                  </div>
                  {{-- ////////// tampilan profil End ////////// --}}
                  <div id="edit-form" style="display: none;" class="pt-3">
                    <form class="mx-4" action="/updateprofilguru/{{$user->guru->id}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="edit-nama" class="form-label">Nama</label>
                            <input type="text" name="namaguru" class="form-control" id="edit-nama" value="{{ $user->guru->namaguru }}">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="edit-nip" class="form-label">NIP</label>
                            <input type="text" name="nip" class="form-control" id="edit-nip" value="{{ $user->nisn_nip }}">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="edit-password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="edit-password" placeholder="*DI ISI JIKA INGIN GANTI PASSWORD*">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempatlahir" id="tempatlahir" value="{{$user->guru->tempatlahir}}">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="tanggallahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggallahir" id="tanggallahir" name="tanggallahir" value="{{$user->guru->tanggallahir}}">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" name="jeniskelamin" id="jeniskelamin">
                              <option selected>{{$user->guru->jeniskelamin}}</option>
                              <option value="laki-laki">Laki-laki</option>
                              <option value="perempuan">Perempuan</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" class="form-control" name="foto" id="foto">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <button type="submit" class="btn" style="background-color: #4BBBFA; color: white">Simpan</button>
                          <button type="button" class="btn btn-secondary" onclick="cancelEdit()">Batal</button>
                        </div>
                      </div>
                    </form>   
                  </div>
                </div>
              </div>
            </div>
          </div>

          <style>
            .profile-header {
              display: flex;
              align-items: center;
              margin-bottom: 20px;
            }
            
            .profile-picture {
              margin-right: 20px;
            }
            
            .foto-container {
              width: 100px;
              height: 100px;
              overflow: hidden;
              border-radius: 50%;
            }
            
            .foto-container img {
              width: 100%;
              height: 100%;
              object-fit: cover;
            }
            
            .card-text-container {
              display: grid;
              grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
              grid-gap: 20px;
            }
            
            .card-text {
              background-color: #f9f9f9;
              padding: 10px;
              border-radius: 5px;
            }
            
            .card-text h6 {
              font-weight: bold;
              margin-bottom: 5px;
            }
            
            .btn {
              margin-top: 20px;
            }
          </style>
          <script>
            function editProfile() {
              document.getElementById("profile-info").style.display = "none";
              document.getElementById("edit-form").style.display = "block";
            }
          
            function cancelEdit() {
              document.getElementById("profile-info").style.display = "block";
              document.getElementById("edit-form").style.display = "none";
            }
          </script>
          
@endsection





