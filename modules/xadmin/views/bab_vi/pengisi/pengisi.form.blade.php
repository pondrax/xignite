<form action="@_path/update/" method="post" enctype="multipart/form-data" class="py-3 mt-3 border-top" novalidate>
  <div class="row pb-2">
    <input name="id" type="hidden" value="{{$data->id|''}}">
    <div class="col">
      <label>Pengisi</label>
      <input type="text" name="id_user" class="form-control selectize selectize-tags" placeholder="Pilih Pengisi" value="{{$data->id_user|''}}" data-options="daftar_pengguna">
    </div>
    <div class="col-3">
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
    daftar_periode : {{jsonform($daftar_periode)}},
    daftar_pengguna : {{jsonform($daftar_pengguna)}}
  });
</script>