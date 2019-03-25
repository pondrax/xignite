@include('ui/header')
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 col-md-8 col-lg-7 bg-white shadow">
        <div class="row justify-content-center py-5" style="min-height:100vh">
          <div class="col-md-8 pt-5">
            <h3>Selamat aduan anda telah disimpan</h3>
            <hr>
            <p>Aduan yang anda laporkan telah disimpan oleh sistem kami dan akan segera diproses oleh instansi terkait. Anda dapat melakukan tracking aduan anda dengan ID <a href="@url/aduan/{{$aduan['slug']}}" class="text-info">#{{$aduan['slug']}}</a> atau pada menu <a href="@url/aduanku" class="text-info">Aduanku</a>
            
          </div>
          <div class="col-md-8 pt-2 border-top align-self-end">
            <a href="@url" class="float-right">Kembali ke halaman awal</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>