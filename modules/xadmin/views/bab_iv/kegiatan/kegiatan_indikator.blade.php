<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#" class="reload-tab" data-title="Kegiatan" data-url="@url/xadmin/bab_iv/kegiatan/view/" data-get="">Kegiatan</a>
    </li>
    <li class="breadcrumb-item">
      <a href="#" class="reload-tab" data-title="Indikator" data-url="@url/xadmin/bab_iv/kegiatan_indikator/view/" data-get="{{$get|''}}">Indikator @if(isset($get)) <mark>{{$get}}</mark>  @endif</a>
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
      <th data-field="kegiatan" data-sortable="true" data-width="150">Kegiatan</th>
      <th data-field="indikator" data-format="<b>{indikator}</b>" data-sortable="true">Indikator</th>
      <th data-field="target" data-sortable="true" data-width="50">Target Kinerja</th>
      <th data-field="realisasi" data-sortable="true" data-width="50">Realisasi Kinerja</th>
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
