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
            <h3>Daftar akun untuk melanjutkan</h3>
            <hr>
            <div class="">
            <u>Laporan anda :</u>
            <p class="pl-2">{{$aduan->aduan}}</p>
            
            <div class="row no-gutters">
              @foreach($aduan->lampiran as $l)
              <div class="col-auto mr-1 mb-1 border" style="width:80px;height:80px;overflow:hidden;position:relative">
                <embed src="{{$l['path']}}" class="w-100"></embed>
                <div class="p-1 text-white text-nowrap bg-secondary" style="bottom:0;left:0;right:0;position:absolute;font-size:10px">{{$l['filename']}}</div>
              </div>
              @endforeach
            </div>
            </div>
            <hr>
            <a href="@url/login" class="text-info">Masuk sekarang</a> <br><br>
            <a href="@url">Kembali ke halaman awal</a>
          </div>
        </div>
    </div>
  </div>
</body>
</html>