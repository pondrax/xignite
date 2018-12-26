<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#" class="reload-tab" data-title="Periode" data-url="@url/xadmin/master/periode/view/">Periode</a>
    </li>
    <li class="breadcrumb-item">
      <a href="#" class="reload-tab" data-title="Pengisi" data-url="@url/xadmin/master/pengisi/view/">Pengisi</a>
    </li>
  </ol>
</nav>
<div data-toolbar>
  <button type="button" class="btn btn-primary" data-action="form" data-title="Tambah Data" data-url="@_path/form">
    <i class="fas fa-plus"> </i> Tambah
  </button> 
</div>
<div class="card card-body collapse mb-5" data-form></div>
<table class="table" 
       data-table="@_path" 
       data-get="" 
       data-module="table,form" 
       data-access="@_access">
  <thead>
    <tr>
      <th data-field="state" data-checkbox="true">
      <th data-field="id" data-visible="false">ID</th>
      <th data-field="periode" data-sortable="true" data-width="150">Periode</th>
      <th data-field="tahun" data-format="<b>{tahun}</b>" data-sortable="true">Tahun</th>
      <th data-field="awal_pengisian" data-sortable="true">Awal Pengisian</th>
      <th data-field="akhir_pengisian" data-sortable="true">Akhir Pengisian</th>
      <th data-field="kunci" data-events="action" data-width="80" data-formatter="updateStatus">Kunci</th>
      <th data-events="action" data-formatter='
        <button class="btn btn-sm btn-info writable" data-action="form"
          data-title="Ubah Data"
          data-url="{_path}/form/" data-get="id={id}">
          <i class="fas fa-pencil-alt"></i>
        </button>
        <button class="btn btn-sm btn-danger deletable" data-action="modal"
          data-title="Hapus Data"
          data-body="Apakah anda yakin menghapus data `<b>{id}</b>`"
          data-footer="<button data-url=`{_path}/remove` data-data=`id={id}` class=`btn btn-danger` type=`submit`>Hapus</button>" >
          <i class="fas fa-times"></i>
        </button>
      ' data-width="120" >Aksi</th>
    </tr>
  </thead>
</table>

<script>
function updateStatus(i,row){
  // console.log(row.kunci)
  if(row.kunci==1){
    return '<button class="btn btn-sm btn-warning writable" data-action="modal"'
          +'  data-title="Kunci Data"'
          +'  data-body="Apakah anda yakin mengunci data `<b>{id}</b>`"'
          +'  data-footer="<button data-url=`{_path}/update` data-data=`id={id}&kunci=0` class=`btn btn-success` type=`submit`>Kunci</button>" >'
          +'  <i class="fas fa-unlock"></i> Tak terkunci'
          +'</button>';
  }else{    
    return '<button class="btn btn-sm btn-success writable" data-action="modal"'
          +'  data-title="Buka Kunci Data"'
          +'  data-body="Apakah anda yakin membuka kunci data `<b>{id}</b>`"'
          +'  data-footer="<button data-url=`{_path}/update` data-data=`id={id}&kunci=1` class=`btn btn-warning` type=`submit`>Buka Kunci</button>" >'
          +'  <i class="fas fa-lock"></i> Terkunci'
          +'</button>';
  }
}
</script>