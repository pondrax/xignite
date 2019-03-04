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
  <style>
    .table tbody tr td {
      padding:.3rem .5rem;
    }
  </style>
</head>
<body>
<br>
  <div class="container">
    <div id="toolbar">
      <button type="button" class="btn btn-primary">
        <i class="fas fa-plus"></i> New
      </button>
      <button type="button" class="btn btn-secondary">
        <i class="fas fa-trash"></i> Delete
      </button>
    </div>
    <div id="action-table" style="display:none">
      <button class="btn btn-sm btn-info edit" title="Edit">
        <i class="fas fa-edit"></i>
      </button>
      <button class="btn btn-sm btn-danger remove" title="Remove">
        <i class="fas fa-eraser"></i>
      </button>
    </div>
    <table class="table table-striped table-condensed"
           data-table
           data-height="500"
           data-toolbar="#toolbar"
           data-search="true"
           data-show-toggle="true"
           data-show-refresh="true"
           data-show-columns="true"
           data-show-export="true"
           data-detail-view="true"
           data-detail-formatter="detailFormatter"
           data-url="@url/welcome/table/view"
           data-side-pagination="server"
           data-pagination="true"
           data-show-pagination-switch="true"
           data-click-to-select="true">
      <thead>
      <tr>
        <th data-field="state" data-checkbox="true"></th>
        <th data-field="id">ID</th>
        <th data-field="username" data-sortable="true">Username</th>
        <th data-field="email" data-sortable="true">Email</th>
        <th data-field="user_details.first_name">First Name</th>
        <th data-field="user_details.last_name">Last Name</th>
        <th data-field="posts[].title">Title</th>
        <th data-formatter="actionForm" data-formatter-target="#action-table" data-events="actionEvent">Action</th>
        
      </tr>
      </thead>
    </table>
  </div>
  
  <script>
  var $table = $('[data-table]'),
      $remove = $('#remove'),
      selections = [];
  
  $table.on('post-body.bs.table', (e, name, args) => {
    $('.container [title]').tooltip();
  });
  function actionForm(){
    return $(this.formatterTarget).html();
  }
  window.actionEvent = {
    'click .edit': function (e, value, row, index) {
      alert('You click edit action, row: ' + JSON.stringify(row));
    },
    'click .remove': function (e, value, row, index) {
      $table.bootstrapTable('remove', {
        field: 'id',
        values: [row.id]
      });
    }
  };
  </script>


</body>
</html>