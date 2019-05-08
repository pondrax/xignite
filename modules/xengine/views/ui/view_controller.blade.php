<form class="card card-body" action="xengine/make_controller" method="post">
  <h3>:: Create controller :: </h3><hr>
  <div class="form-group">
    <label>Main Class</label>
      <input class="form-control" placeholder="Auto create Controller Classname" onkeyup="createClass(this.value)" autofocus>
  </div>
  <div class="form-group">
    <label>Controller Path</label>
    <div class="input-group">
      <input class="form-control" name="controller_path" placeholder="example/controllers/example" required>
      <div class="input-group-append">
        <span class="input-group-text">_controller.php</span>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label>Model Path</label>
    <div class="input-group">
      <input class="form-control" name="model_path" placeholder="example/models/example" required>
      <div class="input-group-append">
        <span class="input-group-text">.php</span>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label>View Path</label>
    <div class="input-group">
      <input class="form-control" name="view_path" placeholder="example/views/example" required>
      <div class="input-group-append">
        <span class="input-group-text">.blade.php</span>
      </div>
    </div>
  </div>
  <button type="submit" class="btn btn-success">
    <i class="fas fa-save"></i> Generate
  </button>
</form>
<script>
  function createClass(str){
    if(str==''){
      $('[name=controller_path]').val('');
      $('[name=model_path]').val('');
      $('[name=view_path]').val('');        
    }
    else{
      var i=str.indexOf('/');
      if(i>0){
        var dir=str.slice(0,i), name=str.slice(i+1);
        $('[name=controller_path]').val(dir+'/controllers/'+name);
        $('[name=model_path]').val(dir+'/models/'+name);
        $('[name=view_path]').val(dir+'/views/'+name);
      }else{
        $('[name=controller_path]').val(str+'/controllers/'+str);
        $('[name=model_path]').val(str+'/models/'+str);
        $('[name=view_path]').val(str+'/views/'+str);
      }
    }
  }
</script>