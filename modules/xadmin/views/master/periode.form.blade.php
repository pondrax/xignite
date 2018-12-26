<form action="@_path/update/" method="post" enctype="multipart/form-data" class="py-3 mt-3 border-top" novalidate>
  <div class="row pb-2">
    <input name="id" type="hidden" value="{{$data->id|''}}">
    <div class="col">
      <label>Tahun</label>
      <input type="text" class="form-control" name="tahun" placeholder="Tahun" value="{{$data->tahun|''}}">
    </div>
    <div class="col">
      <label>Periode</label>
      <input type="text" class="form-control" name="periode" placeholder="Periode" value="{{$data->periode|''}}">
    </div>
    <div class="col">
      <label>Awal Pengisian</label>
      <input type="text" class="form-control" name="awal_pengisian" placeholder="Awal Pengisian" value="{{$data->awal_pengisian|''}}">
    </div>
    <div class="col">
      <label>Akhir Pengisian</label>
      <input type="text" class="form-control" name="akhir_pengisian" placeholder="Akhir Pengisian" value="{{$data->akhir_pengisian|''}}">
    </div>
  <div class="w-100"></div>
  <div class="col py-3">
  <table class="table table-filter">
    <thead>
      <tr>
        <th class="px-0 py-1" style="width:425px"><input type="text" class="form-control" onkeyup="Module.filterbox.filter(this)" placeholder="Filter Dinas Pengisi"></th>
        <th class="text-center px-0 py-1">
          <label class="m-0 btn btn-light" title="Pengisi BAB I">BAB I<input type="checkbox" onclick="Module.filterbox.toggleCheck(this,'pengisi__bab_i')" style="display:none"></label>
        </th>
        <th class="text-center px-0 py-1">
          <label class="m-0 btn btn-light" title="Pengisi BAB II">BAB II<input type="checkbox" onclick="Module.filterbox.toggleCheck(this,'pengisi__bab_ii')" style="display:none"></label>
        </th>
        <th class="text-center px-0 py-1">
          <label class="m-0 btn btn-light" title="Pengisi BAB III">BAB III<input type="checkbox" onclick="Module.filterbox.toggleCheck(this,'pengisi__bab_iii')" style="display:none"></label>
        </th>
        <th class="text-center px-0 py-1">
          <label class="m-0 btn btn-light" title="Pengisi BAB IV">BAB IV<input type="checkbox" onclick="Module.filterbox.toggleCheck(this,'pengisi__bab_iv')" style="display:none"></label>
        </th>
        <th class="text-center px-0 py-1">
          <label class="m-0 btn btn-light" title="Pengisi BAB V">BAB V<input type="checkbox" onclick="Module.filterbox.toggleCheck(this,'pengisi__bab_v')" style="display:none"></label>
        </th>
        <th class="text-center px-0 py-1">
          <label class="m-0 btn btn-light" title="Pengisi BAB VI">BAB VI<input type="checkbox" onclick="Module.filterbox.toggleCheck(this,'pengisi__bab_vi')" style="display:none"></label>
        </th>
        <th class="text-center px-0 py-1">
          <label class="m-0 btn btn-light" title="Pengisi BAB VII">BAB VII<input type="checkbox" onclick="Module.filterbox.toggleCheck(this,'pengisi__bab_vii')" style="display:none"></label>
        </th>
        <th style="width:18px"></th>
      </tr>
    </thead>
    <tbody>
      @foreach($daftar_pengguna as $u)
      <tr>
        <td class="grab" style="width:25px">&#9776;</td>
        <td style="width:400px">
            <label class="tab">{{$u->text}}<input type="checkbox" onclick="Module.filterbox.toggleCheckChild(this)" style="display:none"></label></td>
        <td class="text-center"><input type="checkbox" value="{{$u->value}}" name="pengisi__bab_i[]"></td>
        <td class="text-center"><input type="checkbox" value="{{$u->value}}" name="pengisi__bab_ii[]"></td>
        <td class="text-center"><input type="checkbox" value="{{$u->value}}" name="pengisi__bab_iii[]"></td>
        <td class="text-center"><input type="checkbox" value="{{$u->value}}" name="pengisi__bab_iv[]"></td>
        <td class="text-center"><input type="checkbox" value="{{$u->value}}" name="pengisi__bab_v[]"></td>
        <td class="text-center"><input type="checkbox" value="{{$u->value}}" name="pengisi__bab_vi[]"></td>
        <td class="text-center"><input type="checkbox" value="{{$u->value}}" name="pengisi__bab_vii[]"></td>
      </tr>
      @endforeach
    </tbody>
  </table>
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