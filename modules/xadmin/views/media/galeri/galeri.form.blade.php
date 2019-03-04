<form action="@_path/update/" method="post" enctype="multipart/form-data" class="py-3 mt-3 border-top" novalidate>
  <div class="row">
    <input name="id" type="hidden" value="{{$data->id|''}}">
    <div class="form-group col">
      <label>Title</label>
      <input class="form-control" name="title" type="text" placeholder="Title"
        value="{{$data->title|''}}" autofocus>
      <label>Deskripsi</label>
      <textarea class="form-control summernote h-min" name="description" placeholder="Deskripsi">{{$data->description|''}}</textarea>
    </div>
    <div class="form-group col-4">
      <label>Media</label>
      <input name="old_url" type="hidden" value="{{$data->url|''}}">
      <input class="form-control" name="url" type="file" placeholder="Media" onchange="Module.form.read(this,'.preview')">
      <button type="button" class="btn btn-sm btn-block">Preview</button>
      <iframe src="{{$data->url|''}}" class="border h-min w-100 preview" onload="Module.form.frameset(this)"></iframe>
    </div>
  </div>
  <button type="button" class="btn" data-toggle="collapse" data-target="[data-form]">
    Cancel
  </button>
  <button type="submit" class="btn btn-success">
    <i class="fas fa-save"></i> Save
  </button>
</form>