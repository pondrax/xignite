@include('ui/header')
  
  <div class="" style="min-height:200px;background: rgb(10,85,181);
background: linear-gradient(61deg, #ff4c79 35%, #0399bd 100%);">
    <div class="container pb-5 text-white">
      <div class="row justify-content-end">
        <div class="col-auto align-self-end bg-white px-3 py-2  mb-2 shadow border-bottom">
          <a class="btn btn-outline-info hvr-hang" href="@url/login">Masuk</a> &nbsp;
          <a class="btn btn-danger hvr-hang" href="@url/registrasi">Daftar</a>
        </div>
      </div>
      <p>
      </p>
    </div>
  </div>
  <div class="shadow" style="min-height:80vh">
    <div class="container">
      <div class="row">
        <div class="col-md-4 py-3 bg-white shadow">
          <div class="sticky-top px-3 pb-5 mb-5 bg-white">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb px-0">
                <li class="breadcrumb-item"><a href="@url">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Aduan</li>
              </ol>
            </nav>
            <h2 class="m-0">Aduan Masyarakat</h2>
            <hr class="mt-0">
            <h5>
            Semua aduan masyarakat Jawa Timur. 
            </h5>
            <br>
          </div>
        </div>
        <div class="col-md-8 py-3">
          <div>
            <div class="row justify-content-between">
              <div class="col">
                <form action="http://[::1]/wadul/aduan/" method="get">
                  <div class="form-row">
                    <div class="col">
                      <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari Aduan" value="{{get('search')}}">
                        <div class="input-group-prepend">
                          <button class="btn btn-info" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="col-auto">
                <ul class="pagination m-0 float-right">
                  <li class="page-item @if(get('offset',0)-get('limit',10))
                    disabled 
                  @endif"><a class="page-link" href="?offset={{get('offset',0)-get('limit',10)}}"><</a></li>
                  <li class="page-item @if(get('offset',0)+get('limit',10)>$aduan['total'])
                    disabled 
                  @endif"><a class="page-link" href="?offset={{get('offset',0)+get('limit',10)}}">></a></li>
                </ul>
              </div>
            </div>
            <p class="text-muted">
              Menampilkan 
              @if(get('search')!='') 
                aduan "{{get('search')}}"
              @else
                semua aduan
              @endif
              
              ( {{get('offset',0)+1}}
              - {{min(get('offset',0)+get('limit',10), $aduan['total'])}}
              dari {{$aduan['total']}} )
            </p>
            <ul class="list-unstyled py-0">  
              @foreach($aduan['rows'] as $a)
              <li class="media p-3 my-4 bg-white border-bottom shadow-sm">
                <div class="text-muted">
                <img class="mr-3" src="https://via.placeholder.com/100">
                <br>        
                <span class="text-info {{dechex(strtotime($a->created_at))}}">#{{$a->slug}}</span>
                </div>
                <div class="media-body">
                  <a href="@url/aduan/{{$a->slug}}/{{safeurl($a->judul)}}" class="link lead">
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
                      {{($a->pengguna[0]->username)}}
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
            {{paginate($aduan['total'])}}
          </div>
        </div>
      </div>
    </div>
  </div>
  
  
@include('ui/footer')