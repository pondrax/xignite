<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#" class="reload-tab" data-title="Urusan" data-url="@url/xadmin/bab_iv/urusan/view/" data-get="">Urusan</a>
    </li>
    <li class="breadcrumb-item">
      <a href="#" class="reload-tab" data-title="Pengisi" data-url="@url/xadmin/bab_iv/pengisi/view/"  data-get="{{$get|''}}">Pengisi @if(isset($get)) <mark>{{$get}}</mark>  @endif</a>
    </li>
  </ol>
</nav>
<div data-toolbar>
  <button type="button" class="btn btn-primary" data-action="form" data-title="Tambah Data" data-url="@_path/form" data-get="{{$get|''}}">
    <i class="fas fa-plus"> </i> Tambah
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
      <th data-field="urusan" data-sortable="true">Urusan</th>
      <th data-field="instansi" data-sortable="true">Pengisi</th>
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
