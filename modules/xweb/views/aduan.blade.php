@include('ui/header')
  
  <div class="shadow" style="min-height:80vh">
    <div class="container py-3">
      <div class="row">
        <div class="col-md-4 py-3 mb-5">
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
        <div class="col-md-8 py-3">
          <div>
            <ul class="list-unstyled py-0">            
              @foreach($aduan as $a)
              <li class="media pt-3 pb-1 my-4 border-bottom shadow-sm">
                <div class="text-muted">
                <img class="mr-3" src="https://via.placeholder.com/100">
                <br>        
                <span class="text-info">#{{dechex(strtotime($a->created_at))}}</span>
                </div>
                <div class="media-body">
                  <a href="#" class="link lead">
                      {{$a->judul}}
                  </a>
                  <p>
                  {{mb_strimwidth($a->aduan, 0, 200, "...")}}
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
          </div>
        </div>
      </div>
    </div>
  </div>
  
  
@include('ui/footer')