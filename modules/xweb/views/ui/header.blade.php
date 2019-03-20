<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>CETTAR Wadul</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="@url/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="@css/web/lib/bootstrap-sketchy.min.css">
  <link rel="stylesheet" href="@css/web/lib/font-awesome.css">
  <link rel="stylesheet" href="@css/web/lib/animate.css">
  <link rel="stylesheet" href="@css/web/lib/hover.css">
  <link rel="stylesheet" href="@css/web/lib/simplebar.min.css">
  <link rel="stylesheet" href="@css/web/ui.css">
  <script src="@js/web/lib/jquery.min.js"></script>
  <script src="@js/web/lib/popper.min.js"></script>
  <script src="@js/web/lib/bootstrap.min.js"></script>
  <script src="@js/web/lib/simplebar.min.js"></script>
</head>
<body style="height:100vh;">
  <nav class="navbar navbar-expand-lg navbar-light shadow m-0 bg-white" style=" flex-direction: column;border:0;border-radius:0">
    <div class="container py-1 px-4" id="header">
      <a class="navbar-brand hvr-bounce-in" href="@url">
        <img src="@url/favicon.ico" style="float:left;height:3.4rem;padding:0 .3rem 0 0">
        <div style="float:right; padding:.3rem 0">
          CETTAR <span class="text-danger">WADUL</span>
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