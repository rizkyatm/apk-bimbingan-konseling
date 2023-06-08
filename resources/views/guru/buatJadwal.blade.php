@extends('layouts.guruLayouts')

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
      <div class="container-fluid ">
        <div class="col-md-14 mt-4">
            <div class="card" id="list-jadwal">
              <div class="card-header pb-0 px-3 d-flex justify-content-between align-items-center" id="daftar">
                <h6 class="mb-0">Daftar Jadwal</h6>
                <a class="btn btn-primary" id="tambah-jadwal">Tambah Jadwal</a>
              </div>
              
              <div class="card-body pt-4 p-3">
                <ul class="list-group" id="list-jadwal">
                  <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                    <div class="d-flex flex-column">
                      <h6 class="mb-3 text-sm">Lucas Harper</h6>
                      <span class="mb-2 text-xs">Company Name: <span class="text-dark font-weight-bold ms-sm-2">Stone Tech Zone</span></span>
                      <span class="mb-2 text-xs">Email Address: <span class="text-dark ms-sm-2 font-weight-bold">lucas@stone-tech.com</span></span>
                      <span class="text-xs">VAT Number: <span class="text-dark ms-sm-2 font-weight-bold">FRB1235476</span></span>
                    </div>
                    <div class="ms-auto text-end">
                      <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i class="far fa-trash-alt me-2"></i>Delete</a>
                      <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                    </div>
                  </li>
                  <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                    <div class="d-flex flex-column">
                      <h6 class="mb-3 text-sm">Ethan James</h6>
                      <span class="mb-2 text-xs">Company Name: <span class="text-dark font-weight-bold ms-sm-2">Fiber Notion</span></span>
                      <span class="mb-2 text-xs">Email Address: <span class="text-dark ms-sm-2 font-weight-bold">ethan@fiber.com</span></span>
                      <span class="text-xs">VAT Number: <span class="text-dark ms-sm-2 font-weight-bold">FRB1235476</span></span>
                    </div>
                    <div class="ms-auto text-end">
                      <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i class="far fa-trash-alt me-2"></i>Delete</a>
                      <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                    </div>
                  </li>
                </ul>
              </div>  
            </div>

            <div class="card" id="form-jadwal" style="display: none;">
              <div class="card-header pb-0 px-3 d-flex justify-content-between align-items-center" id="daftar">
                <h6 class="mb-0">Tambah Jadwal</h6>
              </div>
              <div class="p-3">
                  <form action="/tambahjadwal" method="POST">
                    @csrf
                    <!-- Form Jadwal -->
                    <div class="mb-3">
                      <label for="kelas" class="form-label">Pilih Kelas</label>
                      <select class="form-select" id="kelas" name="kelas_id">
                        <option value="">-- Pilih Kelas --</option>
                        <!-- Tambahkan opsi kelas di sini -->
                        @foreach ($kelas as $data)
                          <option value="{{$data->id}}">{{$data->kelas}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="siswa" class="form-label">Pilih Siswa</label>
                      <select class="form-select" id="siswa" name="siswa_id">
                        <option value="">-- Pilih Siswa --</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="layanan" class="form-label">Pilih layanan</label>
                      <select class="form-select" id="layanan" name="layanan_id">
                        <option value="">-- Pilih Layanan --</option>
                        @foreach ($layanan as $layanan)
                          <option value="{{$layanan->id}}">{{$layanan->jenis_layanan}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="tanggal" class="form-label">Tanggal</label>
                      <input type="date" class="form-control" id="tanggal" name="tanggal">
                    </div>
                    <div class="mb-3">
                      <label for="waktu" class="form-label">Waktu</label>
                      <input type="time" class="form-control" id="waktu" name="wkatu">
                    </div>
                    <div class="mb-3">
                      <label for="tempat" class="form-label">Tempat</label>
                      <input type="text" class="form-control" id="tempat" name="tempat">
                    </div>
                    <div class="">
                      <button type="submit" class="btn btn-primary">Buat Jadwal</button>
                      <button type="button" class="btn btn-secondary" id="kembali">Kembali</button>
                    </div>
                  </form>
              </div>        
            </div>
        </div>
      </div>

      <script>
        // Mendengarkan perubahan pada elemen select kelas
        document.getElementById('kelas').addEventListener('change', function() {
          var kelasId = this.value; // Mendapatkan nilai kelas yang dipilih
          var siswaSelect = document.getElementById('siswa'); // Mendapatkan elemen select siswa

          // Menghapus semua opsi siswa sebelumnya
          siswaSelect.innerHTML = '';
    
          // Memperbarui opsi siswa berdasarkan kelas yang dipilih
          if (kelasId !== '') {
            getSiswaByKelas(kelasId)
              .then(function(siswaList) {
                // Menambahkan opsi siswa ke elemen select
                for (var i = 0; i < siswaList.length; i++) {
                  var siswa = siswaList[i];
                  var option = document.createElement('option');
                  option.value = siswa.id;
                  option.text = siswa.namasiswa;
                  siswaSelect.appendChild(option);
                }
              })
              .catch(function(error) {
                console.error('Error:', error);
              });
          }
        });
    
        // Metode untuk mendapatkan daftar siswa berdasarkan kelasId
        function getSiswaByKelas(kelasId) {
          return new Promise(function(resolve, reject) {
            // Mendapatkan token CSRF dari meta tag di halaman
            var token = $('meta[name="csrf-token"]').attr('content');
    
            $.ajax({
              url: '/getdatasiswa',
              method: 'POST',
              data: {
                _token: token, // Menambahkan token CSRF ke data
                kelasId: kelasId
              },
              success: function(response) {
                resolve(response);
              },
              error: function(xhr, status, error) {
                reject(error);
              }
            });
          });
        }
      </script>

      <script>
        document.getElementById('tambah-jadwal').addEventListener('click', function() {
          document.getElementById('form-jadwal').style.display = 'block';
          document.getElementById('list-jadwal').style.display = 'none';
        });
      
        document.getElementById('kembali').addEventListener('click', function() {
          document.getElementById('form-jadwal').style.display = 'none';
          document.getElementById('list-jadwal').style.display = 'block';
        });
      </script>
@endsection