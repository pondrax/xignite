<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#" class="reload-tab" data-title="Template" data-url="@url/xadmin/master/template/view/">Template</a>
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
      <th data-field="id_tahun" data-sortable="true" data-width="100">Tahun</th>
      <th data-field="template" data-format="<b>{template}</b>" data-sortable="true">Template</th>
      <th data-field="kategori" data-sortable="true" data-width="50">Kategori</th>
      <th data-events="action" data-formatter='
        <button class="btn btn-sm btn-success writable" data-action="modal"
          data-title="Aktivasi Data"
          data-body="Apakah anda yakin mengaktivasi data `<b>{title}</b>`"
          data-footer="<button data-url=`{_path}/update` data-data=`id={id}` class=`btn btn-danger` type=`submit`>Aktivasi</button>" >
          <i class="fas fa-check"></i>
        </button>
        <button class="btn btn-sm btn-info writable" data-action="form"
          data-title="Ubah Data"
          data-url="{_path}/form/" data-get="id={id}">
          <i class="fas fa-pencil-alt"></i>
        </button>
        <button class="btn btn-sm btn-danger deletable" data-action="modal"
          data-title="Hapus Data"
          data-body="Apakah anda yakin menghapus data `<b>{title}</b>`"
          data-footer="<button data-url=`{_path}/remove` data-data=`id={id}` class=`btn btn-danger` type=`submit`>Hapus</button>" >
          <i class="fas fa-times"></i>
        </button>
      ' data-width="120" >Aksi</th>
    </tr>
  </thead>
</table>

<script>
</script>
