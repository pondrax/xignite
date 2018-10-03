<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>{{APP_NAME}}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="@url/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="@css/lib/bootstrap.min.css">
  <link rel="stylesheet" href="@css/lib/font-awesome.css">
  <link rel="stylesheet" href="@css/style.css">
  <script src="@js/lib/jquery.min.js"></script>
  <script src="@js/lib/popper.min.js"></script>
  <script src="@js/lib/bootstrap.min.js"></script>
</head>
<body class="bg-login">
  <div class="wrapper">
    <div class="container">
      <form id="login" class="col-8 col-md-4 shadow" method="post">
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
      </form>
    </div>
  </div>
</body>
</html>