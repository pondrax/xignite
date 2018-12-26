<form action="@_path/update/" method="post" enctype="multipart/form-data" class="py-3 mt-3 border-top" novalidate>
  <div class="row pb-2">
    <input name="id" type="hidden" value="{{$data->id|''}}">
    <div class="col">
      <label>Urusan</label>
      <input type="text" name="id_urusan" class="form-control selectize" placeholder="Pilih Urusan" value="{{$data->id_urusan|''}}" data-options="daftar_urusan">
    </div>
    <div class="w-100"></div>
    <div class="col">
      <label>Pengisi</label>
      <input type="text" name="id_user" class="form-control selectize selectize-tags" placeholder="Pilih Pengisi" value="{{$data->id_user|''}}" data-options="daftar_pengguna">
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
    daftar_urusan : {{jsonform($daftar_urusan)}},
    daftar_pengguna : {{jsonform($daftar_pengguna)}}
  });
</script>