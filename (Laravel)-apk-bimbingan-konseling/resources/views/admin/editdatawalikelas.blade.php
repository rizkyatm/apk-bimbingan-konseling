@extends('layouts.adminLayouts')

@section('contentAdmin')
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                  <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                  <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Edit Wali Kelas</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Edit Wali Kelas</h6>
              </nav>
              <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                  <!-- tidak di isi -->
                </div>
                <ul class="navbar-nav  justify-content-end">
                  <li class="nav-item d-flex align-items-center position-relative">
                    <a href="javascript:;" class="nav-link text-body font-weight-bold px-0" id="signInDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fa fa-user me-sm-1"></i>
                      <span class="d-sm-inline d-none">
                        @if (Auth::check())
                            <span class="d-sm-inline d-none">
                                {{ Auth::user()->name }}
                            </span>
                        @endif
                      </span>
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
            <div class="row">
              <div class="col-12">
                <div class="card mb-4">
                  <div class="card-header pb-0 d-flex align-items-center">
                    <h6 class="flex-grow-1">Form Edit Wali Kelas</h6>
                  </div>
                  <div class="card-body px-4 pt-2 pb-2">
                    <form action="/updateDatawalikelas/{{$data->id}}" method="POST" enctype="multipart/form-data" >
                        @csrf
                        <div class="row mb-3">
                          <div class="col-md-6">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="namagurukelas" id="namagurukelas" value="{{$data->namagurukelas}}">
                          </div>
                          <div class="col-md-6">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" class="form-control" name="foto" id="foto">
                          </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                              <label for="nip" class="form-label">NIP</label>
                              <input type="text" class="form-control" name="nip" id="nip" value="{{$data->user->nisn_nip}}">
                            </div>
                            <div class="col-md-6">
                              <label for="password" class="form-label">Password</label>
                              <input type="password" class="form-control" value="{{$data->user->password}}" readonly>
                              <span style="color: red; font-size: 12px; position: absolute;">*password hanya bisa di ubah oleh pemilik Akun*</span>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" name="jeniskelamin" id="jeniskelamin">
                                  <option selected>{{$data->jeniskelamin}}</option>
                                  <option value="laki-laki">Laki-laki</option>
                                  <option value="perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                              <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                              <input type="text" class="form-control" name="tempatlahir" id="tempatlahir" value="{{$data->tempatlahir}}">
                            </div>
                          </div>
                          
                        <div class="row mb-3">
                            <div class="col-md-12">
                              <label for="tanggallahir" class="form-label">Tanggal Lahir</label>
                              <input type="date" class="form-control" name="tanggallahir" id="tanggallahir" name="tanggallahir" value="{{$data->tanggallahir}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                        </div>
                        <button type="submit" class="btn" style="background-color: #4BBBFA; color: white">Simpan</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>            
@endsection