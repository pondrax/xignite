<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#" class="reload-tab" data-title="Program" data-url="@url/xadmin/bab_v/program/view/" data-get="">Program</a>
    </li>
  </ol>
</nav>
@if($pengisi)
<div data-toolbar>
  <button type="button" class="btn btn-primary" data-action="form" data-title="Tambah Data" data-url="@_path/form">
    <i class="fas fa-plus"> </i> Tambah
  </button>
</div>
<div class="card card-body collapse mb-5" data-form></div>
<table class="table"
       data-table="@_path"
       data-get="" 
       data-sort-name="bab"
       data-sort-order="desc"
       data-module="table,form"
       data-access="@_access">
  <thead>
    <tr>
      <th data-field="state" data-checkbox="true"></th>
      <th data-field="id" data-visible="false">ID</th>
      <th data-field="tahun" data-sortable="true" data-width="100" data-visible="false">Tahun</th>
      <th data-field="instansi" data-sortable="true" data-width="150">Instansi</th>
      <th data-field="bab" data-sortable="true" data-width="100">Tugas</th>
      <th data-field="program" data-format="<b>{program}</b>" data-sortable="true">Program</th>
      <th data-field="target" data-sortable="true" data-width="50">Pagu Anggaran</th>
      <th data-field="realisasi" data-sortable="true" data-width="50">Realisasi Anggaran</th>
      <th data-field="persentase" data-sortable="true" data-width="50">Persentase</th>
      <th data-events="action" data-formatter='
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
@else
  <div class="p-3" data-module="form">
  <h3 class="text-warning">Perhatian !</h3>
  <h3>Anda tidak memiliki akses di <span class="text-danger">modul </span>ini</h3>
  </div>
@endif