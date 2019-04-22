@include('ui/header')
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 col-md-8 col-lg-7 bg-white shadow">
        <div class="row justify-content-center py-5" style="min-height:100vh">
          <div class="col-md-8 pt-5">
            <h3>Pendaftaran Cettar berhasil dilakukan</h3>
            <hr>
            <p>Anda telah masuk sistem, sekarang anda dapat menambahkan data aduan.</p> 
            <p>Kode aktivasi telah dikirimkan ke email <span class="text-info">{{$email}}</span></p>
            <br>
            <br>
          </div>
          <div class="col-md-8 pt-2 border-top align-self-end">
            <a href="@url" class="float-right">Kembali ke halaman awal</a><br>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>