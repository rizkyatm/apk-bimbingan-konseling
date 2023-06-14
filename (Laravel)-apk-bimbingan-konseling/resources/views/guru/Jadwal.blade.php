@extends('layouts.guruLayouts')

@section('contentAdmin')
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
              <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
              <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Jadwal Panggilan</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Jadwal Panggilan</h6>
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
      <div class="container-fluid">
        <div class="col-md-14 mt-4">
          <div class="card" id="list-jadwal">
            <div class="card-header pb-0 px-3 d-flex justify-content-between align-items-center" id="daftar">
              <h6 class="mb-0">Daftar Jadwal</h6>
              <a class="btn btn-primary" id="tambah-jadwal">Tambah Jadwal</a>
            </div>
            <div class="card-body pt-4 p-3">
              <ul class="list-group" id="list-jadwal">
                @foreach ($jadwalbk as $item)
                <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <span class="mb-2 text-xs">
                      Status:
                      <span class="p-1 rounded" style="display: inline-block; width: max-content; margin-top: 30px; font-weight: bold; color: white; background-color: {{ ($item->status === 'DIUNDUR') ? 'rgb(255, 250, 0)' : (($item->status === 'MENUNGGU..') ? 'rgb(88, 88, 86)' : (($item->status === 'DITERIMA' || $item->status === 'SELESAI') ? 'rgb(17, 255, 0)' : 'gray')) }};">
                        {{ $item->status }}
                      </span>
                    </span>
                    <span class="mb-2 text-xs">Nama Siswa: <span class="text-dark font-weight-bold ms-sm-2">{{ $item->siswa->namasiswa }}</span></span>
                    <span class="mb-2 text-xs">Kelas: <span class="text-dark ms-sm-2 font-weight-bold">{{ $item->siswa->kelas->kelas }}</span></span>
                    <span class="mb-2 text-xs">Nama Wali Kelas: <span class="text-dark ms-sm-2 font-weight-bold">{{ $item->wali_kelas->namagurukelas }}</span></span>
                    <span class="mb-2 text-xs">Bimbingan: <span class="text-dark ms-sm-2 font-weight-bold">{{ $item->layanan_bk->jenis_layanan }}</span></span>
                    <span class="mb-2 text-xs">Tempat: <span class="text-dark ms-sm-2 font-weight-bold">{{ $item->tempat }}</span></span>
                    <span class="mb-2 text-xs">Waktu: <span class="text-dark ms-sm-2 font-weight-bold">{{ $item->waktu }}</span></span>
                  </div>
                  <div class="ms-auto text-center" style="display: flex; flex-direction: column; justify-content: center;">
                    @if ($item->status === 'DITERIMA' || $item->status === 'DIUNDUR')
                      <a class="btn btn-link text-dark px-3 mb-2" onclick="showFinishForm({{ $item->id }})">
                        <i class="fas fa-check-circle me-2" aria-hidden="true"></i>Selesai
                      </a>
                    @endif
                    @if ($item->status === 'MENUNGGU..')
                      <a class="btn btn-link text-dark px-3 mb-2" onclick="formAcc({{ $item->id }}, '{{ $item->tempat }}')">
                        <i class="fas fa-check text-success me-2" aria-hidden="true"></i>Terima
                      </a>
                      <a class="btn btn-link text-dark px-3 mb-2" onclick="formundurjadwal({{ $item->id }}, '{{ $item->waktu }}'); return false;">
                        <i class="fas fa-clock text-warning me-2" aria-hidden="true"></i>Diundur
                      </a>
                    @endif
                  </div>
                </li>
                <div id="finish-form-{{ $item->id }}" style="display: none;">
                  <form action="/Guru/SelesaikanJadwal/{{ $item->id }}" method="POST" class="d-inline" style="vertical-align: middle;">
                    @csrf
                    <div class="form-group" style="display: flex; align-items: center;">
                      <label style="margin-right: 10px;">Hasil Konseling:</label>
                      <textarea placeholder="Masukan Hasil Konseling Dengan Siswa" name="hasil_konseling" id="hasil_konseling-{{ $item->id }}" class="form-control" style="margin-right: 10px;"></textarea>
                      <input type="submit" value="Selesai" class="btn btn-primary" style="margin-bottom: 0px;margin-right: 10px;">
                      <input type="button" value="back" class="btn btn-primary" onclick="hideFinishForm({{ $item->id }})" style="margin-bottom: 0px">
                    </div>
                  </form>
                </div>
                <div id="accept-form-{{ $item->id }}" style="display: none;">
                  <form action="/Guru/TerimaJadwal/{{ $item->id }}" method="POST" class="d-inline" style="vertical-align: middle;">
                    @csrf
                    <div class="form-group" style="display: flex; align-items: center;">
                      <label for="tempat-{{ $item->id }}" style="margin-right: 10px;">Tempat:</label>
                      <input type="text" name="tempat" id="tempat-{{ $item->id }}" class="form-control" style="margin-right: 10px;">
                      <input type="submit" value="Terima" class="btn btn-primary" style="margin-bottom: 0px;margin-right: 10px;">
                      <input type="button" value="back" class="btn btn-primary" onclick="hideAcceptForm({{ $item->id }})" style="margin-bottom: 0px">
                    </div>
                  </form>
                </div>
                <div id="reschedule-form-{{ $item->id }}" style="display: none;">
                  <form action="/Guru/MundurkanJadwal/{{ $item->id }}" method="POST" class="d-inline" style="vertical-align: middle;">
                    @csrf
                    <div class="form-group" style="display: flex; align-items: center;">
                      <label for="tanggal-{{ $item->id }}" style="margin-right: 10px;">Tanggal:</label>
                      <input type="date" name="tanggal" id="tanggal-{{ $item->id }}" class="form-control" style="margin-right: 10px;">
                      <label for="jam-{{ $item->id }}" style="margin-right: 10px;">Jam:</label>
                      <input type="time" name="jam" id="jam-{{ $item->id }}" class="form-control" style="margin-right: 10px;">
                      <input type="submit" value="Undur" class="btn btn-primary" style="margin-bottom: 0px;margin-right: 10px;">
                      <input type="button" value="back" class="btn btn-primary" onclick="hideRescheduleForm({{ $item->id }})" style="margin-bottom: 0px">
                    </div>
                  </form>
                </div>
              @endforeach
              </ul>
            </div>
          </div>
      
          <div class="card" id="form-jadwal" style="display: none;">
            <div class="card-header pb-0 px-3 d-flex justify-content-between align-items-center" id="daftar">
              <h6 class="mb-0">Tambah Jadwal</h6>
            </div>
            <div class="p-3">
              <form action="/Guru/tambahjadwal" method="POST">
                @csrf
                <!-- Form Jadwal -->
                <div class="mb-3">
                  <label for="layanan" class="form-label">Pilih layanan</label>
                  <select class="form-select" id="layanan" name="layanan_id">
                    <option value="">-- Pilih Layanan --</option>
                    @foreach ($layanan as $layanan)
                      <option value="{{ $layanan->id }}">{{ $layanan->jenis_layanan }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="mb-3" id="kelasInputContainer">
                  <label for="kelas" class="form-label">Pilih Kelas</label>
                  <select class="form-select" id="kelas" name="kelas_id">
                    <option value="">-- Pilih Kelas --</option>
                    <!-- Tambahkan opsi kelas di sini -->
                    @foreach ($kelas as $data)
                      <option value="{{ $data->id }}">{{ $data->kelas }}</option>
                    @endforeach
                  </select>
                </div>
                <div id="siswaInputContainer" style="display: none;">
                  <div id="siswaMultipleInput" style="display: none;">
                    <div class="mb-3">
                      <label class="form-label">Pilih Siswa</label>
                      <div class="form-check">
                        @foreach ($siswa as $data)
                          <label class="form-check-label" for="siswa_{{ $data->id }}">
                            <input class="form-check-input" type="checkbox" name="manysiswa_id[]" value="{{ $data->id }}" id="siswa_{{ $data->id }}">
                            {{ $data->namasiswa }} ({{$data->kelas->kelas}})
                          </label>
                          <br>
                        @endforeach
                      </div>
                    </div>
                  </div>
                  <div id="siswaSingleInput" style="display: block;">
                    <div class="mb-3">
                      <label for="siswa" class="form-label">Pilih Siswa</label>
                      <select class="form-select" id="siswa" name="siswa_id">
                        <option value="">-- Pilih Siswa --</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="tanggal" class="form-label">Tanggal</label>
                  <input type="date" class="form-control" id="tanggal" name="tanggal">
                </div>
                <div class="mb-3">
                  <label for="jam" class="form-label">Jam</label>
                  <input type="time" class="form-control" id="waktu" name="waktu">
                </div>
                <div class="mb-3">
                  <label for="tempat" class="form-label">Tempat</label>
                  <input type="text" class="form-control" id="tempat" name="tempat">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      

      {{-- digunakan untuk mengambil datasiswa saat memilih kelas --}}
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
        // Fungsi untuk menampilkan atau menyembunyikan input siswa berdasarkan pilihan layanan
        function toggleSiswaInput() {
          var layananSelect = document.getElementById('layanan');
          var siswaInputContainer = document.getElementById('siswaInputContainer');
          var siswaMultipleInput = document.getElementById('siswaMultipleInput');
          var kelasInputContainer = document.getElementById('kelasInputContainer');
          var siswaSingleInput = document.getElementById('siswaSingleInput');
          var selectedLayanan = layananSelect.value;

          if (selectedLayanan === '2') { // Ubah '2' sesuai dengan value yang sesuai dengan Bimbingan Sosial
            siswaInputContainer.style.display = 'block';
            siswaMultipleInput.style.display = 'block';
            siswaSingleInput.style.display = 'none';
            kelasInputContainer.style.display = 'none';
          } else {
            siswaInputContainer.style.display = 'block';
            siswaMultipleInput.style.display = 'none';
            siswaSingleInput.style.display = 'block';
            kelasInputContainer.style.display = 'block';
          }
        }

        // Panggil fungsi toggleSiswaInput saat halaman dimuat ulang
        window.addEventListener('load', toggleSiswaInput);

        // Panggil fungsi toggleSiswaInput saat pilihan layanan berubah
        var layananSelect = document.getElementById('layanan');
        layananSelect.addEventListener('change', toggleSiswaInput);
      </script>


      {{-- UNDUR JADWAL --}}
      <script>
        // {{-- digunakan untuk mengambil value dan masukannya ke dalam form (UNDUR)--}}
        function formundurjadwal(itemId, waktu) {
          // Memisahkan tanggal dan jam dari waktu
          var dateTimeParts = waktu.split(' ');
          var tanggal = dateTimeParts[0];
          var jam = dateTimeParts[1];

          // Mengisi nilai tanggal dan jam ke dalam input form
          document.getElementById('tanggal-' + itemId).value = tanggal;
          document.getElementById('jam-' + itemId).value = jam;

          // Menampilkan formulir reschedule yang sesuai dengan item yang dipilih
          var formId = 'reschedule-form-' + itemId;
          var formElement = document.getElementById(formId);
          formElement.style.display = 'block';
        }
        
        // {{-- form undur jadwal akan display none jika tombol back di pencet--}}
        function hideRescheduleForm(itemId) {
          var formId = 'reschedule-form-' + itemId;
          var formElement = document.getElementById(formId);
          formElement.style.display = 'none';
        }

      </script>

      {{-- TERIMA JADWAL --}}
      <script>
        // {{-- digunakan untuk mengambil value dan masukannya ke dalam form (TERIMA)--}}
        function formAcc(itemId, tempat) {
          // Mengisi nilai tempat ke dalam input form
          document.getElementById('tempat-' + itemId).value = tempat;

          // Menampilkan formulir penerimaan yang sesuai dengan item yang dipilih
          var formId = 'accept-form-' + itemId;
          var formElement = document.getElementById(formId);
          formElement.style.display = 'block';
        }

        // {{-- form undur jadwal akan display none jika tombol back di pencet--}}
        function hideAcceptForm(itemId) {
          var formId = 'accept-form-' + itemId;
          var formElement = document.getElementById(formId);
          formElement.style.display = 'none';
        }
      </script>

      {{-- SELESAI --}}
      <script>
        // {{-- digunakan untuk mengambil value dan masukannya ke dalam form (SELESAI)--}}
        function showFinishForm(itemId) {
          // Menampilkan formulir selesai yang sesuai dengan item yang dipilih
          var formId = 'finish-form-' + itemId;
          var formElement = document.getElementById(formId);
          formElement.style.display = 'block';
        }

        // {{-- form undur jadwal akan display none jika tombol back di pencet--}}
        function hideFinishForm(itemId) {
          var formId = 'finish-form-' + itemId;
          var formElement = document.getElementById(formId);
          formElement.style.display = 'none';
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