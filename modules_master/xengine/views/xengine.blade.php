<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Xengine Modules</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="@_assets/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="@_assets/css/lib/bootstrap.min.css">
  <link rel="stylesheet" href="@_assets/css/style.css">
  <script src="@_assets/js/lib/jquery.min.js"></script>
  <script src="@_assets/js/lib/popper.min.js"></script>
  <script src="@_assets/js/lib/bootstrap.min.js"></script>
</head>
<body>
  <div class="container-fluid p-5">
    <h1><a href='@url/xengine'>Xengine Modules</a></h1>
    <hr>
    <div class="row">
      <div class="col-12 col-md-4 mb-5">
        @include('xengine.form.controller')
      </div>
      <div class="col-12 col-md-8 mb-5">
        @include('xengine.form.model')
      </div>
    </div>
  </div>
  <script>
    function new_set(el){
      $parent=$(el).closest('.clone');
      $clone=$parent.find('.data-clone').clone().removeClass('data-clone');
      $parent.append($clone);
    }
  </script>
</body>
</html>