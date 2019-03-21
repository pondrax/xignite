<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>{{APP_NAME}}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="@url/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="@css/web/lib/bootstrap-sketchy.min.css">
  <link rel="stylesheet" href="@css/web/lib/font-awesome.css">
  <link rel="stylesheet" href="@css/web/ui.css">
  <script src="@js/web/lib/jquery.min.js"></script>
  <script src="@js/web/lib/popper.min.js"></script>
  <script src="@js/web/lib/bootstrap.min.js"></script>  
</head>
<body class="bg-login">
  <div class="wrapper">
    <div class="container-fluid">
    <div class="row">
      <div class="col-12 col-md-8 col-lg-7 p-5 bg-white shadow" style="height:100vh">
        <div class="row justify-content-center">
          <div class="col-8">
            <h2>Pendaftaran Wadul tidak dapat dilakukan</h2>
            <hr>
            <p>Akun {{$email}} belum terdaftar</p>
            
            <br>
            <br>
            <a href="@url/login" class="text-info">Masuk dengan akun yang lain </a> atau
            <a href="@url/registrasi" class="text-danger">Mendaftar baru </a> <br><br> 
            <a href="@url/aduan">Kembali ke halaman awal</a>
          </div>
        </div>
    </div>
  </div>
</body>
</html>