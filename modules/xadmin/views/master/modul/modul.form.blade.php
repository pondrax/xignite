<form action="@_path/update/" method="post" enctype="multipart/form-data" class="py-3 mt-3 border-top" novalidate>
  <div class="row pb-2">
    <input name="id" type="hidden" value="{{$data->id|''}}">
    <div class="form-group col-8">
      <label>Nama Modul</label>
      <input class="form-control" name="nama_modul" type="text" placeholder="Nama Modul"
        value="{{$data->nama_modul|''}}" autofocus>
    </div>
  </div>
  <button type="button" class="btn" data-toggle="collapse" data-target="[data-form]">
    Batal
  </button>
  <button type="submit" class="btn btn-success">
    <i class="fas fa-save"></i> Simpan
  </button>
</form>