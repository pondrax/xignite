@include('ui/header')
@include('ui/navbar')
  
  <div style="background:url(@asset/img/gubernur-wagub-jatim.jpg) center ;background-size:cover;">
    <div class="container">
      <div class="row justify-content-end">
        <div class="col-auto align-self-end bg-white px-3 py-2  mb-2 shadow border-bottom">
          @include('ui/login_menu')
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-12 col-lg-6 mb-2">
          <div class="py-5"></div>
          <div class="py-5"></div>
          <div class="py-5"></div>
          <div class="py-5 d-md-none"></div>
          <div class="card bg-info">
              <div class="card-body py-2" >
              <h4 class="text-center card-title text-white m-0 ">Aspirasikan dirimu di Cettar Jatim</h4>
              </div>
          </div>
          
        </div>
        <div class="col col-lg-10">
          <div class="jumbotron bg-white pt-4 pb-2 px-4">
            <form method="post" action="@url/aduan/tambah">
              <textarea name="aduan" class="form-control mb-1 border" rows="6" style="resize:none" placeholder="Ketik aduan anda disini" ></textarea>
              <div class="row mb-1">
                <div class="col-12 col-md-5 pr-md-1">
                  <input name="judul" class="form-control border" placeholder="Perihal aduan">
                </div>
                <div class="col-6 col-md-3 px-md-0">
                  <input name="tags" class="form-control border" placeholder="Hashtag aduan">
                </div>
                <div class="col-6 col-md-4 pl-md-1">
                  <input name="kategori" class="border selectize" placeholder="Kategori" data-options="kategori">
                </div>
                  <input name="latitude" type="hidden">
                  <input name="longitude" type="hidden">
              </div>
              <div class="data-lampiran">
              </div>
              <div class="data-map collapse show">
                  
              </div>
              <div class="row">
                <div class="col-6 col-md-auto mt-1">
                  <button type="button" class="btn btn-sm btn-outline-secondary" onclick="$('[name=lampiran]').click()">UPLOAD LAMPIRAN</button>
                </div>
                <div class="col-6 col-md-auto px-0 mt-1">
                  <button type="button" class="btn btn-sm btn-outline-primary get-location"  data-toggle="collapse" data-target=".data-map">LOKASI ANDA</button>
                </div>
                <div class="form-check col-6 col-md-auto mt-2">
                  <input class="form-check-input ml-0" name="anonim" type="checkbox" id="anonim">
                  <label class="form-check-label pl-3" for="anonim">
                    Anonim
                  </label>
                </div>
                <div class="form-check col-6 col-md-auto mt-2 mr-auto p-0">
                  <input class="form-check-input ml-0" name="rahasia" type="checkbox" id="rahasia">
                  <label class="form-check-label pl-3" for="rahasia">
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
            
            <link rel="stylesheet" href="@css/web/lib/selectize.css">
            <script src="@js/web/lib/selectize.min.js"></script>
            <script>
              var selectize={kategori:{{jsonform($kategori)}}};
              $.each($('.selectize'), function (i, el) {
                var $el=$(el),
                    data=selectize[$el.data('options')],
                    setCreate,
                    setPlugins,
                    setMax=1,
                    setRelated,
                    resetRelated;
                // console.log(data);
                resetRelated=(value)=>{
                  for (var key of Object.keys(data[0])){
                    if(key!='text' && key!='value'){
                      $('[name="'+key+'"]').val('');
                    }
                  }
                };
                
                if($el.hasClass('selectize-tags')){
                  setPlugins=['remove_button'];
                  setMax=null;
                }
                if($el.hasClass('selectize-create')){
                  setCreate=(input)=>({
                    value:input, text:input
                  });
                }
                if($el.hasClass('selectize-related')){
                  setRelated=(value)=>{
                    var index = data.findIndex((item)=>{ return item.value === value }),
                        obj=data[index];
                    for(key in obj) {
                      str=obj[key];
                      if(typeof(str)!="object"){              
                        $('[name="'+key+'"]').val(str);
                      }else{
                        // $('[name="'+key+'"]').val(JSON.stringify(str));
                        var callback=$el.data('callback');
                        window[callback].apply(null,[str]);
                      }
                    }
                  };
                }
                $el.selectize({
                  delimiter: ',',
                  persist: false,
                  options: data,
                  create:setCreate,
                  plugins: setPlugins,
                  maxItems:setMax,
                  // labelField: 'text',
                  // valueField: 'value',
                  onInitialize:()=>{
                    //console.log(this)
                  },
                  onChange:setRelated,
                  onItemRemove:resetRelated,
                  // onOptionAdd:resetRelated,
                });
              });
            </script>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="bg-light py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-4 order-md-12 reveal fadeInLeft delay-02s">
          <h1 class="mt-md-5">Layanan Aduan</h1>
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
                    <h4 class="card-title mt-2 text-center"><b>Tulisen aduan e</b></h4>
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
                @define($link_aduan=base_url('aduan/'.$a->slug.'/'.safeurl($a->judul)))
              <li class="media p-3 my-4 bg-white border-bottom shadow-sm">
                <div class="text-muted">
                    <a href="{{$link_aduan}}" class="link">
                    @define($img=json_decode($a->lampiran))
                    @if(isset($img[0]))
                        <img class="mr-3" src="{{$img[0]->url}}" style="width:100px;height:100px;object-fit: cover;">
                    @else
                        <img class="mr-3" src="@asset/img/logo.png" style="width:100px;height:100px;object-fit: cover;">
                    @endif
                    <br>        
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
          </div>
        </div>
      </div>
    </div>
  </div>
  
  
@include('ui/footer')