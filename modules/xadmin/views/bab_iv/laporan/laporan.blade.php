<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#" class="reload-tab" data-title="Report" data-url="@url/xadmin/bab_iv/laporan/view/" data-get="">Report</a>
    </li>
  </ol>
</nav>
<div data-toolbar>
  <button class="btn btn-success writable" data-action="form"
    data-title="Laporan Bab IV"
    data-url="{_path}/frame/">
    <i class="fas fa-eye"></i> Lihat Semua Data
  </button>
</div>
<div class="card card-body collapse mb-5" data-form></div>
<table class="table" 
       data-table="@_path" 
       data-get="{{$get|''}}"
       data-module="table,form"
       data-access="@_access">
  <thead>
    <tr>
      <th data-field="state" data-checkbox="true">
      <th data-field="id" data-visible="false">ID</th>
      <th data-field="instansi" data-format="<b>{instansi}</b>" data-sortable="true">Instansi</th>
      <th data-events="action" data-formatter='updateStatus' data-width="50">Status</th>
      <th data-events="action" data-formatter='
        <button class="btn btn-sm btn-success writable" data-action="form"
          data-title="Laporan {instansi}"
          data-url="{_path}/frame/" data-get="id={id_user}">
          <i class="fas fa-eye"></i> Lihat Laporan
        </button>
      ' data-width="50" >Aksi</th>
    </tr>
  </thead>
</table>
<script>
function updateStatus(i,row){
  // console.log(row.kunci)
  if(row.kunci==0){
    return '<button class="btn btn-sm btn-warning writable" data-action="modal"'
          +'  data-title="Verifikasi Data"'
          +'  data-body="Apakah anda yakin memverifikasi data `<b>{instansi}</b>`"'
          +'  data-footer="<button data-url=`{_path}/update` data-data=`id={id}&kunci={{date('Y-m-d h:i:s')}}` class=`btn btn-success` type=`submit`>Kunci</button>" >'
          +'  <i class="fas fa-unlock"></i> Belum diverifikasi'
          +'</button>';
  }else{    
    return '<button class="btn btn-sm btn-success writable @if(logged()->id_grup>2) disabled @endif" data-action="modal"'
          +'  data-title="Batal verifikasi"'
          +'  data-body="Apakah anda yakin membatalkan verifikasi data `<b>{instansi}</b>`"'
          +'  data-footer="<button data-url=`{_path}/update` data-data=`id={id}&kunci=0` class=`btn btn-warning` type=`submit`>Buka Kunci</button>" >'
          +'  <i class="fas fa-lock"></i> Sah '+row.kunci
          +'</button>';
  }
}
</script>