<form action="@_path/update/" method="post" enctype="multipart/form-data" class="py-3 mt-3 border-top" novalidate>
  <div class="row pb-2">
    <input name="id" type="hidden" value="{{$data->id|''}}">
    <div class="col-6 form-group">
      <label>Instansi</label>
      <input type="text" name="id_user" class="form-control selectize selectize-related" placeholder="Pilih Instansi" value="{{$data->id_user|$logged->id}}" data-options="daftar_pengguna">
    </div>
    <div class="col-2 form-group">
      <label>Tahun</label>
      <input type="text" name="id_tahun" class="form-control selectize" placeholder="Pilih Tahun" value="{{$data->id_tahun|$logged->id_tahun}}" data-options="daftar_periode">
    </div>
    <div class="w-100"></div>
    <div class="form-group col-6">
      <label>Program</label>
      <textarea class="form-control h-min" name="program" placeholder="Program" >{{$data->program|''}}</textarea>
    </div>
    <div class="col-6">
      <label>Pagu Anggaran</label>
      <div class="form-group input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">Rp. </span>
        </div>
        <input type="hidden" class="form-control" name="target" value="{{$data->target|''}}">
        <input type="text" class="form-control target" placeholder="Pagu Anggaran" value="{{$data->target|''}}" onkeyup="kalkulasi()" data-number>
      </div>
      <label>Realisasi Anggaran</label>
      <div class="form-group input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">Rp. </span>
        </div>
        <input type="hidden" class="form-control" name="realisasi" value="{{$data->realisasi|''}}">
        <input type="text" class="form-control realisasi" placeholder="Realisasi Anggaran" value="{{$data->realisasi|''}}" onkeyup="kalkulasi()" data-number>
      </div>
      <label>Persentase</label>
      <div class="form-group input-group mb-3 col-6 px-0">
        <input type="text" class="form-control" name="persentase" placeholder="Persentase" value="{{$data->persentase|''}}">
        <div class="input-group-append">
          <span class="input-group-text">%</span>
        </div>
      </div>
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
  function kalkulasi(){
    let target=UI.tab.active().find('.target').val(),
        targetsat=UI.tab.active().find('.target-satuan').val()||'',
        realisasi=UI.tab.active().find('.realisasi').val(),
        realisasisat=UI.tab.active().find('.realisasi-satuan').val()||'',
        persentase=UI.number.reset(realisasi)/UI.number.reset(target)*100;
        
    persentase=isFinite(persentase) && persentase || 0;
        
    UI.tab.active().find('[name=target]').val(target+' '+targetsat);
    UI.tab.active().find('[name=realisasi]').val(realisasi+' '+realisasisat);
    UI.tab.active().find('[name=persentase]').val(persentase.toFixed(2).replace('.',','));
  }
</script>