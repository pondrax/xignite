<form action="@_path/update/" method="post" enctype="multipart/form-data" class="py-3 mt-3 border-top" novalidate>
  <div class="row pb-2">
    <input name="id" type="hidden" value="{{$data->id|''}}">
    <div class="col form-group">
      <label>Instansi</label>
      <input type="text" name="id_user" class="form-control selectize selectize-related" placeholder="Pilih Instansi" value="{{$data->id_user|$logged->id}}" data-options="daftar_pengguna">
    </div>
    <div class="col-3 form-group">
      <label>Tugas</label>
      <input type="text" name="bab" class="form-control selectize" placeholder="Pilih Tugas" value="{{$data->bab|''}}" data-options="daftar_tugas">
    </div>
    <div class="col-2 form-group">
      <label>Tahun</label>
      <input type="text" name="id_tahun" class="form-control selectize" placeholder="Pilih Tahun" value="{{$data->id_tahun|$logged->id_tahun}}" data-options="daftar_periode">
    </div>
    <div class="w-100"></div>
    <div class="col-12 form-group">
      <label>Dasar Hukum</label>
      <textarea class="form-control summernote" name="dasar_hukum" placeholder="Dasar Hukum">{{$data->dasar_hukum|''}}</textarea>
    </div>
    <div class="col-12 form-group">
      <label>Permasalahan</label>
      <textarea class="form-control summernote" name="permasalahan" placeholder="Permasalahan">{{$data->permasalahan|''}}</textarea>
    </div>
    <div class="col-12 form-group">
      <label>Solusi</label>
      <textarea class="form-control summernote" name="solusi" placeholder="Solusi">{{$data->solusi|''}}</textarea>
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
    daftar_tugas : {{jsonform($daftar_tugas)}},
    daftar_periode : {{jsonform($daftar_periode)}},
    daftar_pengguna : {{jsonform($daftar_pengguna)}}
  });
</script>