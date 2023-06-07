@extends('layouts.adminLayouts')

@section('contentAdmin')
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                  <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                  <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Data Wali kelas</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Data Wali kelas</h6>
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
                    <h6 class="flex-grow-1">Daftar Wali Kelas</h6>
                    <a href="/tambahdatawalikelas" class="btn" style="background-color: #515CED; color: white">Tambah wali kelas</a>
                  </div>
                  <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                      <table class="table align-items-center mb-0">
                        <thead>
                          <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NAMA</th>
                            <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nip</th>
                            <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TEMPAT & TANGGAL LAHIR</th>
                            <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">JENISKELAMIN</th>
                            <th class="text-secondary opacity-7"></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($data as $walikelas)
                          <tr>
                            <td style="padding-left: 20px;">
                              <div class="d-flex align-items-center">
                                <img src="{{asset('fotowalikelas/'.$walikelas->foto)}}" class="avatar avatar-sm me-3" alt="user1">
                                <div>
                                  <h6 class="mb-0 text-sm">{{$walikelas->namagurukelas}}</h6>
                                  <p class="text-xs text-secondary mb-0"></p>
                                </div>
                              </div>
                            </td>
                            <td style="padding-left: 20px;" class="align-middle">
                              <h6 class="mb-0 text-sm text-start">{{$walikelas->user->nisn_nip}}</h6>
                            </td>
                            <td style="padding-left: 20px;" class="align-middle text-start">
                              <div class="d-flex flex-column align-items-start">
                                <p class="text-xs font-weight-bold mb-0">{{$walikelas->tempatlahir}}</p>
                                <p class="text-xs text-secondary mb-0">{{$walikelas->tanggallahir}}</p>
                              </div>
                            </td>                           
                            <td style="padding-left: 20px;" class="align-middle text-start">
                              <span class="text-secondary text-xs font-weight-bold">{{$walikelas->jeniskelamin}}</span>
                            </td>
                            <td class="align-middle">
                              <a href="/tampilkandatawalikelas/{{$walikelas->id}}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                <i class="fas fa-edit fa-lg"></i>
                              </a>
                              <a href="/deletedatawalikelas/{{$walikelas->id}}" class="text-danger font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Delete user">
                                <i class="fas fa-trash-alt fa-lg"></i>
                              </a>
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
@endsection