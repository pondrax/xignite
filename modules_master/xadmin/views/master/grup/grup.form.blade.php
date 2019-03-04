<form action="@_path/update/" method="post" enctype="multipart/form-data" class="py-3 mt-3 border-top" novalidate>
  <div class="row pb-2">
    <input name="id" type="hidden" value="{{$data->id|''}}">
    <div class="form-group col-8">
      <label>Nama Grup</label>
      <input class="form-control" name="nama_grup" type="text" placeholder="Nama Grup"
        value="{{$data->nama_grup|''}}" autofocus>
    </div>
    
    <div class="form-group col-12">
      <label>Akses Membaca Modul</label>
      <input type="text" name="modul_read" class="form-control selectize selectize-related selectize-tags" placeholder="Pilih Modul" value="{{$data->modul_read|''}}" data-options="daftar_modul">
    </div>
    <div class="form-group col-12">
      <label>Akses Menambah dan Mengubah Modul</label>
      <input type="text" name="modul_write" class="form-control selectize selectize-related selectize-tags" placeholder="Pilih Modul" value="{{$data->modul_write|''}}" data-options="daftar_modul">
    </div>
    <div class="form-group col-12">
      <label>Akses Menghapus Modul</label>
      <input type="text" name="modul_delete" class="form-control selectize selectize-related selectize-tags" placeholder="Pilih Modul" value="{{$data->modul_delete|''}}" data-options="daftar_modul">
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
    daftar_modul : {{jsonform($daftar_modul)}}
  });
</script>