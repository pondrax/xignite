@include('ui/header')
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 col-md-8 col-lg-7 bg-white shadow">
        <div class="row justify-content-center py-5" style="min-height:100vh">
          <div class="col-md-8 pt-5">
            <h3>Simpan atau kirim aduan anda</h3>
            <hr>
            <u>Laporan anda :</u>
            <textarea name="aduan" class="form-control border" rows="4" style="resize:none" readonly>{{$aduan->aduan}}</textarea>
            
            <div class="row no-gutters mt-2">
              @foreach($aduan->lampiran as $l)
              <a href="{{$l['path']}}" target="_blank" class="col-auto mr-1 mb-1 border" style="width:80px;height:80px;overflow:hidden;position:relative">
                <embed src="{{$l['path']}}" class="w-100"></embed>
                <div class="p-1 text-white text-nowrap bg-secondary" style="bottom:0;left:0;right:0;position:absolute;font-size:10px">{{$l['filename']}}</div>
              </A>
              @endforeach
            </div>
            <input class="form-control mt-2 border" placeholder="Tambahkan hashtag terkait aduan anda">
            
            
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