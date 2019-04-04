@include('ui/header')
@include('ui/navbar')
  
  <div style="background:url(@asset/img/gubernur-wagub-jatim.jpg) center;background-size:cover;">
    <div class="container">
      <div class="row justify-content-end">
        <div class="col-auto align-self-end bg-white px-3 py-2  mb-2 shadow border-bottom">
          @if(logged())
            <span class="text-muted">Selamat datang, </span>
            <span class="text-info"><b>{{logged()->email}}</b></span><br>
            <div class="alert alert-danger py-0 px-2 mb-0">Email belum diaktivasi. Harap aktifkan<br> email anda sekarang dihalaman profil.</div>
            <a class="" href="@url/aduanku">Aduanku</a>
            &nbsp;
            <a class="" href="@url/profil">Profil</a>
            &nbsp;
            <a class="text-danger" href="@url/logout">Keluar</a>
          @else
          <a class="btn btn-outline-info hvr-hang" href="@url/login">Masuk</a> &nbsp;
          <a class="btn btn-danger hvr-hang" href="@url/registrasi">Daftar</a>
          @endif
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-12 col-lg-6 mb-2">
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <div class="card bg-info">
              <div class="card-body py-2" >
              <h3 class="text-center card-title text-white m-0 ">Aspirasikan dirimu di Wadul Jatim</h3>
              </div>
          </div>
          
        </div>
        <div class="col col-lg-10">
          <div class="jumbotron bg-white pt-4 pb-2 px-4">
            <form method="post" action="@url/aduan/tambah">
              <textarea name="aduan" class="form-control mb-1 border" rows="6" style="resize:none" placeholder="Ketik aduan anda disini" ></textarea>
              <div class="row mb-1">
                <div class="col pr-md-1">
                  <input name="judul" class="form-control border" placeholder="Perihal aduan">
                </div>
                <div class="col-md-3 px-md-0">
                  <input class="form-control border" placeholder="Hashtag aduan">
                </div>
                <div class="col-md-2 pl-md-1">
                  <select name="kategori" class="form-control border">
                    <option value="1">Keluhan</option>
                    <option value="2">Informasi</option>
                    <option value="3">Pertanyaan</option>
                    <option value="4">Saran</option>
                  </select>
                </div>
              </div>
              <div class="data-lampiran">
              </div>
              <div class="row">
                <div class="col-auto mt-1">
                  <button type="button" class="btn btn-sm btn-outline-primary" onclick="$('[name=lampiran]').click()">UPLOAD LAMPIRAN</button>
                </div>
                <div class="form-check col-6 col-md-auto mt-2">
                  <input class="form-check-input" name="anonim" type="checkbox" id="anonim">
                  <label class="form-check-label" for="anonim">
                    Anonim
                  </label>
                </div>
                <div class="form-check col-6 col-md-auto mt-2 mr-auto">
                  <input class="form-check-input" name="rahasia" type="checkbox" id="rahasia">
                  <label class="form-check-label" for="rahasia">
                    Rahasia
                  </label>
                </div>
                <div class="col-auto">
                  <input type="submit" class="btn btn-danger mt-1 hvr-grow" value="Ajukan Sekarang!">
                </div>
              </div>
            </form>
            <form action="@url/aduan/lampiran" method="post" enctype="multipart/form-data">
              <input type="file" name="lampiran" class="d-none" accept="image/*,application/pdf"/>
            </form>
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
          
          <form action="@url/aduan">
            <div class="form-row justify-content-md-center">
              <div class="col">
                <div class="input-group py-2">
                  <input type="text" name="search" class="form-control" placeholder="Lacak Aduan Anda">
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
                <a href="#">
                  <img class="card-img-top" src="@asset/img/write.jpg">
                  <div class="card-body p-0">
                    <h4 class="card-title mt-2 text-center"><b>Tulisen wadul e</b></h4>
                  </div>
                </a>
              </div>
            </div>
            <div class="col my-2 reveal fadeInLeft delay-01s">
              <div class="card hvr-grow-shadow">
                <a href="#">
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
                <a href="#">
                  <img class="card-img-top" src="@asset/img/response.jpg">
                  <div class="card-body p-0">
                    <h4 class="card-title mt-2 text-center"><b>Takono neh lek drung paham</b></h4>
                  </div>
                </a>
              </div>
            </div>
            <div class="col my-2 reveal fadeInLeft delay-01s">
              <div class="card hvr-grow-shadow">
                <a href="#">
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
            <a href="#" class="card-body text-center text-plain">
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
            <a href="#" class="card-body text-center text-plain">
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
            <a href="#" class="card-body text-center text-plain">
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
          <a href="@url/aduan" class="btn btn-outline-danger px-3" style="border-radius:20px">Selengkapnya</a>
          <br>
        </div>
        <div class="col-md-8 py-3 reveal fadeInLeft delay-02s">
          <div style="height:80vh" data-simplebar>
            <ul class="list-unstyled py-0">            
              @foreach($aduan as $a)
              <li class="media p-3 my-4 bg-white border-bottom shadow-sm">
                <div class="text-muted">
                <img class="mr-3" src="https://via.placeholder.com/100">
                <br>        
                <span class="text-info">#{{$a->slug}}</span>
                </div>
                <div class="media-body"> <a href="@url/aduan/{{$a->slug}}/{{safeurl($a->judul)}}" class="link lead">
                      {{$a->judul}}
                  </a>
                  <p>
                  {{mb_strimwidth(strip_tags($a->aduan), 0, 200, "...")}}
                  </p>
                  <p class="text-muted">
                  <div class="float-left">
                    @if($a->anonim)
                    <span class="">
                      anonim
                    </span>
                    @else
                    <a href="#" class="link">
                      {{($a->name)}}
                    </a>
                    @endif
                  </div>
                  <div class="float-right text-muted">
                  
                    <span class="px-2" data-toggle="tooltip" title="{{strftime('%A, %d %B %Y %H:%M',strtotime($a->created_at))}}">
                      {{time_elapsed_string($a->created_at)}}
                    </span>
                    &nbsp;
                    <span class="">Tindak lanjut</span>
                    &nbsp;
                    <span class="">Dilihat {{$a->view}} kali</span>
                  </div>
                  </p>
                </div>
              </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  
@include('ui/footer')