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
      <form class="col-md-8" method="post">
        <h1>Daftar Wadul</h1>
        <hr>
        <div class="form-group">
          <label>Nama Lengkap</label>
          <input type="text" name="name" value="{{post('name')}}" placeholder="Nama Lengkap" class="form-control @if(isset($error['name'])) is-invalid @endif" autofocus>
          <div class="invalid-tooltip">
            {{$error['name']|''}}
          </div>
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" value="{{post('email')}}" placeholder="Email" class="form-control @if(isset($error['email'])) is-invalid @endif" autofocus>
          <div class="invalid-tooltip">
            {{$error['email']|''}}
          </div>
        </div>
        <div class="form-group">
          <label>Telepon</label>
          <input type="text" name="telepon" value="{{post('telepon')}}" placeholder="Telepon" class="form-control @if(isset($error['telepon'])) is-invalid @endif" autofocus>
          <div class="invalid-tooltip">
            {{$error['telepon']|''}}
          </div>
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" name="password" value="{{post('password')}}" placeholder="Password" class="form-control @if(isset($error['password'])) is-invalid @endif">
          <div class="invalid-tooltip">
            {{$error['password']|''}}
          </div>
        </div>
        <br>
        <button type="submit" class="btn btn-block btn-danger">
          <i class="fas fa-register"></i> DAFTAR
        </button>
        <br>
        <p class="text-muted">{{APP_NAME}}</p>
      </form>
    </div>
    </div>
    </div>
  </div>
</body>
</html>