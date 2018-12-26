<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#" class="reload-tab" data-title="Sasaran" data-url="@url/xadmin/bab_iv/sasaran/view/" data-get="">Sasaran</a>
    </li>
    <li class="breadcrumb-item">
      <a href="#" class="reload-tab" data-title="Indikator" data-url="@url/xadmin/bab_iv/sasaran_indikator/view/" data-get="">Indikator</a>
    </li>
  </ol>
</nav>
<div data-toolbar>
  <button type="button" class="btn btn-primary writable" data-action="form" data-title="Tambah Data" data-url="@_path/form">
    <i class="fas fa-plus"> </i> Tambah
  </button>
</div>
<div class="card card-body collapse mb-5" data-form></div>
<table class="table" 
       data-table="@_path"
       data-get=""
       data-sort-name="instansi"
       data-sort-order="asc"
       data-module="table,form"
       data-access="@_access">
  <thead>
    <tr>
      <th data-field="state" data-checkbox="true">
      <th data-field="id" data-visible="false">ID</th>
      <th data-field="tahun" data-sortable="true" data-width="100" data-visible="false">Tahun</th>
      <th data-field="instansi" data-sortable="true" data-width="150">Instansi</th>
      <th data-field="sasaran" data-format="<b>{sasaran}</b>" data-sortable="true">Sasaran</th>
      <th data-events="action" data-formatter='
        <button class="btn btn-sm btn-success writable" data-action="load"
          data-title="Ubah Indikator Data"
          data-url="{_path}_indikator/view/" data-get="id_sasaran={id}">
          <i class="fas fa-burn"></i>
        </button>
        <button class="btn btn-sm btn-info writable" data-action="form"
          data-title="Ubah Data"
          data-url="{_path}/form/" data-get="id={id}">
          <i class="fas fa-pencil-alt"></i>
        </button>
        <button class="btn btn-sm btn-danger deletable" data-action="modal"
          data-title="Hapus Data"
          data-body="Apakah anda yakin menghapus data `<b>{title}</b>`"
          data-footer="<button data-url=`{_path}/remove` data-data=`id={id}` class=`btn btn-danger` type=`submit`>Delete</button>" >
          <i class="fas fa-times"></i>
        </button>
      ' data-width="120" >Aksi</th>
    </tr>
  </thead>
</table>
