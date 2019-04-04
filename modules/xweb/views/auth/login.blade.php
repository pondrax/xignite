@include('ui/header')

<body class="bg-login">
  <div class="wrapper">
    <div class="container-fluid">
    <div class="row">
      <div class="col-12 col-md-8 col-lg-7 p-5 bg-white shadow" style="height:100vh">
      <div class="row justify-content-center">
      <form class="col-md-8" method="post">
        <h1>Masuk Wadul</h1>
        <hr>
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" value="{{post('email')}}" placeholder="Email" class="form-control @if(isset($error['email'])) is-invalid @endif" autofocus>
          <div class="invalid-tooltip">
            {{$error['email']|''}}
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
          <i class="fas fa-register"></i> MASUK
        </button>
        <br>
        <p class="text-muted">{{APP_NAME}}</p>
      </form>
    </div>
    </div>
    </div>
  </div>
  
@include('ui/footer')