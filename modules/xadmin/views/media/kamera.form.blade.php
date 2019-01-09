<form action="@_path/update/" method="post" enctype="multipart/form-data" class="py-3 mt-3 border-top" novalidate>
  <div class="row">
    <input name="id" type="hidden" value="{{$data->id|''}}">
    <div class="form-group col">
      <label>Judul</label>
      <input class="form-control" name="title" type="text" placeholder="Judul"
        value="{{$data->title|''}}" autofocus>
      <label>Deskripsi</label>
      <textarea class="form-control summernote h-min" name="description" placeholder="Deskripsi">{{$data->description|''}}</textarea>
    </div>
    <div class="form-group col-4">
      <label>Kamera</label>
      <ul class="nav nav-pills nav-fill pb-1">
        <li class="nav-item">
          <a class="nav-link btn btn-primary" href="#" onclick="Module.camera.snap(this)">Ambil Foto</a>
        </li>
        <li class="nav-item">
          <a class="nav-link btn btn-secondary" href="#" onclick="Module.camera.init(this)">Memulai</a>
        </li>
        <li class="nav-item">
          <a class="nav-link btn btn-secondary" href="#" onclick="Module.camera.stop(this)">Berhentikan</a>
        </li>
      </ul>
      <div style="position:relative">
        <div style="position:absolute;top:0;right:0;width:150px;z-index:1">
          <div class="embed-responsive embed-responsive-4by3">
            <video class="video bg-light embed-responsive-item"></video>
          </div>
        </div>
        <div class="embed-responsive embed-responsive-4by3">
          <img class="shot bg-dark embed-responsive-item">
        </div>
      </div>
      <canvas width="320" height="240" style="display:none"></canvas>
    </div>
  </div>
  <button type="button" class="btn" data-toggle="collapse" data-target="[data-form]">
    Cancel
  </button>
  <button type="submit" class="btn btn-success">
    <i class="fas fa-save"></i> Save
  </button>
</form>
