<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#" class="reload-tab" data-title="Laporan" data-url="@url/xadmin/bab_i/laporan/view/" data-get="">Laporan</a>
    </li>
  </ol>
</nav>
@if($pengisi)
<div data-toolbar>
  <button type="button" class="btn btn-primary writable" data-action="form" data-title="Tambah Data" data-url="@_path/form">
    <i class="fas fa-plus"> </i> Tambah
  </button>
</div>
<div class="card card-body collapse mb-5" data-form></div>
<table class="table" data-table="@_path" data-get="" data-module="table,form" data-access="@_access">
  <thead>
    <tr>
      <th data-field="state" data-checkbox="true"></th>
      <th data-field="id" data-format="{id}" data-visible="false">ID</th>
      <th data-field="title" data-format="{title}" data-sortable="true">Judul</th>
      <th data-field="description" data-format="{description}" data-sortable="true">Deskripsi</th>
      <th data-field="url" data-format="<a href=`{url}`>Download `{title}`</a><br><embed src=`{url}` class=`w-100`></embed>" data-width="400" data-sortable="true">Dokumen</th>
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