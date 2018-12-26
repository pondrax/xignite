<div id="main">
  <div id="loader"></div>
  <nav class="navbar navbar-expand-lg mb-2 shadow-sm">
    <button type="button" class="btn btn-primary mr-3" data-toggle="collapse" data-target="#sidebar">
      <i class="fas fa-align-justify"></i>
    </button>
    <h3 class='main-title'>{{APP_NAME}}</h3>
    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#logged">
        <i class="fas fa-align-justify"></i>
    </button>
    <div class="collapse navbar-collapse" id="logged">
      <ul class="nav navbar-nav ml-auto">
        <li class="nav-item active">
            <a class="nav-link" href="#">
              {{$logged->username}}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="@url/xadmin/auth/logout">Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#home">Home</a>
    </li>
  </ul>
  <div class="tab-content" style="height:calc(100% - 110px)">
    <div class="tab-pane container active py-4" id="home">
      <h1>Selamat datang di aplikasi 
        <span class="text-danger">{{APP_NAME}}</span>
      </h1>
      <br>
      @include('ui/home')
      <p class="py-2">Akses menu modul pada sidebar di sisi kiri</p>
    </div>
  </div>
</div>
