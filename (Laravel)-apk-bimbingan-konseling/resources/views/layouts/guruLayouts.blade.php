<!--
=========================================================
* Soft UI Dashboard - v1.0.7
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2023 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/logo-ct-dark.png">
  <title>
    TBCounseling - Guru Bk
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="g-sidenav-show" style="background-color: #F9FBFF;">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/soft-ui-dashboard/pages/dashboard.html " target="_blank">
        <img src="../assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">TBCounseling</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse h-auto  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link{{ Request::is('guru*') ? ' active' : '' }}" href="/guru">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                <path class="{{ Request::is('guru*') ? 'text-white' : 'text-custom' }}" style="color: {{ Request::is('guru*') ? '#FFFFFF' : '#3A416F' }}" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
              </svg>
            </div>
            <span class="nav-link-text ms-1">Profil Guru</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link{{ Request::is('akunSiswa*') ? ' active' : '' }}  " href="/akunSiswa">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <title>Classroom</title>
                <path class="{{ Request::is('akunSiswa*') ? 'text-white' : 'text-custom' }}" style="color: {{ Request::is('akunSiswa*') ? '#FFFFFF' : '#3A416F' }}" d="M1.6367 1.6367C.7322 1.6367 0 2.369 0 3.2734v17.4532c0 .9045.7322 1.6367 1.6367 1.6367h20.7266c.9045 0 1.6367-.7322 1.6367-1.6367V3.2734c0-.9045-.7322-1.6367-1.6367-1.6367H1.6367zm.545 2.1817h19.6367v16.3632h-2.7266v-1.0898h-4.9102v1.0898h-12V3.8184zM12 8.1816c-.9046 0-1.6367.7322-1.6367 1.6368 0 .9045.7321 1.6367 1.6367 1.6367.9046 0 1.6367-.7322 1.6367-1.6367 0-.9046-.7321-1.6368-1.6367-1.6368zm-4.3633 1.9102c-.6773 0-1.2285.5493-1.2285 1.2266 0 .6772.5512 1.2265 1.2285 1.2265.6773 0 1.2266-.5493 1.2266-1.2265 0-.6773-.5493-1.2266-1.2266-1.2266zm8.7266 0c-.6773 0-1.2266.5493-1.2266 1.2266 0 .6772.5493 1.2265 1.2266 1.2265.6773 0 1.2285-.5493 1.2285-1.2265 0-.6773-.5512-1.2266-1.2285-1.2266zM12 12.5449c-1.179 0-2.4128.4012-3.1484 1.0059-.384-.1198-.8043-.1875-1.2149-.1875-1.3136 0-2.7285.695-2.7285 1.5586v.8965h14.1836v-.8965c0-.8637-1.4149-1.5586-2.7285-1.5586-.4106 0-.831.0677-1.2149.1875-.7356-.6047-1.9694-1.0059-3.1484-1.0059Z"/>
              </svg>
            </div>
            <span class="nav-link-text ms-1">Kelas Siswa</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link{{ Request::is('buatJadwal*') ? ' active' : '' }}" href="/buatJadwal">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar2-plus-fill" viewBox="0 0 16 16"> 
                <path  class="{{ Request::is('buatJadwal*') ? 'text-white' : 'text-custom' }}" style="color: {{ Request::is('buatJadwal*') ? '#FFFFFF' : '#3A416F' }}" d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 3.5v1c0 .276.244.5.545.5h10.91c.3 0 .545-.224.545-.5v-1c0-.276-.244-.5-.546-.5H2.545c-.3 0-.545.224-.545.5zm6.5 5a.5.5 0 0 0-1 0V10H6a.5.5 0 0 0 0 1h1.5v1.5a.5.5 0 0 0 1 0V11H10a.5.5 0 0 0 0-1H8.5V8.5z"/> 
              </svg>
            </div>
            <span class="nav-link-text ms-1">Jadwal Panggilan</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('history*') ? ' active' : '' }}  " href="/history">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"> 
                <g> 
                  <path fill="none" d="M0 0h24v24H0z"/> 
                  <path class="{{ Request::is('history*') ? 'text-white' : 'text-custom' }}" style="color: {{ Request::is('history*') ? '#FFFFFF' : '#3A416F' }}" d="M4 3h16l2 4v13a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V7.004L4 3zm9 11v-4h-2v4H8l4 4 4-4h-3zm6.764-7l-1-2H5.237l-1 2h15.527z"/> 
                </g> 
              </svg>
            </div>
            <span class="nav-link-text ms-1">Archives</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('petakerawanan*') ? ' active' : '' }}  " href="/petakerawananguru">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"> 
                <g> 
                  <path fill="none" d="M0 0h24v24H0z"/> 
                  <path class="{{ Request::is('history*') ? 'text-white' : 'text-custom' }}" style="color: {{ Request::is('petakerawanan*') ? '#FFFFFF' : '#3A416F' }}" d="M4 3h16l2 4v13a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V7.004L4 3zm9 11v-4h-2v4H8l4 4 4-4h-3zm6.764-7l-1-2H5.237l-1 2h15.527z"/> 
                </g> 
              </svg>
            </div>
            <span class="nav-link-text ms-1">Peta Kerawanan</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @yield('contentAdmin')
  </main>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>

  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
</body>

</html>