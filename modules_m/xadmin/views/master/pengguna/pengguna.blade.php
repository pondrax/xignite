<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#" class="reload-tab" data-url="@url/xadmin/master/pengguna/view/" data-get="">Pengguna</a>
    </li>
  </ol>
</nav>
<div data-toolbar>
  <div class="btn-group">
    <button type="button" class="btn btn-primary" data-action="form" data-title="Tambah Data" data-url="@_path/form">
      <i class="fas fa-plus"> </i> Tambah
    </button>
    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
    </button>
    <div class="dropdown-menu p-0">
      <a class="dropdown-item py-0" href="#" data-action="form" data-title="Tambah Data" data-url="@_path/form/copy/2">Tambah (2)</a>
      <a class="dropdown-item py-0" href="#" data-action="form" data-title="Tambah Data" data-url="@_path/form/copy/3">Tambah (3)</a>
      <a class="dropdown-item py-0" href="#" data-action="form" data-title="Tambah Data" data-url="@_path/form/copy/4">Tambah (4)</a>
      <a class="dropdown-item py-0" href="#" data-action="form" data-title="Tambah Data" data-url="@_path/form/copy/5">Tambah (5)</a>
    </div>
  </div>
</div>
<div class="card card-body collapse mb-5" data-form></div>
<table class="table" data-table="@_path" data-get="" data-module="table,form" data-access="@_access">
  <thead>
    <tr>
      <th data-field="state" data-checkbox="true"></th>
      <th data-field="id" data-visible="false">ID</th>
      <th data-field="username" data-title="Username" data-sortable="true">
      <th data-field="email" data-sortable="true">Email</th>
      <th data-field="nama_grup">Grup</th>
      <th data-title="Action" data-events="action" data-formatter='
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
      ' data-width="120" >
    </tr>
  </thead>
</table>

<script>
</script>
