<form action="@_path/update/" method="post" enctype="multipart/form-data" class="py-3 mt-3 border-top" novalidate>
  <div class="row pb-2">
    <input name="id" type="hidden" value="{{$data->id|''}}">
    <div class="col-3">
      <label>Tahun</label>
      <input type="text" name="id_tahun" class="form-control selectize" placeholder="Pilih Tahun" value="{{$data->id_tahun|''}}" data-options="daftar_tahun">
    </div>
    <div class="col">
      <label>Kategori</label>
      <input type="text" name="kategori" class="form-control selectize" placeholder="Pilih Kategori" value="{{$data->kategori|''}}" data-options="daftar_kategori">
    </div>
    <div class="w-100"></div>
    <div class="col">
      <label>Template</label>
      <textarea class="form-control summernote" name="template" placeholder="Kegiatan" >{{$data->template|''}}</textarea>
    </div>
  </div>
  <button type="button" class="btn" data-toggle="collapse" data-target="[data-form]">
    Batal
  </button>
  <button type="submit" class="btn btn-success">
    <i class="fas fa-save"></i> Simpan
  </button>
</form>

<script>
  Module.form.setSelectize({
    daftar_tahun : {{jsonform($daftar_tahun)}},
    daftar_kategori : {{jsonform($daftar_kategori)}}
  });
</script>