<nav class="navbar navbar-expand-lg navbar-light shadow m-0 bg-white" style=" flex-direction: column;border:0;border-radius:0">
  <div class="container py-1 px-4" id="header">
    <a class="navbar-brand hvr-bounce-in" href="@url">
      <img src="@asset/img/logo.png" style="float:left;height:3.4rem;padding:0 .5rem 0 0">
      <div style="float:right; padding:.3rem 0">
        CETTAR <span class="text-danger">JATIM</span>
        <div class="text-muted" style="font-size:.8rem;font-weight:400">Wadulo nang kene Cak
        </div>
      </div>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="fas fa-bars"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar" style="position:relative">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link hvr-underline-from-center" href="@url">Beranda</a>
        </li>
        <li class="nav-item d-none d-lg-block"><span class="nav-link">/</span></li>
        <li class="nav-item dropdown">
          <a class="nav-link hvr-underline-from-center dropdown-toggle" href="#" data-toggle="dropdown">
            Yuk Wadul
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="@url/layanan/keluhan">Keluhan</a>
            <a class="dropdown-item" href="@url/layanan/informasi">Informasi</a>
            <a class="dropdown-item" href="@url/layanan/pertanyaan">Pertanyaan</a>
            <a class="dropdown-item" href="@url/layanan/saran">Saran</a>
          </div>
        </li>
        <li class="nav-item d-none d-lg-block"><span class="nav-link">/</span></li>
        <li class="nav-item">
          <a class="nav-link hvr-underline-from-center" href="@url/statistik">Statistik</a>
        </li>
        <li class="nav-item d-none d-lg-block"><span class="nav-link">/</span></li>
        <li class="nav-item">
          <a class="nav-link hvr-underline-from-center" href="@url/tentang">Tentang Wadul</a>
        </li>
      </ul>
  </div>
</nav>