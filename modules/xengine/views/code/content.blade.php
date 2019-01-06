<div id="main" data-simplebar>
  <div id="loader"></div>
  <nav class="navbar navbar-expand-lg mb-2 shadow-sm">
    <button type="button" class="btn btn-danger mr-3" data-toggle="collapse" data-target="#sidebar">
      <i class="fas fa-align-justify"></i>
    </button>
    <h3 class='main-title'>Xengine Modules :: <span class="text-danger">Code Editor</span></h3>
    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#logged">
        <i class="fas fa-align-justify"></i>
    </button>
    <div class="collapse navbar-collapse" id="logged">
      <ul class="nav navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="@url/xengine/" target="_blank">Builder</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="@url/xengine/base/" target="_blank">Database</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="@url/xengine/code/" target="_blank">Code Editor</a>
        </li>
      </ul>
    </div>
  </nav>
  <ul class="nav nav-tabs nav-main-tabs">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#home">Home</a>
    </li>
  </ul>
  <div class="tab-content" style="height:calc(100vh - 110px)">
    <div class="tab-pane container active py-4" id="home">
      <h1>Selamat datang di aplikasi 
        <span class="text-danger">{{APP_NAME}}</span>
      </h1>
      <br>
      <p class="py-2">Akses menu modul pada sidebar di sisi kiri</p>
    </div>
  </div>
</div>
