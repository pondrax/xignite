<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>{{APP_NAME}}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="@url/favicon.ico" type="image/x-icon" />
  <link type="text/css" rel="stylesheet" href="@css/lib/bootstrap.min.css">
  <link type="text/css" rel="stylesheet" href="@css/lib/font-awesome.css">
  <link type="text/css" rel="stylesheet" href="@css/ui.css">
  <script src="@js/lib/head.min.js"></script>
</head>
<body>
  <div class="row no-gutters" style="height:100vh">
    <div id="sidebar" class="collapse show bg-primary text-white shadow">
      @include('ui/sidebar')
    </div>
    <div id="content">
      @include('ui/content')
    </div>
  </div>
  <script>
    let path={
      url  :'@url',
      css  :'@css',
      js   :'@js',
      asset:'@asset',
    }
    // head.load("@css/lib/bootstrap.min.css");
    // head.load("@css/lib/font-awesome.css");
    // head.load("@css/ui.css");
    head.load("@js/lib/jquery.min.js");
    head.load("@js/lib/popper.min.js");
    head.load("@js/lib/bootstrap.min.js");
    head.load("@js/ui.js?"+Math.random());
    
    head(function(){
      UI.init();
    });
  </script>
</body>
</html>