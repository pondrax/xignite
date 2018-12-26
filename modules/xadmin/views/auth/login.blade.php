<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>{{APP_NAME}}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="@url/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="@css/lib/bootstrap.min.css">
  <link rel="stylesheet" href="@css/lib/font-awesome.css">
  <link rel="stylesheet" href="@css/ui.css">
  <script src="@js/lib/jquery.min.js"></script>
  <script src="@js/lib/popper.min.js"></script>
  <script src="@js/lib/bootstrap.min.js"></script>
  <style>
  .bg-login{
    background: linear-gradient(45deg, #dca 12%, transparent 0, transparent 88%, #dca 0),
    linear-gradient(135deg, transparent 37%, #639aaf 0, #639aaf 63%, transparent 0),
    linear-gradient(45deg, transparent 37%, #dca 0, #dca 63%, transparent 0) #335877;
    background-size: 100px 100px;
    overflow:hidden;
    }
    #login{
      background:#fff;
      overflow-y:auto;
      height:100vh;
      padding-top:5vh;
    }
  </style>
  
</head>
<body class="bg-login">
  <div class="wrapper">
    <div class="container">
      <form id="login" class="col-12 col-md-6 col-lg-4 shadow px-4" method="post">
          <img src="@asset/img/logo.png"  style="max-width: 150px;display: block;margin: 20px auto;">
          <br>
        <h3>Sign In</h3>
        <br>
        <div class="form-group">
          <label>Username</label>
          <input type="text" name="username" value="{{$username|''}}" placeholder="Username" class="form-control @if(isset($error->username)) is-invalid @endif" autofocus>
          <div class="invalid-tooltip">
            {{$error->username|''}}
          </div>
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" name="password" value="{{$password|''}}" placeholder="Password" class="form-control @if(isset($error->password)) is-invalid @endif">
          <div class="invalid-tooltip">
            {{$error->password|''}}
          </div>
        </div>
        <br>
        <button type="submit" class="btn btn-block btn-primary">
          <i class="fas fa-login"></i> Login
        </button>
        <br>
        <p class="text-muted">LKPJ - V3</p>
      </form>
    </div>
  </div>
</body>
</html>