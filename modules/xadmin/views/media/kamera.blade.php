<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#" class="reload-tab" data-url="@url/xadmin/media/kamera/view/" data-get="">Kamera</a>
    </li>
  </ol>
</nav><div data-toolbar>
  <button type="button" class="btn btn-primary" data-action="form" data-title="Tambah Data" data-url="@_path/form">
    <i class="fas fa-plus"> </i> Tambah
  </button>
</div>
<div class="card card-body collapse mb-5" data-form></div>
<table class="table" data-table="@_path" data-get="" data-module="table,form" data-access="@_access">
  <thead>
    <tr>
      <th data-field="state" data-checkbox="true">
      <th data-field="id" data-title="ID" data-format="{id}" data-visible="false">
      <th data-field="title" data-title="Judul" data-format="{title}" data-sortable="true">
      <th data-field="description" data-title="Deskripsi" data-format="{description}" data-sortable="true">
      <th data-field="url" data-title="Media" data-format="<embed src=`{url}` class=`w-100`></embed>" data-width="400" data-sortable="true">
      <th data-title="Action" data-events="action" data-formatter='
        <button class="btn btn-sm btn-success writable" data-action="modal"
          data-title="Publikasikan Data"
          data-body="Apakah anda yakin ingin mempublikasikan data `<b>{title}</b>`"
          data-footer="<button data-url=`{_path}/update` data-data=`id={id}&status={status}` class=`btn btn-success` type=`submit`>Publikasikan</button>" >
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
          data-footer="<button data-url=`{_path}/remove` data-data=`id={id}` class=`btn btn-danger` type=`submit`>Delete</button>" >
          <i class="fas fa-times"></i>
        </button>
      ' data-width="120" >
    </tr>
  </thead>
</table>

<script>
</script>
