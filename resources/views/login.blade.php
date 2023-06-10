<!DOCTYPE html>
<html>
<head>
	<title>Login Starbhak Counseling</title>

	<!-- Favicons -->
	<link href="assets-login/img/logo.jpeg" rel="icon">

	<link rel="stylesheet" type="text/css" href="assets-login/css/style.css">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<!-- CSS Files -->
	<link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />

	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<div class="container" style="margin-left: 65px;">
		<div class="img">
			<img src="assets-login/img/bg.png" class="img-fluid animated">
		</div>
		<div class="login-content">
			<form action="{{route('postlogin')}}" method="POST">
				{{ csrf_field() }}
				<h1 class="title">Welcome!</h1>
        <p>Unlock your path to success by entering your login details.</p>
          <div class="input-div one">
           	<div class="i">
           		<i class="fas fa-user"></i>
           	</div>
           	<div class="div">
           		<h5>Username</h5>
           		<input type="text" class="input" name="nisn_nip" style="font-size: 14px; color: #018CDA;">
           	</div>
          </div>
          <div class="input-div pass">
           	<div class="i"> 
           	 	<i class="fas fa-lock"></i>
           	</div>
           	<div class="div">
           	 	<h5>Password</h5>
           	 	<input type="password" class="input" name="password" id="password" style="font-size: 14px; color: #018CDA;">
            </div>
          </div>
					<div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="showPassword" name="showPassword">
            <label class="form-check-label" for="showPassword">Show Password</label>
          </div>
					@if (session('error'))
            <div class="alert alert-danger" style="color: white; height: 30px; display: flex; align-items: center; justify-content: center;">
              @if (session('error') === 'Password salah.')
                Password Salah.
              @else
                NISN/NIP Salah.
              @endif
            </div>
          @endif
          <input type="submit" class="btn" value="Login" style="color: #fff;">
      </form>
    </div>
  </div>
	<script>
    const showPasswordCheckbox = document.getElementById('showPassword');
    const passwordInput = document.getElementById('password');

    showPasswordCheckbox.addEventListener('change', function() {
        if (this.checked) {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    });
  </script>
  <script type="text/javascript" src="assets-login/js/main.js"></script>
</body>
</html>
