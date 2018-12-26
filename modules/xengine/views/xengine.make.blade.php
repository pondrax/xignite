<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Xengine Modules</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="@_assets/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="@_assets/css/lib/bootstrap.min.css">
  <link rel="stylesheet" href="@_assets/css/lib/highlight.css">
  <link rel="stylesheet" href="@_assets/css/style.css">
</head>
<body>
  <div class="container-fluid p-5">
    <h1><a href='@url/xengine'>Xengine Modules</a></h1>
    <hr>
    <div class="row">
      <div class="col">
        <h3>:: Modules created :: </h3>
        <p>
          Saved at <mark class="text-danger">/{{$realpath}}</mark>
          @if(isset($result_view))
            <br> Preview Link <mark><a href="{{$result_view}}" target="_blank">{{$result_view}}</a></mark>
          @endif
        </p>
        <textarea class="text-result" hidden>{{$result}}</textarea>
        <pre><code class="text-editor form-control px-2" style="height:50vh;font-size:90%"></code></pre>
      </div>
    </div>
  </div>
  <script src="@_assets/js/lib/jquery.min.js"></script>
  <script src="@_assets/js/lib/popper.min.js"></script>
  <script src="@_assets/js/lib/bootstrap.min.js"></script>
  <script src="@_assets/js/lib/highlight.pack.js"></script>
  <script>
    $(()=> {
      $('.text-editor').html($('.text-result').html());
      $('pre code').each(function(i, block) {
        hljs.highlightBlock(block);
      });
    });
  
  </script>
</body>
</html>