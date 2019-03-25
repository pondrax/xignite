@include('ui/header')
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 col-md-8 col-lg-7 bg-white shadow">
        <div class="row justify-content-center py-5" style="min-height:100vh">
          <div class="col-md-8 pt-5">
            <h3>Daftar akun untuk melanjutkan</h3>
            <hr>
            <u>Laporan anda :</u>
            <textarea name="aduan" class="form-control border" rows="4" style="resize:none" readonly>{{$aduan->aduan}}</textarea>
            
            <div class="row no-gutters">
              @foreach($aduan->lampiran as $l)
              <div class="col-auto mr-1 mb-1 border" style="width:80px;height:80px;overflow:hidden;position:relative">
                <embed src="{{$l['path']}}" class="w-100"></embed>
                <div class="p-1 text-white text-nowrap bg-secondary" style="bottom:0;left:0;right:0;position:absolute;font-size:10px">{{$l['filename']}}</div>
              </div>
              @endforeach
            </div>
            
            
            
            <form class="my-5" method="post">
            <h4>Registrasi akun baru</h4>
              <div class="form-group">
                <input type="text" name="name" value="{{post('name')}}" placeholder="Nama Lengkap" class="form-control @if(isset($error['name'])) is-invalid @endif" autofocus>
                <div class="invalid-tooltip">
                  {{$error['name']|''}}
                </div>
              </div>
              <div class="form-group">
                <input type="email" name="email" value="{{post('email')}}" placeholder="Email" class="form-control @if(isset($error['email'])) is-invalid @endif" autofocus>
                <div class="invalid-tooltip">
                  {{$error['email']|''}}
                </div>
              </div>
              <div class="form-group">
                <input type="text" name="telepon" value="{{post('telepon')}}" placeholder="Telepon" class="form-control @if(isset($error['telepon'])) is-invalid @endif" autofocus>
                <div class="invalid-tooltip">
                  {{$error['telepon']|''}}
                </div>
              </div>
              <div class="form-group">
                <input type="password" name="password" value="{{post('password')}}" placeholder="Password" class="form-control @if(isset($error['password'])) is-invalid @endif">
                <div class="invalid-tooltip">
                  {{$error['password']|''}}
                </div>
              </div>
              <button type="submit" class="btn btn-block btn-danger">
                <i class="fas fa-register"></i> DAFTAR
              </button>
          </div>
          <div class="col-md-8 pt-2 border-top align-self-end">
            <a href="@url/login" class="text-info">Masuk sekarang</a>
            <a href="@url" class="float-right">Kembali ke halaman awal</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>