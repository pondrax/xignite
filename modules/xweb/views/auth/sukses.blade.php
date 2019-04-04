@include('ui/header')
  <div class="wrapper">
    <div class="container-fluid">
    <div class="row">
      <div class="col-12 col-md-8 col-lg-7 p-5 bg-white shadow" style="height:100vh">
        <div class="row justify-content-center">
          <div class="col-8">
            <h1>Pendaftaran Wadul berhasil dilakukan</h1>
            <hr>
            <p>Anda dapat masuk sekarang dan menambahkan data aduan.</p> 
            <p>Kode aktivasi telah dikirimkan ke email {{$email}}</p>
            <br>
            <br>
            <a href="@url/login" class="text-info">Masuk sekarang</a> <br><br>
            <a href="@url/aduan">Kembali ke halaman awal</a>
          </div>
        </div>
    </div>
  </div>

@include('ui/footer')