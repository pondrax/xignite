@include('ui/header')
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 col-md-8 col-lg-7 bg-white shadow">
        <div class="row justify-content-center py-5" style="min-height:100vh">
          <div class="col-md-8 pt-5">
            <h3>Masuk Wadul</h3>
            <hr>
              <form class="py-3 px-md-3" method="post">
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
              </form>
          </div>
          <div class="col-md-8 pt-2 border-top align-self-end">
            <a href="@url/registrasi" class="text-danger float-left">Daftar sekarang</a>
            <a href="@url" class="float-right">Kembali ke halaman awal</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
