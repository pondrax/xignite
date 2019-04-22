@include('ui/header')
@include('ui/navbar')
  
  <div class="" style="min-height:100px;background: rgb(10,85,181);
background: linear-gradient(61deg, #ff4c79 35%, #0399bd 100%);">
    <div class="container p2-5 text-white">
      <div class="row justify-content-end">
        <div class="col-auto align-self-end bg-white px-3 py-2  mb-2 shadow border-bottom">
            @include('ui/login_menu')
        </div>
      </div>
    </div>
  </div>
  
  <div class="shadow">
    <div class="container">
      <div class="row">
        <div class="col-md-3 py-3 bg-white shadow">
          <div class="px-2 pb-5 mb-5 bg-white" >
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb mt-2 mb-3">
                <li class="breadcrumb-item"><a href="@url">Beranda</a></li>
                <li class="breadcrumb-item"><a href="@url/aduan">Aduan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
              </ol>
            </nav>
            <div class="status-aduan">
              <h4>Status aduan</h4>
              <style>
                  .timeline{
                      position:relative;
                      
                  }
                  .timeline:before{
                      content:'';
                      position:absolute;
                      left:55px;
                      width:2px;
                      background:blue;
                      top:0;
                      bottom:0;
                      z-index:-1;
                  }
              </style>
              <ul class="nav flex-column timeline">
                    <li class="row mb-2">
                        <div class="pr-0" style="width:50px;margin-left:15px">
                        <small class="badge badge-secondary" style="font-size:60%">{{time_elapsed_string($aduan->created_at)}}</small>
                        </div>
                        <div class="col">
                        <span class="">Diterima Admin Cettar</span>
                        </div>
                    </li>
                  @if(!empty($tindakan))
                  @foreach($tindakan as $t)
                        <li class="row mb-2">
                            <div class="pr-0" style="width:50px;margin-left:15px">
                            <small class="badge badge-secondary" style="font-size:60%">{{time_elapsed_string($t->created_at)}}</small>
                            </div>
                            <div class="col">
                            <span class="">Dijawab {{$t->name}}</span>
                            </div>
                        </li>
                  @endforeach
                  @endif
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-9 py-3 px-0">
          <div class="shadow ml-md-4 p-4 p-md-5 bg-white">
              <div class="row" style="margin:-60px 30px 30px; float:right">
                @if($aduan->id_status==0)
                    @define($status_color="btn-secondary")
                @elseif($aduan->id_status==1)
                    @define($status_color="btn-warning")
                @elseif($aduan->id_status==2)
                    @define($status_color="btn-info")
                @else
                    @define($status_color="btn-success")
                @endif
                @if(logged()&&logged()->id_grup==1&&$aduan->id_status==0)
                    <button class="btn btn-primary mr-2" data-toggle="collapse" data-target=".edit-box"><i class="fas fa-edit"></i> Verifikasi</button>
                @endif
                @if(logged()&&logged()->id_grup<=2)
                <form action="@url/aduan/update_status/" method="post">
                    <input type="hidden" name="id" value="{{$aduan->id}}">
                    <select name="id_status" class="form-control {{$status_color}}" onchange="this.form.submit()">
                        @foreach($status as $s)
                            <option value="{{$s->id_status_pengaduan}}"
                            @if($aduan->id_status==$s->id_status_pengaduan) 
                            selected @endif >{{$s->status_pengaduan}}</option>
                        @endforeach
                    </select>
                </form>
                @else
                    <span class="btn {{$status_color}} shadow">{{$aduan->status_pengaduan}}</span><br>
                @endif
              </div>
              <div style="clear:both"></div>
              @if(logged()&&logged()->id_grup==1&&$aduan->id_status==0)
              <div class="edit-box collapse">
                <h3>Verifikasi data aduan</h3>
                <form method="post" action="@url/aduan/verifikasi" class="border p-2 mb-5">
                  <div class="py-1">
                    @if($aduan->id_status==0) <input type="hidden" name="id_status" value="2"> @endif
                    <input type="hidden" name="id" value="{{$aduan->id}}">
                    <input name="judul" class="form-control border" placeholder="Judul aduan" value="{{$aduan->judul}}">
                  </div>
                  <textarea name="aduan" class="form-control mb-1 summernote" rows="6" style="resize:none" placeholder="Ketik aduan anda disini" >{{$aduan->aduan}}</textarea>
                  <div class="row my-1">
                    <div class="col-6 pr-0">
                      <input name="tags" class="form-control border" placeholder="Hashtag aduan" value="{{$aduan->tags}}">
                    </div>
                    <div class="col-6">
                      <input name="id_kategori" class="border selectize" placeholder="Kategori" data-options="kategori" value="{{$aduan->id_kategori}}">
                    </div>
                  
                    <div class="col-auto">
                      <input type="submit" class="btn btn-danger btn-sm mt-1 hvr-grow" value="Simpan">
                    </div>
                  </div>
                </form>
              </div>
              
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
              @endif
            <div class="row no-gutters">
              <div class="col-md-auto col-12 mr-3">
                @define($img=json_decode($aduan->lampiran))
                @if(isset($img[0]))
                    <img class="" src="{{$img[0]->url}}" style="width:120px;height:120px;object-fit: cover;">
                @else
                    <img class="" src="@asset/img/logo.png" style="width:120px;height:120px;object-fit: cover;">
                @endif
                <p class="text-info">#{{$aduan->slug}}</p>
              </div>
              <div class="col">
                <div class="float-left">
                  @if($aduan->source!='')
                    <small class="badge badge-info p-1">twitter</small>
                    <a href="#" class="text-secondary">
                      {{($aduan->source)}} 
                    </a>
                    @elseif($aduan->anonim)
                    <small class="badge badge-secondary p-1">website</small>
                    <span class="text-secondary">
                      anonim
                    </span>
                    @else
                    <small class="badge badge-danger p-1">website</small>
                    <a href="#" class="text-secondary">
                      {{($aduan->name)}}
                    </a>
                    @endif
                </div>
                <div class="float-right text-muted">
                  <span class="px-2" data-toggle="tooltip" title="{{strftime('%A, %d %B %Y %H:%M',strtotime($aduan->created_at))}}">
                    {{time_elapsed_string($aduan->created_at)}}
                  </span>
                  &nbsp;
                  <span>
                    Dilihat {{$aduan->view}} kali
                  </span>
                </div>
                <div class="clearfix border-bottom"></div>
                <h3>{{$aduan->judul}}</h3>
              </div>
            </div>
            <article class="my-2 mb-5">
              {{$aduan->aduan}}
            </article>
            @if($aduan->lampiran!='[]')
            <div class="lampiran-wadul mb-3">
              <p class="border-bottom mb-1">Lampiran</p>
              <div class="row no-gutters">
                  @foreach(json_decode($aduan->lampiran,true) as $i=>$l)
                
                  <a href="{{$l['url']}}" target="_blank" class="col-auto mr-1 mb-1 border" data-toggle="modal" data-target="#imgModal{{$i}}" style="width:80px;height:80px;overflow:hidden;position:relative;">
                    <img src="{{$l['url']}}"  style="width:80px;height:80px;object-fit: cover;">
                    <div class="p-1 text-white text-nowrap bg-secondary" style="bottom:0;left:0;right:0;position:absolute;font-size:10px">{{$l['filename']}}</div>
                  </a>
                  
                  <div class="modal fade" id="imgModal{{$i}}">
                    <div class="modal-dialog modal-xl">
                      <div class="modal-content">
                      
                       <div class="modal-header">
                        <h4 class="modal-title">{{$l['filename']}}</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                        
                        <!-- Modal body -->
                        <div class="modal-body text-center">
                          <img src="{{$l['url']}}" class="rounded mx-auto w-100" ><br>   
                        </div>
                        
                      </div>
                    </div>
                  </div>
                  @endforeach
              </div>
            </div>
            @endif
            <ul class="nav nav-tabs" style="">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href=".riwayat">Tindak lanjut <span class="badge badge-secondary">{{isset($tindakan)?count($tindakan):0}}</span></a>
              </li>
              @if(!($aduan->latitude==0&&$aduan->longitude==0))
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href=".lokasi">
                  Lokasi
                </a>
              </li>
              @endif
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href=".komentar">
                  Komentar
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href=".bagikan">Bagikan</a>
              </li>
            </ul>
            
            <div class="tab-content border border-top-0 pt-3">
              <div class="tab-pane container active riwayat">
                @if(empty($tindakan))
                    @if($aduan->id_status==1)
                    <p class="py-2">Aduan belum di disposisikan ke instansi terkait</p>
                    @else
                    <p class="py-2">Aduan sedang dalam proses verifikasi oleh administrator sistem.</p>
                    @endif
                @endif
                @if($owner)
                <form action="@url/tindakan/tambah" method="post">
                    <input name="id_aduan" type="hidden" value="{{$aduan->id}}">
                    <input name="id_user" type="hidden" value="{{logged()->id|''}}">
                    <textarea name="tindakan" class="form-tindakan form-control" ></textarea>
                    <button type="submit" class="btn btn-sm btn-danger mt-1">Balas</button>
                </form>
                <link rel="stylesheet" href="@css/web/lib/summernote.css">
                
                <script src="@js/web/lib/summernote.min.js"></script>
                  <script>
                      $(".summernote").summernote({height:120});
                      $(".form-tindakan").summernote({
                      height: 120,
                      placeholder:"Tulis hasil tindak lanjut terkait aduan",
                      toolbar: false,
                      hint: {
                            mentions: {{json_encode($instansi)}},
                            match: /\B@(\w*)$/,
                            search: function (keyword, callback) {
                                callback($.grep(this.mentions, function (item) {
                                  return item.name.toLowerCase().includes(keyword.toLowerCase());
                                }));
                            },
                            template: function (item) {
                                return item.name;
                            },
                            content: function (item) {
                                return $('<span class="text-info" data-id-user="'+item.id+'">@' + item.name + '</span>')[0];
                            }
                        }
                        });
                      $('div.note-group-select-from-files').remove();
                  </script>
                  @endif
                @if(!empty($tindakan))
                <h5 class="mt-5 border-bottom">Semua data tindak lanjut : </h5>
                <ul class="list-unstyled pl-1">  
                  @foreach($tindakan as $t)
                  <li class="media mt-3 shadow-sm">
                    <div class="text-muted">
                        <a href="#" class="link">
                            <!--<img class="mr-3" src="https://via.placeholder.com/40">-->
                        </a> 
                    </div>
                    <div class="media-body">
                        
                        
                        
                        <blockquote>
                            <div class="row justify-content-between pl-4 pb-2" style="margin-top: -32px ">
                        <span class="text-danger col-auto"><i class="fas fa-user"></i> {{$t->name}}</span>
                        <span class="text-primary col-auto" data-toggle="tooltip" title="{{strftime('%A, %d %B %Y %H:%M',strtotime($t->created_at))}}">{{time_elapsed_string($t->created_at)}}</span>
                        </div>
                        {{$t->tindakan}}
                        </blockquote>
                    </div>
                  </li>
                  @endforeach
                </ul>
                @endif
              </div>
              @if(!($aduan->latitude==0&&$aduan->longitude==0))
              <div class="tab-pane container fade lokasi">
                <iframe src="https://maps.google.com/maps?q={{$aduan->latitude}},{{$aduan->longitude}}&z=15&output=embed" width="800" height="300" frameborder="0" style="border:0;width:100%"></iframe>
              </div>
              @endif
              <div class="tab-pane container fade komentar">
                  Komentar
                  <textarea class="form-control" placeholder="Tambahkan komentar"></textarea>
              </div>
              <div class="tab-pane container fade bagikan">
              {{current_url()}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  
@include('ui/footer')