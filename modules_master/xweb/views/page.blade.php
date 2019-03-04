@include('ui/header')
  <div class="py-4" style="background: rgb(10,85,181);
background: linear-gradient(-61deg, rgba(10,85,181,1) 35%, rgba(0,212,255,1) 100%);">
    <div class="container">
    </div>
  </div>
  
  <div class="shadow" style="min-height:80vh">
    <div class="container py-3">
      <div class="row">
        <div class="col-3 py-3" data-aos="fade-right">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white border-0 px-0">
              <li class="breadcrumb-item"><a href="@url">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{$related->nama_kategori}}</li>
            </ol>
          </nav>
          <h3 class="">{{$page->title}}</h3>
          <ul class="list-group list-group-flush">
          @if(isset($related->pages))
            @foreach($related->pages as $i=>$p)
              @define($url=BASE_URL.$related->slug_kategori.'/'.$p->slug)
              <a class="list-group-item" href="{{$url}}">{{$p->title}}</a>
            @endforeach
          @else
              <a class="list-group-item" href="#" disabled>Tidak ada halaman terkait</a>
          @endif
          </ul>
        </div>
        <div class="col" data-aos="zoom-in" data-aos-delay="300">
          <div class="card shadow p-1 my-1">
            <div class="card-body p-5">
            <h1 class="card-title py-2">{{$page->title}}</h1>
            {{$page->content}}
            @if(isset($permohonan))
              <table class="table p-3">
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>Rincian informasi yang dibutuhkan</th>
                  <th>Tujuan penggunaan informasi</th>
                </tr>
              @foreach($permohonan as $i=>$p)
                <tr>
                  <td>{{($i+1)}}</td>
                  <td><strong>{{$p->nama}}</strong></td>
                  <td>{{$p->alamat}}</td>
                  <td>{{$p->rincian_informasi}}</td>
                  <td>{{$p->tujuan_informasi}}</td>
                </tr>
              @endforeach
              </table>
            @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  
  @include('ui/footer')