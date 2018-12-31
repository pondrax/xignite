<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Builder :: Xengine Modules</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="@_assets/favicon.ico" type="image/x-icon" />
  <link type="text/css" rel="stylesheet" href="@_assets/css/lib/bootstrap.min.css">
  <link type="text/css" rel="stylesheet" href="@_assets/css/lib/font-awesome.css">
  <link type="text/css" rel="stylesheet" href="@_assets/css/ui.css">
  <script src="@_assets/js/lib/head.min.js"></script>
</head>
<body>
  <div class="row no-gutters" style="height:100vh">
    <div id="sidebar" class="collapse show bg-light shadow">
      @include('ui/sidebar')
    </div>
    <div id="content">
      @include('ui/content')
    </div>
  </div>
  <script>
    let path={
      asset:'@_assets',
      css:'@_assets/css',
      js:'@_assets/js',
    }
    head.load("@_assets/js/lib/jquery.min.js");
    head.load("@_assets/js/lib/popper.min.js");
    head.load("@_assets/js/lib/bootstrap.min.js");
    head.load("@_assets/js/ui.js?"+Math.random());
    
    head(function(){
      UI.init();
    });
  </script>
</body>
</html>