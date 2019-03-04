@include('ui/header')
  
  <div class="jumbotron shadow-sm m-0" style="background:url(@asset/img/helpdesk.jpg) center;background-size:cover">
    <div class="container py-1">
      <form action="@url/search">
        <div class="form-row justify-content-md-center">
          <div class="col-12 col-md-6">
            <div class="input-group py-2">
              <input type="text" class="form-control" placeholder="Cari Informasi">
              <div class="input-group-prepend">
                <button class="btn btn-info" type="submit"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>
      </form>
      <div class="text-center text-white">
        <p><em>atau</em></p>
        <p>
        <button class="btn btn-danger hvr-hang px-3" data-scroll="#permohonan">
          <strong>AJUKAN PERMOHONAN INFORMASI</strong>
        </button>
        </p>
      </div>
    </div>
  </div>
  
  
  <div class="py-md-3" style="background: rgb(10,85,181);
background: linear-gradient(-61deg, rgba(10,85,181,1) 35%, rgba(0,212,255,1) 100%);">
    <div class="container">
      <div class="row">
        <div class="col-md-3 my-2 d-flex hvr-bounce-in">
          <div class="card shadow flex-fill" data-aos="fade-up">
            <a href="#" class="card-body text-center text-plain">
              <span class="btn btn-outline-info btn-circle btn-xl">
                <i class="fas fa-sitemap"></i>
              </span>
              <h5 class="card-title py-2 border-bottom"><b>Profil PPID</b></h5>
              <p class="text-muted">PPID berfungsi sebagai pengelola dan penyampai dokumen yang dimiliki oleh badan publik. </p>
              <p>(UU No. 14 Th 2008)</p>
            </a>
          </div>
        </div>
        <div class="col-md-3 my-2 d-flex hvr-bounce-in">
          <div class="card shadow flex-fill" data-aos="fade-up" data-aos-delay="100">
            <a href="@url/daftar-informasi/informasi-berkala" class="card-body text-center text-plain">
              <span class="btn btn-outline-info btn-circle btn-xl">
                <i class="fas fa-bullhorn"></i>
              </span>
              <h5 class="card-title py-2 border-bottom"><b>Informasi Berkala</b></h5>
              <p class="text-muted">Informasi yang dapat mengancam hajat hidup orang banyak dan ketertiban umum. </p>
              <p>(Pasal 12 PERKI 1 Tahun 2010)</p>
            </a>
          </div>
        </div>
        <div class="col-md-3 my-2 d-flex hvr-bounce-in">
          <div class="card shadow flex-fill" data-aos="fade-up" data-aos-delay="200">
            <a href="@url/daftar-informasi/informasi-serta-merta" class="card-body text-center text-plain">
              <span class="btn btn-outline-info btn-circle btn-xl">
                <i class="fas fa-paper-plane"></i>
              </span>
              <h5 class="card-title py-2 border-bottom"><b>Informasi Serta Merta</b></h5>
              <p class="text-muted">Informasi yang dapat mengancam hajat hidup orang banyak dan ketertiban umum. </p>
              <p>(Pasal 12 PERKI 1 Tahun 2010)</p>
            </a>
          </div>
        </div>
        <div class="col-md-3 my-2 d-flex hvr-bounce-in">
          <div class="card shadow flex-fill" data-aos="fade-up" data-aos-delay="300">
            <a href="@url/daftar-informasi/informasi-setiap-saat" class="card-body text-center text-plain">
              <span class="btn btn-outline-info btn-circle btn-xl">
                <i class="fas fa-atom"></i>
              </span>
              <h5 class="card-title py-2 border-bottom"><b>Informasi Setiap Saat</b></h5>
              <p class="text-muted">Rencana Strategis Dinas Peternakan Provinsi Jawa Timur. </p>
              <p>(Renstra) 2015-2019</p>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="bg-light py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-4 order-md-12" data-aos="fade-right">
          <h1 class="mt-md-5">Layanan Informasi</h1>
          <hr>
          <p>
          Dapatkan bantuan terkait layananan Informasi Dinas Peternakan Provinsi Jawa Timur
          </p>
        </div>
        <div class="col-md-8">
          <div class="row">
            <div class="col my-2" data-aos="fade-left" data-aos-delay="100">
              <div class="card shadow">
                <a href="@url/layanan/datang-langsung">
                  <img class="card-img-top" src="@asset/img/alur.jpg">
                  <div class="card-body p-0">
                    <h4 class="card-title mt-2 text-center"><b>Tata cara permohonan</b></h4>
                  </div>
                </a>
              </div>
            </div>
            <div class="col my-2" data-aos="fade-left" data-aos-delay="200">
              <div class="card shadow">
                <a href="@url/layanan/form-permintaan">
                  <img class="card-img-top" src="@asset/img/form.jpg">
                  <div class="card-body p-0">
                    <h4 class="card-title mt-2 text-center"><b>Form Permintaan</b></h4>
                  </div>
                </a>
              </div>
            </div>
          </div>
          <div class="text-center">
            <i class="fas fa-paw text-muted"></i>
          </div>
          <div class="row">
            <div class="col my-2" data-aos="fade-left" data-aos-delay="300">
              <div class="card shadow">
                <a href="@url/informasi/laporan-informasi">
                  <img class="card-img-top" src="@asset/img/status.jpg">
                  <div class="card-body p-0">
                    <h4 class="card-title mt-2 text-center"><b>Status Informasi</b></h4>
                  </div>
                </a>
              </div>
            </div>
            <div class="col my-2" data-aos="fade-left" data-aos-delay="400">
              <div class="card shadow">
                <a href="@url/layanan/pengajuan-keberatan">
                  <img class="card-img-top" src="@asset/img/pengaduan.jpg">
                  <div class="card-body p-0">
                    <h4 class="card-title mt-2 text-center"><b>Pengaduan</b></h4>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>        
      </div>
    </div>
  </div>
  
  <div class="shadow" style="min-height:80vh">
    <div class="container py-3">
      <div class="row">
        <div class="col-md-4" data-aos="fade-right">
          <h1 class="mt-md-5">Galeri Kegiatan</h1>
          <hr>
          <p>
          Galeri terkait kegiatan pengelolaan dan penyampaian dokumen yang dimiliki oleh Dinas Peternakan Provinsi Jawa Timur
          </p>
          <a href="@url/galeri" class="btn btn-outline-danger px-3" style="border-radius:20px">Selengkapnya</a>
          <br>
        </div>
        @foreach($media['rows'] as $m)
        <div class="col-md-4" data-aos="fade-right" data-aos-delay="100">
          <div class="card shadow p-1 my-2">
            <img class="card-img-top" src="{{$m->url}}">
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  
  <div id="permohonan" class="bg-secondary py-5" style="min-height:80vh">
    <div class="container">
      <div class="row">
        <div class="col-md-4 order-md-12" data-aos="zoom-in">
          <h1 class="mt-md-5">Pengajuan Permohonan</h1>
          <hr>
          <p>
          Ajukan permohonan informasi kepada PPID Dinas Peternakan Provinsi Jawa Timur
          </p>
        </div>
        <div class="col" data-aos="zoom-in" data-aos-delay="100">
          @include('form_informasi')
        </div>
      </div>
    </div>
  </div>
</div>
  
@include('ui/footer')