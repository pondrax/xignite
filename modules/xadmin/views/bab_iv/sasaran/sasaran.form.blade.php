<form action="@_path/update/" method="post" enctype="multipart/form-data" class="py-3 mt-3 border-top" novalidate>
  <div class="row pb-2">
    <input name="id" type="hidden" value="{{$data->id|''}}">
    <input name="id_tahun" type="hidden" value="{{$data->id_tahun|$logged->id_tahun}}">
    <div class="col-6">
      <label>Instansi</label>
      <input type="text" name="id_user" class="form-control selectize selectize-related" placeholder="Pilih Instansi" value="{{$data->id_user|$logged->id}}" data-options="daftar_pengguna">
    </div>
    <div class="w-100"></div>
    <div class="col">
      <label>Sasaran</label>
      <textarea class="form-control" name="sasaran" placeholder="Sasaran">{{$data->sasaran|''}}</textarea>
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
    daftar_pengguna : {{jsonform($daftar_pengguna)}}
  });
</script>