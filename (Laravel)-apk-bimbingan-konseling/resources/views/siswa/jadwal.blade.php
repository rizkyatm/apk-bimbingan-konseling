@extends('layouts.siswaLayouts')

@section('contentAdmin')
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
              <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
              <li class="breadcrumb-item text-sm text-dark active" aria-current="page">jadwal Panggilan</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">jadwal Panggilan</h6>
          </nav>
          <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
              <!-- tidak di isi -->
            </div>
            <ul class="navbar-nav  justify-content-end">
              <li class="nav-item d-flex align-items-center position-relative">
                <a href="javascript:;" class="nav-link text-body font-weight-bold px-0" id="signInDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  @if (Auth::check())
                    @if ($user->siswa)
                      <img src="{{ asset('fotosiswa/'.$user->siswa->foto) }}" alt="Profile Picture" class="me-sm-1 rounded-circle" style="width: 32px; height: 32px; object-fit: cover; vertical-align: middle;">
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
      <div class="container-fluid ">
        <div class="col-md-14 mt-4">
            <div class="card">
              <div class="card-header pb-0 px-3 d-flex justify-content-between align-items-center" id="daftar">
                <h4 class="mb-0">Daftar Jadwal Anda</h4>
                <a class="btn btn-primary" id="tambah-jadwal" onclick="tampilkanForm()">Tambah Jadwal</a>
              </div>
              <div class="card-body pt-17 p-3">
                <form id="form-jadwal" action="/siswatambahJadwal" method="POST" style="display: none;">
                  @csrf
                  <div class="form-grou">
                    <label for="layanan" class="form-label">Pilih layanan</label>
                    <select class="form-select" id="layanan" name="layanan_id" onchange="updateForm()">
                        <option value="">-- Pilih Layanan --</option>
                        @foreach ($layanan as $layanan)
                            <option value="{{ $layanan->id }}">{{ $layanan->jenis_layanan }}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group mb-3" id="siswaForm" style="display: none;">
                    <label for="manysiswa">Pilih Siswa:</label>
                    <div class="form-check">
                        @foreach ($siswa as $data)
                            <label class="form-check-label" for="manysiswa_{{ $data->id }}">
                                <input class="form-check-input" type="checkbox" name="manysiswa[]" value="{{ $data->id }}" id="manysiswa_{{ $data->id }}">
                                {{ $data->namasiswa }} ({{$data->kelas->kelas}})
                            </label>
                            <br>
                        @endforeach
                    </div>
                </div>                                    
                  <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal">
                  </div>
                  <div class="mb-3">
                    <label for="waktu" class="form-label">Waktu</label>
                    <input type="time" class="form-control" id="waktu" name="waktu">
                  </div>
                  <div class="mb-3">
                    <label for="tempat" class="form-label">Tempat</label>
                    <input type="text" class="form-control" id="tempat" name="tempat">
                  </div>
                  <button type="submit" class="btn btn-primary">Simpan</button>
                  <button type="button" onclick="kembali()" class="btn btn-secondary">kembali</button>
                </form>                
                <ul class="list-group" id="list-jadwal">
                  @foreach ($jadwalbk as $item)
                  <li i class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                    <div class="d-flex flex-column">
                      <span class="mb-2 text-xs">
                        Status:
                        <span class="p-1 rounded" style="display: inline-block; width: max-content; margin-top: 30px; font-weight: bold; color: white; background-color: {{ ($item->status === 'DIUNDUR') ? 'rgb(255, 250, 0)' : (($item->status === 'MENUNGGU..') ? 'rgb(88, 88, 86)' : (($item->status === 'DITERIMA' || $item->status === 'SELESAI') ? 'rgb(17, 255, 0)' : 'gray')) }};">
                          {{$item->status}}
                        </span>
                      </span>
                      <span class="mb-2 text-xs">Nama Siswa: <span class="text-dark font-weight-bold ms-sm-2">{{$item->siswa->namasiswa}}</span></span>
                      <span class="mb-2 text-xs">Kelas: <span class="text-dark ms-sm-2 font-weight-bold">{{$item->siswa->kelas->kelas}}</span></span>
                      <span class="mb-2 text-xs">Nama Wali Kelas: <span class="text-dark ms-sm-2 font-weight-bold">{{$item->wali_kelas->namagurukelas}}</span></span>
                      <span class="mb-2 text-xs">Bimbingan: <span class="text-dark ms-sm-2 font-weight-bold">{{$item->layanan_bk->jenis_layanan}}</span></span>
                      <span class="mb-2 text-xs">Tempat: <span class="text-dark ms-sm-2 font-weight-bold">{{$item->tempat}}</span></span>
                      <span class="mb-2 text-xs">Waktu: <span class="text-dark ms-sm-2 font-weight-bold">{{$item->waktu}}</span></span>
                    </div>
                  </li>
                @endforeach
                </ul>
              </div> 
            </div>
        </div>
      </div>


      <script>
        function updateForm() {
            var layananId = document.getElementById("layanan").value;
            var siswaForm = document.getElementById("siswaForm");
    
            if (layananId == 2) {
                siswaForm.style.display = "block";
            } else {
                siswaForm.style.display = "none";
            }
        }
    </script>
    
      <script>
        function tampilkanForm() {
          document.getElementById("form-jadwal").style.display = "block";
          document.getElementById("list-jadwal").style.display = "none";
          document.getElementById("tambah-jadwal").style.display = "none";
        }
        function kembali() {
          document.getElementById("form-jadwal").style.display = "none";
          document.getElementById("list-jadwal").style.display = "block";
          document.getElementById("tambah-jadwal").style.display = "block";
        }
      </script>
@endsection