<form action="@_path/update/{{$data->id|''}}" method="post" enctype="multipart/form-data">
  <div class="form-group" novalidate>
    <label>Username</label>
    <input class="form-control" name="username" type="text" placeholder="Username"
      value="{{$data->username|''}}">
  </div>
  <div class="form-group">
    <label>Email</label>
    <input class="form-control" name="email" type="email" placeholder="Email"
      value="{{$data->email|''}}">
  </div>
  <div class="form-group">
    <label>Password</label>
    <input class="form-control" name="password" type="password" placeholder="Password">
  </div>
  <div class="form-group">
    <label>Akses</label>
    <input type="hidden" name="grup_id" value="{{$data->groups->id|''}}">
    <input type="text" class="form-control selectize selectize-related" placeholder="Pilih Grup Akses" value="{{$data->groups->nama_grup|''}}" data-options="#daftar_grup">
    <div id="daftar_grup" hidden>{{jsonify($daftar_grup)}}</div>
  </div>
  <button type="button" class="btn" data-toggle="collapse" data-target="[data-form]">
    Cancel
  </button>
  <button type="submit" class="btn btn-success">
    <i class="fas fa-save"></i> Save
  </div>
</form>