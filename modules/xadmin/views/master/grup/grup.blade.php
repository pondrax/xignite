<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#" class="reload-tab" data-url="@url/xadmin/master/grup/view/" data-get="">Grup</a>
    </li>
  </ol>
</nav>
<div data-toolbar>
  <button type="button" class="btn btn-primary" data-action="form" data-title="Tambah Data" data-url="@_path/form">
    <i class="fas fa-plus"> </i> Tambah
  </button>
</div>
<div class="card card-body collapse mb-5" data-form></div>
<table class="table" data-table="@_path" data-get="" data-module="table,form" data-access="@_access">
  <thead>
    <tr>
      <th data-field="state" data-checkbox="true"></th>
      <th data-field="id" data-visible="false">ID</th>
      <th data-field="nama_grup" data-format="<b>{nama_grup}</b>" data-sortable="true">Nama Grup</th>
      <th data-field="modul_read" data-formatter="modul_format">Akses Baca</th>
      <th data-field="modul_write" data-formatter="modul_format">Akses Ubah</th>
      <th data-field="modul_delete" data-formatter="modul_format">Akses Hapus</th>
      <th data-title="Action" data-events="action" data-formatter='
        <button class="btn btn-sm btn-info writable" data-action="form"
          data-title="Ubah Data"
          data-url="{_path}/form/" data-get="id={id}">
          <i class="fas fa-pencil-alt"></i>
        </button>
        <button class="btn btn-sm btn-danger deletable" data-action="modal"
          data-title="Hapus Data"
          data-body="Apakah anda yakin menghapus data `<b>{id}</b>`"
          data-footer="<button data-url=`{_path}/remove` data-data=`id={id}` class=`btn btn-danger` type=`submit`>Delete</button>" >
          <i class="fas fa-times"></i>
        </button>
      ' data-width="120" >
    </tr>
  </thead>
</table>

<script>
  function modul_format(e,row){
    let daftar_modul={{jsonform($daftar_modul)}},
        fields=row[this.field].split(','),
        modul=[];
    for (let i in fields){
      let f=fields[i]
      if(daftar_modul[f]!==undefined){
        modul.push(' '+daftar_modul[f].nama_modul)
      }
    }
    // console.log(modul)
    return modul;
  }
</script>
