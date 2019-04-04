@include('ui/header')
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

@include('ui/footer')