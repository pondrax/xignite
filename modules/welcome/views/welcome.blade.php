<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>{{APP_NAME}}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="@url/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="@css/lib/bootstrap.min.css">
  <script src="@js/lib/jquery.min.js"></script>
  <script src="@js/lib/popper.min.js"></script>
  <script src="@js/lib/bootstrap.min.js"></script>
</head>
<body>
<br>
<div id="container" class="container">
  <div class="card mt-3">
    <div class="card-body">
      <h2 class="card-title mb-3">{{APP_NAME}}</h2>
      <hr>
      <p>The page you are looking at is being generated dynamically by CodeIgniter.</p>
      <blockquote class="blockquote mb-0">
        <p class="m-0 mt-3">If you would like to edit this page you'll find it located at:</p>
        <footer class="blockquote-footer"><code>modules/welcome/views/welcome.blade.php</code></footer>
      </blockquote> 
      <blockquote class="blockquote mb-0">
        <p class="m-0 mt-3">The corresponding controller for this page is found at:</p>
        <footer class="blockquote-footer"><code>modules/welcome/controllers/Welcome.php</code></footer>
      </blockquote>
      <h4 id="ajax" class="mt-5">Try Ajax Request</h4>
      <button class="btn btn-primary">Get Ajax</button>
      <a href="@url/welcome/table" class="btn btn-success">Tables</a>
      <a href="@url/welcome/dbtest" class="btn btn-warning">DB test</a>
    </div>
    <div class="card-footer">
      <p class="text-right m-0">Page rendered in <strong>{elapsed_time}</strong> seconds. 
	  @if(ENVIRONMENT === 'development')
      CodeIgniter Version <strong>{{CI_VERSION}}</strong>
		@endif</p>
    </div>
  </div>
  <script>
    $(document).ready(function(){
        $("button").click(function(){
            $.ajax({url: "@url/welcome/test", success: function(result){
                $("#ajax").html(result);
            }});
        });
    });
    </script>
</div>
</div>
</div>


</body>
</html>