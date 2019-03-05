<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>{{APP_NAME}}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="@url/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="@css/lib/bootstrap.min.css">
  <link rel="stylesheet" href="@css/lib/bootstrap-table.min.css">
  <link rel="stylesheet" href="@css/lib/font-awesome.css">
  <link rel="stylesheet" href="@css/style.css">
  <script src="@js/lib/jquery.min.js"></script>
  <script src="@js/lib/popper.min.js"></script>
  <script src="@js/lib/bootstrap.min.js"></script>
  <script src="@js/lib/bootstrap-table.min.js"></script>
  <script src="@js/lib/bootstrap-table-export.js"></script>
  <script src="@js/lib/tableExport.js"></script>
  <script src="@js/script.js"></script>
</head>
<body>
<br>
  <div class="container">
    <div class="table-toolbar">
      <button type="button" class="btn btn-primary new" title="New">
        <i class="fas fa-plus"></i> New
      </button>
      <button type="button" class="btn btn-danger remove" title="Delete" disabled>
        <i class="fas fa-trash"></i> Delete
      </button>
    </div>
    
    <div class="card card-body collapse" data-form>
      <h3>
        <span class="title"><b>Form</b></span>
        <button class="close" data-toggle="collapse" data-target="[data-form]">×</button>
      </h3>
      <form action="@url/welcome/update">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
      </form>
    </div>
    
    <table class="table table-no-bordered"
      data-url="@url/welcome/table/view">
      <thead>
      <tr>
        <th data-field="state" data-checkbox="true"></th>
        <th data-field="id">ID</th>
        <th data-field="username" data-sortable="true">Username</th>
        <th data-field="email" data-sortable="true">Email</th>
        <th data-field="user_details.first_name">First Name</th>
        <th data-field="user_details.last_name">Last Name</th>
        <th data-events="events" data-width="100" data-formatter='
          <button class="btn btn-sm btn-info edit" title="Edit">
            <i class="fas fa-edit"></i>
          </button>
          <button class="btn btn-sm btn-danger delete" title="Delete">
            <i class="fas fa-eraser"></i>
          </button>
        '>Action</th>
      </tr>
      </thead>
    </table>
  </div>
  
  <script>
  var path="@url/welcome/table";
  
  var events = {
    'click .add': (e)=>{
      console.log(e);
    },
    'click .edit': (e, value, row) => {
      $form.collapse('toggle');
      $form.find('form').html('<pre>'+JSON.stringify(row,null,2)+'</pre>');
    },
    'click .delete': (e, value, row)=>{
      loadModal(
        'Delete data',
        'Are you sure you want to delete data?',
        '<button type="submit" class="btn btn-danger" data-remove="'+path+'/remove/'+row.id+'">Remove</button>');
    }
  };
  
  $(() => {initTable();})
  </script>

</body>
</html>