@include('ui/header')
  
  <div class="" style="height:100px;background: rgb(10,85,181);
background: linear-gradient(61deg, #ff4c79 35%, #0399bd 100%);">
    <div class="container pb-5 text-white">
      <div class="row justify-content-end">
        <div class="col-auto align-self-end bg-white px-3 py-2  mb-2 shadow border-bottom">
          <a class="btn btn-outline-info hvr-hang" href="@url/masuk">Masuk</a> &nbsp;
          <a class="btn btn-danger hvr-hang" href="@url/daftar">Daftar</a>
        </div>
      </div>
    </div>
  </div>
  
  <div class="shadow">
    <div class="container">
      <div class="row">
        <div class="col-md-4 py-3 bg-white shadow">
          <div class="sticky-top px-3 pb-5 mb-5 bg-white" >
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb px-0 mb-3">
                <li class="breadcrumb-item"><a href="@url">Beranda</a></li>
                <li class="breadcrumb-item"><a href="@url/aduan">Aduan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
              </ol>
            </nav>
            <div class="lampiran-wadul mb-5">
              <h4>Lampiran</h4>
              <div class="row no-gutters">
                <div class="col-auto mr-1 mb-1 border" style="width:80px;height:80px">
                </div>
                <div class="col-auto mr-1 mb-1 border" style="width:80px;height:80px">
                </div>
                <div class="col-auto mr-1 mb-1 border" style="width:80px;height:80px">
                </div>
                <div class="col-auto mr-1 mb-1 border" style="width:80px;height:80px">
                </div>
                <div class="col-auto mr-1 mb-1 border" style="width:80px;height:80px">
                </div>
                <div class="col-auto mr-1 mb-1 border" style="width:80px;height:80px">
                </div>
              </div>
            </div>
            <div class="status-wadul">
              <h4>Status wadul</h4>
              <ul class="nav flex-column">
                <li>-> Diterima admin wadul<li>
                <li>-> Disposisi BPBD Jatim<li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-8 py-3">
          <div class="shadow ml-3 p-5 bg-white">
            <div class="row no-gutters">
              <div class="col-md-auto col-12 mr-3">
                <img class="" src="https://via.placeholder.com/120">
                <p class="text-info">#{{$aduan->slug}}</p>
              </div>
              <div class="col">
                <div class="float-left">
                  @if($aduan->anonim)
                  <span class="">
                    anonim
                  </span>
                  @else
                  <a href="#" class="link">
                    {{($aduan->username)}}
                  </a>
                  @endif
                </div>
                <div class="float-right text-muted">
                  <span class="px-2" data-toggle="tooltip" title="{{strftime('%A, %d %B %Y %H:%M',strtotime($aduan->created_at))}}">
                    {{time_elapsed_string($aduan->created_at)}}
                  </span>
                </div>
                <div class="clearfix border-bottom"></div>
                <h3>{{$aduan->judul}}</h3>
              </div>
            </div>
            <article class="mt-3 text-justify">
              {{$aduan->aduan}}
            </article>
            
            <ul class="nav nav-tabs" style="">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href=".lampiran">Lampiran</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href=".riwayat">
                  Tindak Lanjut (1)
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href=".bagikan">Bagikan</a>
              </li>
            </ul>
            
            <div class="tab-content">
              <div class="tab-pane container active lampiran">Lampiran</div>
              <div class="tab-pane container fade riwayat">Riwayat tindak lanjut</div>
              <div class="tab-pane container fade bagikan">Bagikan</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  
@include('ui/footer')