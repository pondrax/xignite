@include('ui/header')
  
  <div style="background:url(@asset/img/bg3.jpg) center;background-size:cover;">
    <div class="container">
      <div class="row justify-content-end">
        <div class="col-auto align-self-end bg-white px-3 py-2  mb-2 shadow border-bottom">
          <a class="btn btn-outline-info hvr-hang" href="@url/masuk">Masuk</a> &nbsp;
          <a class="btn btn-danger hvr-hang" href="@url/daftar">Daftar</a>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-12 mb-2 hover bounce">
          <h1 class="text-center">Aspirasikan dirimu di Wadul Jatim</h1>
          <h2 class="text-center text-muted">Aspirasikan dirimu di Wadul Jatim</h2>
        </div>
        <div class="col col-lg-10">
          <div class="jumbotron bg-white p-4">
            <textarea class="form-control border-0" rows="7" style="resize:none" placeholder="Ketik aduan disini"></textarea>
            <br>
            <select class="form-control mt-1">
              <option>Blabalabla</option>
              <option>Blabalabla</option>
              <option>Blabalabla</option>
              <option>Blabalabla</option>
            </select>
            <input type="submit" class="btn btn-danger mt-1 hvr-grow" value="Ajukan Sekarang!">
          </div>
        </div>
      </div>
    </div>
  </div>
  
  
  
  <div class="bg-light py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-4 order-md-12 reveal fadeInLeft delay-02s">
          <h1 class="mt-md-5">Layanan Wadul</h1>
          <hr>
          <h5>
            <span class="text-danger">Pahami alur madul mu Rek</span>. Ojo sampe keliru, sabar sitik yo.
          </h5>
          
          <br>
          
          <h5>Lek <span class="text-info">wes tau madul</span>, cek nang kene lo</h5>
          
          <form action="@url/search">
            <div class="form-row justify-content-md-center">
              <div class="col">
                <div class="input-group py-2">
                  <input type="text" class="form-control" placeholder="Lacak Aduan Anda">
                  <div class="input-group-prepend">
                    <button class="btn btn-info" type="submit"><i class="fas fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-8">
          <div class="row">
            <div class="col my-2 reveal fadeInLeft">
              <div class="card hvr-grow-shadow">
                <a href="@url/layanan/datang-langsung">
                  <img class="card-img-top" src="@asset/img/write.jpg">
                  <div class="card-body p-0">
                    <h4 class="card-title mt-2 text-center"><b>Tulisen wadul e</b></h4>
                  </div>
                </a>
              </div>
            </div>
            <div class="col my-2 reveal fadeInLeft delay-01s">
              <div class="card hvr-grow-shadow">
                <a href="@url/layanan/form-permintaan">
                  <img class="card-img-top" src="@asset/img/progress.jpg">
                  <div class="card-body p-0">
                    <h4 class="card-title mt-2 text-center"><b>Di proses Instansi e</b></h4>
                  </div>
                </a>
              </div>
            </div>
          </div>
          <div class="text-center">
            <i class="fas fa-sync-alt text-muted"></i>
          </div>
          <div class="row">
            <div class="col my-2 reveal fadeInLeft">
              <div class="card hvr-grow-shadow">
                <a href="@url/informasi/laporan-informasi">
                  <img class="card-img-top" src="@asset/img/response.jpg">
                  <div class="card-body p-0">
                    <h4 class="card-title mt-2 text-center"><b>Takono neh lek drung paham</b></h4>
                  </div>
                </a>
              </div>
            </div>
            <div class="col my-2 reveal fadeInLeft delay-01s">
              <div class="card hvr-grow-shadow">
                <a href="@url/layanan/pengajuan-keberatan">
                  <img class="card-img-top" src="@asset/img/pengaduan.jpg">
                  <div class="card-body p-0">
                    <h4 class="card-title mt-2 text-center"><b>Lek mari Buyar duduk Bayar</b></h4>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>        
      </div>
    </div>
  </div>
  
  
  
  <div class="py-md-3" style="background: rgb(10,85,181);
background: linear-gradient(61deg, #8bfdfe 35%, #0399bd 100%);">
    <div class="container">
      <div class="row">
        <div class="col-md-3 my-2 d-flex hvr-bounce-in">
          <div class="card shadow flex-fill reveal fadeInLeft">
            <a href="#" class="card-body text-center text-plain">
              <span class="btn btn-outline-danger btn-circle btn-xl">
                <i class="fas fa-sitemap"></i>
              </span>
              <h5 class="card-title py-2 border-bottom"><b>Cak lontong</b></h5>
              <p class="text-muted">Mantep, bener2 jatim. Fast respon.</p>
            </a>
          </div>
        </div>
        <div class="col-md-3 my-2 d-flex hvr-bounce-in">
          <div class="card shadow flex-fill reveal fadeInLeft delay-01s">
            <a href="@url/daftar-informasi/informasi-berkala" class="card-body text-center text-plain">
              <span class="btn btn-outline-danger btn-circle btn-xl">
                <i class="fas fa-bullhorn"></i>
              </span>
              <h5 class="card-title py-2 border-bottom"><b>Ahmad Dani</b></h5>
              <p class="text-muted">Coba ngerti situs iki, pasti aman. Gak repot2 chat.</p>
            </a>
          </div>
        </div>
        <div class="col-md-3 my-2 d-flex hvr-bounce-in">
          <div class="card shadow flex-fill reveal fadeInLeft delay-02s">
            <a href="@url/daftar-informasi/informasi-serta-merta" class="card-body text-center text-plain">
              <span class="btn btn-outline-danger btn-circle btn-xl">
                <i class="fas fa-paper-plane"></i>
              </span>
              <h5 class="card-title py-2 border-bottom"><b>Mad dog</b></h5>
              <p class="text-muted">Naise</p>
            </a>
          </div>
        </div>
        <div class="col-md-3 my-2 d-flex hvr-bounce-in">
          <div class="card shadow flex-fill reveal fadeInLeft delay-03s">
            <a href="@url/daftar-informasi/informasi-setiap-saat" class="card-body text-center text-plain">
              <span class="btn btn-outline-danger btn-circle btn-xl">
                <i class="fas fa-atom"></i>
              </span>
              <h5 class="card-title py-2 border-bottom"><b>Duta</b></h5>
              <p class="text-muted">Mampir jatim dulu</p>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  
  
  <div class="shadow" style="min-height:80vh">
    <div class="container py-3">
      <div class="row">
        <div class="col-md-4 py-3 mb-5 reveal fadeInLeft">
          <h1 class="mt-md-5">Aduan Terkini</h1>
          <hr>
          <h5>
          Lihat aduan masyarakat Jawa Timur lainnya. 
          <br>
          <br>
          Aduan yang mau diajukan mungkin sudah ditangani dan diatasi.
          </h5>
          <a href="@url/galeri" class="btn btn-outline-danger px-3" style="border-radius:20px">Selengkapnya</a>
          <br>
        </div>
        <div class="col-md-8 py-3 reveal fadeInLeft delay-02s">
          <div style="height:80vh" data-simplebar>
            <ul class="list-unstyled py-0">
              <li class="media py-3 my-4 border-bottom shadow-sm">
                <img class="mr-3" src="https://via.placeholder.com/150">
                <div class="media-body">
                  <h5 class="mt-0 mb-1">List-based media object</h5>
                  Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                </div>
              </li>
              <li class="media py-3 my-4 border-bottom shadow-sm">
                <img class="mr-3" src="https://via.placeholder.com/150">
                <div class="media-body">
                  <h5 class="mt-0 mb-1">List-based media object</h5>
                  Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                </div>
              </li>
              <li class="media py-3 my-4 border-bottom shadow-sm">
                <img class="mr-3" src="https://via.placeholder.com/150">
                <div class="media-body">
                  <h5 class="mt-0 mb-1">List-based media object</h5>
                  Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                </div>
              </li>
              <li class="media py-3 my-4 border-bottom shadow-sm">
                <img class="mr-3" src="https://via.placeholder.com/150">
                <div class="media-body">
                  <h5 class="mt-0 mb-1">List-based media object</h5>
                  Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                </div>
              </li>
              <li class="media py-3 my-4 border-bottom shadow-sm">
                <img class="mr-3" src="https://via.placeholder.com/150">
                <div class="media-body">
                  <h5 class="mt-0 mb-1">List-based media object</h5>
                  Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  
@include('ui/footer')