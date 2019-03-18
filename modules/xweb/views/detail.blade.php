@include('ui/header')
  
  <div class="shadow" style="min-height:80vh">
    <div class="container py-3">
      <div class="row">
        <div class="col-md-3 py-3 mb-5">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb px-0">
                <li class="breadcrumb-item"><a href="@url">Beranda</a></li>
                <li class="breadcrumb-item"><a href="@url/aduan">Aduan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
              </ol>
            </nav>
            
          </div>
        </div>
        <div class="col-md-9 py-3">
          <div class="row jumbotron px-3">
            <div class="col-auto pr-0">
              <img class="mr-3" src="https://via.placeholder.com/100">
              <p class="text-info">#{{$aduan->slug}}</p>
            </div>
            <div class="col">
              <h3>{{$aduan->judul}}</h3>
              <article class="text-justify">
              {{$aduan->aduan}}
              </article>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  
@include('ui/footer')