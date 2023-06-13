@extends('layouts.adminLayouts')

@section('contentAdmin')
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                  <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                  <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">ini halaman admin</h6>
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
                              {{ Auth::user()->name }}
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
            <div class="row">
              <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                  <div class="card-body p-3">
                    <div class="row">
                      <div class="col-8">
                        <div class="numbers">
                          <p class="text-sm mb-0 text-capitalize font-weight-bold">DATA GURU BK</p>
                          <h5 class="font-weight-bolder mb-0">{{ count($guru) }}</h5>
                        </div>
                      </div>
                      <div class="col-4 text-end">
                        <div class="icon icon-shape shadow text-center border-radius-md" style="background-color: #4BBBFA;">
                          <i class="fa-solid fa-users text-lg opacity-10"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                  <div class="card-body p-3">
                    <div class="row">
                      <div class="col-8">
                        <div class="numbers">
                          <p class="text-sm mb-0 text-capitalize font-weight-bold">DATA WALI KELAS</p>
                          <h5 class="font-weight-bolder mb-0">{{ count($walikelas) }}</h5>
                        </div>
                      </div>
                      <div class="col-4 text-end">
                        <div class="icon icon-shape shadow text-center border-radius-md" style="background-color: #4BBBFA;">
                          <i class="fa-solid fa-users text-lg opacity-10"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                  <div class="card-body p-3">
                    <div class="row">
                      <div class="col-8">
                        <div class="numbers">
                          <p class="text-sm mb-0 text-capitalize font-weight-bold">DATA MURID</p>
                          <h5 class="font-weight-bolder mb-0">{{ count($siswa) }}</h5>
                        </div>
                      </div>
                      <div class="col-4 text-end">
                        <div class="icon icon-shape shadow text-center border-radius-md" style="background-color: #4BBBFA;">
                          <i class="fa-solid fa-users text-lg opacity-10"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6">
                <div class="card">
                  <div class="card-body p-3">
                    <div class="row">
                      <div class="col-8">
                        <div class="numbers">
                          <p class="text-sm mb-0 text-capitalize font-weight-bold">DATA JADWAL</p>
                          <h5 class="font-weight-bolder mb-0">{{ count($jadwal) }}</h5>
                        </div>
                      </div>
                      <div class="col-4 text-end">
                        <div class="icon icon-shape shadow text-center border-radius-md" style="background-color: #4BBBFA;">
                          <i class="fa-solid fa-file-lines text-lg opacity-10"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- isi end -->
          <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
@endsection