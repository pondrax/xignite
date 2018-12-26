<form action="@_path/update/" method="post" enctype="multipart/form-data" class="py-3 mt-3 border-top" novalidate>
  <div class="row pb-2">
    <input name="id" type="hidden" value="{{$data->id|''}}">
    <div class="col-1 form-group">
      <label>No</label>
      <input type="text" class="form-control" name="no" placeholder="No" value="{{$data->no|''}}">
    </div>
    <div class="col form-group">
      <label>Urusan</label>
      <input type="text" class="form-control" name="urusan" placeholder="Urusan" value="{{$data->urusan|''}}">
    </div>
    <div class="col-2">
      <label>Tahun</label>
      <input type="text" name="id_tahun" class="form-control selectize" placeholder="Pilih Tahun" value="{{$data->id_tahun|$logged->id_tahun}}" data-options="daftar_periode">
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
    daftar_periode : {{jsonform($daftar_periode)}}
  });
</script>