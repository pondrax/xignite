@include('ui/header')
  <div class="py-4" style="background: rgb(10,85,181);
background: linear-gradient(-61deg, rgba(10,85,181,1) 35%, rgba(0,212,255,1) 100%);">
    <div class="container">
    </div>
  </div>
  
  <div class="shadow" style="min-height:80vh">
    <div class="container py-3">
      <div class="row">
        <div class="col-3 pt-3" data-aos="fade-right">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white border-0 px-0">
              <li class="breadcrumb-item"><a href="@url">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Galeri</li>
            </ol>
          </nav>
        </div>
      </div>
      <h1 class="pb-2">Galeri</h1>
      <div class="row">
      @foreach($media['rows'] as $m)
        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
          <div class="card shadow">
            <embed src="{{$m->url}}" class="card-img-top"></embed>
            <div class="card-body">
            <h4 class="card-title text-center">{{$m->title}}</h4>
            <!--<p>{{$m->description}}</p>-->
            </div>
          </div>
        </div>
      @endforeach
      </div>
    </div>
  </div>
  
  
  @include('ui/footer')