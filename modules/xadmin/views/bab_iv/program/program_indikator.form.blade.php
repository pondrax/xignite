<form action="@_path/update/" method="post" enctype="multipart/form-data" class="py-3 mt-3 border-top" novalidate>
  <div class="row pb-2">
    <input name="id" type="hidden" value="{{$data->id|''}}">
    <div class="col form-group">
      <label>Program</label>
      <input type="text" name="id_program" class="form-control selectize" placeholder="Pilih Program" value="{{$data->id_program|''}}" data-options="daftar_program">
    </div>
    <div class="w-100"></div>
    <div class="col-6 form-group">
      <label>Indikator</label>
      <textarea class="form-control h-min" name="indikator" placeholder="Indikator Program" >{{$data->indikator|''}}</textarea>
    </div>
    <div class="col-6">
      <label>Target Kinerja</label>
      @define($target=isset($data->target)?$data->target:'')
      <div class="form-group input-group mb-3">
        <input type="hidden" class="form-control" name="target" value="{{$data->target|''}}">
        <input type="text" class="form-control target" placeholder="Target Kinerja" value="{{get_jumlah($target)}}" onkeyup="kalkulasi()" data-number>
        <div class="input-group-append pl-1">
          <input type="text" class="form-control target-satuan" placeholder="Satuan" value="{{get_satuan($target)}}" onkeyup="kalkulasi()">
        </div>
      </div>
      <label>Realisasi Kinerja</label>
      @define($realisasi=isset($data->realisasi)?$data->realisasi:'')
      <div class="form-group input-group mb-3">
        <input type="hidden" class="form-control" name="realisasi" value="{{$data->realisasi|''}}">
        <input type="text" class="form-control realisasi" placeholder="Realisasi Kinerja" value="{{get_jumlah($realisasi)}}" onkeyup="kalkulasi()" data-number>
        <div class="input-group-append pl-1">
          <input type="text" class="form-control realisasi-satuan" placeholder="Satuan" value="{{get_satuan($realisasi)}}" onkeyup="kalkulasi()">
        </div>
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
    daftar_program : {{jsonform($daftar_program)}}
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
    UI.tab.active().find('[name=persentase]').val(persentase.toFixed(2).replace(".", ","));
  }
</script>