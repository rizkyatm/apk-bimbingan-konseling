@extends('layouts.walasLayouts')

@section('contentAdmin')
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                  <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                  <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Data Peta Kerawanan</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Data Peta Kerawanan</h6>
              </nav>
              <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                  <!-- tidak di isi -->
                </div>
                <ul class="navbar-nav  justify-content-end">
                  <li class="nav-item d-flex align-items-center position-relative">
                    <a href="javascript:;" class="nav-link text-body font-weight-bold px-0" id="signInDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      @if (Auth::check())
                        @if ($user->walikelas)
                          <img src="{{ asset('fotowalikelas/'.$user->walikelas->foto) }}" alt="Profile Picture" class="me-sm-1 rounded-circle" style="width: 32px; height: 32px; object-fit: cover; vertical-align: middle;">
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
            <div class="row">
              <div class="col-12">
                <div class="card mb-4" style="min-height: 500px;">
                  <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                      <div class="container">
                        <div style="padding: 10px; margin-top: 10px">
                          <div style="background-color: #f5f5f5; border-bottom: none; padding: 10px; display: flex; justify-content: space-between; align-items: center;">
                            <h6 style="margin: 0; font-size: 18px; color: #333;">Daftar Peta Kerawanan</h6>
                          </div>
                          @if (session('success'))
                            <div class="alert alert-success"  style="border-width: 1px; height: 20px; font-weight: bold; color: #f5f5f5;  display: flex; align-items: center;">
                                {{ session('success') }}
                            </div>
                           @endif                          
                          <div style="padding: 10px;">
                            <p style="margin-bottom: 5px; font-size: 14px; color: #555;">Nama : {{$siswa->namasiswa}}</p>
                            <p style="margin-bottom: 5px; font-size: 14px; color: #555;">NISN : {{$siswa->user->nisn_nip}}</p>
                            <p style="margin-bottom: 5px; font-size: 14px; color: #555;">Kelas : {{$siswa->kelas->kelas}}</p>
                            <p style="margin-bottom: 5px; font-size: 14px; color: #555;">Guru BK : {{$siswa->kelas->guru->namaguru}}</p>
                            <p style="margin-bottom: 5px; font-size: 14px; color: #555;">Wali Kelas : {{$siswa->kelas->walikelas->namagurukelas}}</p>
                          </div>
                        </div>                        
                        <form action="/tambahKerawanansiswa/{{$siswa->id}}" method="POST" style="padding: 0 20px 0 20px">
                          @csrf
                          <div class="form-check mb-3" >
                            <div class="row">
                              <div class="col-md-3">
                                <input class="form-check-input" type="checkbox" name="1" value="1" id="petakerawanan_1" {{ $petakerawanan->whereNotNull('kolom1')->count() > 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="petakerawanan_1">Sering Sakit</label><br>
                              </div>
                              <div class="col-md-3">
                                <input class="form-check-input" type="checkbox" name="2" value="2" id="petakerawanan_2" {{ $petakerawanan->whereNotNull('kolom2')->count() > 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="petakerawanan_2">Sering Izin</label><br>
                              </div>
                              <div class="col-md-3">
                                <input class="form-check-input" type="checkbox" name="3" value="3" id="petakerawanan_3" {{ $petakerawanan->whereNotNull('kolom3')->count() > 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="petakerawanan_3">Sering Alpa</label><br>
                              </div>
                              <div class="col-md-3">
                                <input class="form-check-input" type="checkbox" name="4" value="4" id="petakerawanan_4" {{ $petakerawanan->whereNotNull('kolom4')->count() > 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="petakerawanan_4">Sering Terlambat</label><br>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-3">
                                <input class="form-check-input" type="checkbox" name="5" value="5" id="petakerawanan_5" {{ $petakerawanan->whereNotNull('kolom5')->count() > 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="petakerawanan_5">Bolos</label><br>
                              </div>
                              <div class="col-md-3">
                                <input class="form-check-input" type="checkbox" name="6" value="6" id="petakerawanan_6" {{ $petakerawanan->whereNotNull('kolom6')->count() > 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="petakerawanan_6">Kelainan Jasmani</label><br>
                              </div>
                              <div class="col-md-3">
                                <input class="form-check-input" type="checkbox" name="7" value="7" id="petakerawanan_7" {{ $petakerawanan->whereNotNull('kolom7')->count() > 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="petakerawanan_7">Minat Belajar Berkurang</label><br>
                              </div>
                              <div class="col-md-3">
                                <input class="form-check-input" type="checkbox" name="8" value="8" id="petakerawanan_8" {{ $petakerawanan->whereNotNull('kolom8')->count() > 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="petakerawanan_8">Tidak Mengerjakan Tugas</label><br>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-3">
                                <input class="form-check-input" type="checkbox" name="9" value="9" id="petakerawanan_9" {{ $petakerawanan->whereNotNull('kolom9')->count() > 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="petakerawanan_9">Melanggar Aturan</label><br>
                              </div>
                              <div class="col-md-3">
                                <input class="form-check-input" type="checkbox" name="10" value="10" id="petakerawanan_10" {{ $petakerawanan->whereNotNull('kolom10')->count() > 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="petakerawanan_10">Sering Bercanda</label><br>
                              </div>
                              <div class="col-md-3">
                                <input class="form-check-input" type="checkbox" name="11" value="11" id="petakerawanan_11" {{ $petakerawanan->whereNotNull('kolom11')->count() > 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="petakerawanan_11">Perilaku Konfrontatif</label><br>
                              </div>
                              <div class="col-md-3">
                                <input class="form-check-input" type="checkbox" name="12" value="12" id="petakerawanan_12" {{ $petakerawanan->whereNotNull('kolom12')->count() > 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="petakerawanan_12">Sering Berkelahi</label><br>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-3">
                                <input class="form-check-input" type="checkbox" name="13" value="13" id="petakerawanan_13" {{ $petakerawanan->whereNotNull('kolom13')->count() > 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="petakerawanan_13">Memiliki Gangguan Emosi</label><br>
                              </div>
                              <div class="col-md-3">
                                <input class="form-check-input" type="checkbox" name="14" value="14" id="petakerawanan_14" {{ $petakerawanan->whereNotNull('kolom14')->count() > 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="petakerawanan_14">Kehilangan Orang Tua</label><br>
                              </div>
                              <div class="col-md-3">
                                <input class="form-check-input" type="checkbox" name="15" value="15" id="petakerawanan_15" {{ $petakerawanan->whereNotNull('kolom15')->count() > 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="petakerawanan_15">Mengalami Trauma</label><br>
                              </div>
                              <div class="col-md-3">
                                <input class="form-check-input" type="checkbox" name="16" value="16" id="petakerawanan_16" {{ $petakerawanan->whereNotNull('kolom16')->count() > 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="petakerawanan_16">Sering Mencuri</label><br>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-3">
                                <input class="form-check-input" type="checkbox" name="17" value="17" id="petakerawanan_17" {{ $petakerawanan->whereNotNull('kolom17')->count() > 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="petakerawanan_17">Keterbatasan Fisik</label><br>
                              </div>
                              <div class="col-md-3">
                                <input class="form-check-input" type="checkbox" name="18" value="18" id="petakerawanan_18" {{ $petakerawanan->whereNotNull('kolom18')->count() > 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="petakerawanan_18">Gangguan Pendengaran</label><br>
                              </div>
                              <div class="col-md-3">
                                <input class="form-check-input" type="checkbox" name="19" value="19" id="petakerawanan_19" {{ $petakerawanan->whereNotNull('kolom19')->count() > 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="petakerawanan_19">Gangguan Penglihatan</label><br>
                              </div>
                              <div class="col-md-3">
                                <input class="form-check-input" type="checkbox" name="20" value="20" id="petakerawanan_20" {{ $petakerawanan->whereNotNull('kolom20')->count() > 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="petakerawanan_20">Gangguan Motorik</label><br>
                              </div>
                            </div>
                          </div>
                          
                          <button type="submit" class="btn btn-primary">Save</button>
                          <a href="/petakerawananwalas" class="btn btn-primary">Kembali</a>
                        </form>
                      </div>                                     
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection