@include('ui/header')
@include('ui/navbar')
  
  <div class="" style="min-height:200px;background: rgb(10,85,181);
background: linear-gradient(61deg, #ff4c79 35%, #0399bd 100%);">
    <div class="container pb-5 text-white">
      <div class="row justify-content-end">
        <div class="col-auto align-self-end bg-white px-3 py-2  mb-2 shadow border-bottom">
            @include('ui/login_menu')
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
          <div class="sticky-top px-2 pb-5 mb-5 bg-white">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb mt-2">
                <li class="breadcrumb-item"><a href="@url">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Aduan</li>
              </ol>
            </nav>
            <h3 class="mt-3 px-2">Aduan Masyarakat</h3>
            <h6 class="text-muted px-2">
            Telusuri semua aduan masyarakat yang ada di Jawa Timur. 
            </h6>
            <br>
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><a href='@url/aduan'>Semua aduan
                <span class="badge badge-secondary float-right">{{$count_status['all']}}</span>
              </a></li>
              @foreach($status as $s)
                  <li class="list-group-item"><a href='@url/aduan?status={{$s->id_status_pengaduan}}'>{{$s->status_pengaduan}}
                    <span class="badge badge-secondary float-right">{{$count_status[$s->id_status_pengaduan]}}</span>
                  </a></li>
              @endforeach
            </ul>
          </div>
        </div>
        <div class="col-md-8 py-3">
          <div>
            <div class="row justify-content-between">
              <div class="col">
                <form action="@url/aduan/" method="get">
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
                  <li class="page-item @if(get('offset',0)==0)
                    disabled 
                  @endif"><a class="page-link" href="?offset={{get('offset',0)-get('limit',10)}}"><</a></li>
                  <li class="page-item @if(get('offset',0)+get('limit',10)>$aduan['total'])
                    disabled 
                  @endif"><a class="page-link" href="?offset={{get('offset',0)+get('limit',10)}}">></a></li>
                </ul>
              </div>
            </div>
            <p class="text-muted">
              @if($aduan['total']>0)
                  Menampilkan 
                  @if(get('search')!='') 
                    aduan "{{get('search')}}"
                  @else
                    semua aduan
                  @endif
                  
                  ( {{get('offset',0)+1}}
                  - {{min(get('offset',0)+get('limit',10), $aduan['total'])}}
                  dari {{$aduan['total']}} )
              @else
                  Data aduan tidak ditemukan
              @endif
            </p>
            <ul class="list-unstyled py-0" style="min-height:80vh">  
              @foreach($aduan['rows'] as $a)
                @define($link_aduan=base_url('aduan/'.$a->slug.'/'.safeurl($a->judul)))
              <li class="media p-3 my-4 bg-white border-bottom shadow-sm">
                <div class="text-muted pr-3">
                    <a href="{{$link_aduan}}" class="link">
                    @define($img=json_decode($a->lampiran))
                    @if(isset($img[0]))
                        <img class="" src="{{$img[0]->url}}" style="width:100px;height:100px;object-fit: cover;margin-left:5px">
                    @else
                        <img class="" src="@asset/img/logo.png" style="width:100px;height:100px;object-fit: contain;margin-left:5px">
                    @endif
                    <br>        
                    @if($a->id_status==0)
                        @define($status_color="btn-secondary")
                    @elseif($a->id_status==1)
                        @define($status_color="btn-warning")
                    @elseif($a->id_status==2)
                        @define($status_color="btn-info")
                    @else
                        @define($status_color="btn-success")
                    @endif
                      <span class="badge {{$status_color}} rounded-0 w-100">{{$a->status_pengaduan}}</span><br>
                    <span class="text-info {{$a->slug}}">#{{$a->slug}}</span>
                    </a> 
                </div>
                <div class="media-body">
                  <a href="{{$link_aduan}}" class="link lead">
                      {{$a->judul}} &nbsp;
                  </a>
                  <p>
                  {{mb_strimwidth(preg_replace('#<[^>]+>#', ' ', $a->aduan), 0, 200, "... ")}}  <a href='{{$link_aduan}}'>selengkapnya</a>
                  </p>
                  <p class="text-muted">
                  <div class="float-left">
                    @if($a->source!='')
                    <small class="badge badge-info p-1">twitter</small>
                    <a href="#" class="text-secondary">
                      {{($a->source)}} 
                    </a>
                    @elseif($a->anonim)
                    <small class="badge badge-secondary p-1">website</small>
                    <span class="text-secondary">
                      anonim
                    </span>
                    @else
                    <small class="badge badge-danger p-1">website</small>
                    <a href="#" class="text-secondary">
                      {{($a->name)}}
                    </a>
                    @endif
                  </div>
                  <div class="float-right text-muted">
                  
                    <span class="px-2" data-toggle="tooltip" title="{{strftime('%A, %d %B %Y %H:%M',strtotime($a->created_at))}}">
                      {{time_elapsed_string($a->created_at)}}
                    </span>
                    &nbsp;
                    <span class="">
                        <!--<span class="badge badge-secondary">-->
                        @if(isset($a->tindak_lanjut))
                            {{count($a->tindak_lanjut)}} tindak lanjut
                        @else
                            Belum ditindaklanjuti
                        @endif
                        <!--</span>-->
                        
                        </span>
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