<form action="@_path/update/" method="post" enctype="multipart/form-data" class="py-3 mt-3 border-top" novalidate>
  <div class="row pb-2">
    <input name="id" type="hidden" value="{{$data->id|''}}">
    <div class="col-4">
      <label>Username</label>
      <input class="form-control" name="username" type="text" placeholder="Username"
        value="{{$data->username|''}}" autofocus>
    </div>
    <div class="col">
      <label>Nama Instansi</label>
      <input class="form-control" name="instansi" type="text" placeholder="Instansi"
        value="{{$data->instansi|''}}">
    </div>
    <div class="w-100"></div>
    <div class="col-4">
      <label>Grup Akses</label>
      <input type="text" name="id_grup" class="form-control selectize selectize-related" placeholder="Pilih Grup Akses" value="{{$data->id_grup|''}}" data-options="daftar_grup">
    </div>
    <div class="col">
      <label>Email</label>
      <input class="form-control" name="email" type="text" placeholder="Email"
        value="{{$data->email|''}}">
    </div>
    <div class="w-100"></div>
    <div class="col-4">
      <label>Password</label>
      <input class="form-control" name="password" type="password" placeholder="Password">
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
    daftar_grup : {{jsonform($daftar_grup)}}
  });
</script>