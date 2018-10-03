<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>{{APP_NAME}}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="@url/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="@css/lib/bootstrap.min.css">
  <link rel="stylesheet" href="@css/lib/bootstrap-table.min.css">
  <link rel="stylesheet" href="@css/lib/bootstrap-datetimepicker.css">
  <link rel="stylesheet" href="@css/lib/font-awesome.css">
  <link rel="stylesheet" href="@css/lib/selectize.css">
  <link rel="stylesheet" href="@css/style.css">
</head>
<body>
  <div class="wrapper">
    <!-- Sidebar Holder -->
    <nav id="sidebar" class="shadow">
      <div class="sidebar-header text-center">
        <img src="@asset/img/logo.png" style="width:60%">
      </div>
      <ul class="list-unstyled components">
        <p class="text-center">{{APP_NAME}}</p>
        <li class="active">
          <a href="#!home/" data-href="@url/xadmin/home/view">
            <i class="fas fa-home"></i> Beranda
          </a>
        </li>
        @if(read_modul('users'))
           <li>
            <a href="#usermenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
              <i class="fas fa-database"></i> Pengguna
            </a>
            <ul class="collapse list-unstyled shadow" id="usermenu">
              <li>
                <a href="#!pengguna/" data-href="@url/xadmin/users/pengguna/view">
                  <i class="fas fa-angle-right"></i> Pengguna
                </a>
              </li>
            </ul>
          </li>
        @endif
      </ul>
    </nav>

      <!-- Page Content Holder -->
    <div id="content">
      <div class="progress" style="margin:-20px 0 20px;height:5px"></div>
      <div class="loader-spot fixed-top"></div>
      <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
          <button type="button" id="sidebarCollapse" class="navbar-btn">
              <span></span>
              <span></span>
              <span></span>
          </button>
          <h3 class='main-title'>{{APP_NAME}}</h3>
          <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
              <i class="fas fa-align-justify"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
        </div>
      </nav>
      <div class="container-fluid">
        <div id="main-content"></div>
      </div>
    </div>
  </div>

  <script src="@js/lib/jquery.min.js"></script>
  <script src="@js/lib/popper.min.js"></script>
  <script src="@js/lib/bootstrap.min.js"></script>
  <script src="@js/lib/bootstrap-datetimepicker.min.js"></script>
  <script src="@js/lib/selectize.min.js"></script>
  <script src="@js/lib/bootstrap-table.min.js"></script>
  <script src="@js/lib/bootstrap-table-export.js"></script>
  <script src="@js/lib/tableExport.min.js"></script>
  <script type="text/javascript">
    var path='@_path',
        defaultpath='@url/xadmin/';
  </script>
  <script src="@js/script.js"></script>
</body>
</html>