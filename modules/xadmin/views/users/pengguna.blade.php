@if(!read_modul('users'))
  {{forbidden_access()}}
@else
  <div data-toolbar>
    <button type="button" class="btn btn-primary new" title="Create New">
      <i class="fas fa-plus"> </i> New
    </button>
    @if(delete_modul('users'))
    <button type="button" class="btn btn-danger remove" title="Delete Selections" disabled>
      <i class="fas fa-eraser"> </i> Delete
    </button>
    @endif
  </div>
  <div class="card card-body collapse mb-5" data-form></div>
  <table class="table table-no-bordered" data-table="@_path/view/data"></table>

  <script>
  var path="@_path";
  var title="Data Pengguna";
  var columns=[
    {'field':'state','checkbox':true},
    {'title':'ID','field':'id','sortable':true,'visible':false},
    {'title':'Username','field':'username','sortable':true},
    {'title':'Email','field':'email','sortable':true},
    {'title':'Grup','field':'groups.nama_grup'},
    {'title':'Action','width':100,'events':'action','formatter':
      @if(write_modul('users'))
        '<button class="btn btn-sm btn-info edit" title="Edit">'+
        '  <i class="fas fa-pencil-alt"></i>'+
        '</button> '
      @endif
      @if(delete_modul('users'))
       +'<button class="btn btn-sm btn-danger delete" title="Delete">'+
        '  <i class="fas fa-times"></i>'+
        '</button> '
      @endif
    }
  ];

  var action= {
    'click .new': (e) => {
      loadForm('New User','@_path/form/');
    },
    'click .remove': (e) => {
      loadModal(
        title='Delete user',
        body ='Are you sure you want to delete data "'+getSelections()+'"?',
        footer='<button type="submit" class="btn btn-danger" data-url="@_path/remove/" data-data="id='+getSelections()+'">Delete</button>');
    },
    'click .edit': (e, value, row) => {
      loadForm('Edit user','@_path/form/'+row.id);
    },
    'click .delete': (e, value, row)=>{
      loadModal(
        title='Delete user',
        body ='Are you sure you want to delete data "'+row.id+'"?',
        footer='<button type="submit" class="btn btn-danger" data-url="@_path/remove/" data-data="id='+row.id+'">Delete</button>');
    }
  };

  </script>
@endif