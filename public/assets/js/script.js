var $table,
    $form,
    $remove,
    trash,
    progressval,
    action,
    columns,
    title,
    path,
    selections = [];

function initTable(){
  $table  = $('[data-table]');
  $form   = $('[data-form]');
  $remove = $('.remove');
  trash=true;
  
  $('.main-title').text(title);
  if(columns){
    // console.log(columns.length);
    columns[columns.length-1].formatter+=
      '<button class="btn btn-sm btn-success trashed-only restore" title="Restore">'+
      '  <i class="fas fa-undo"></i>'+
      '</button> '+
      '<button class="btn btn-sm btn-danger trashed-only force-delete" title="Force Delete">'+
      '  <i class="fas fa-minus-square"></i>'+
      '</button>';
  }
  
  if(action){
    action['click .restore']= (e, value, row)=>{
      loadModal(
        title='Restore Data',
        body ='Are you sure you want to restore data "'+row.id+'"?',
        footer='<button type="submit" class="btn btn-success" data-url="'+path+'/restore/" data-data="id='+row.id+'">Restore</button>');
    };
    action['click .force-delete']= (e, value, row)=>{
      loadModal(
        title='Force Delete Data',
        body ='Are you sure you want to delete data "'+row.id+'"?',
        footer='<button type="submit" class="btn btn-danger" data-url="'+path+'/remove/force" data-data="id='+row.id+'">Force Delete</button>');
    };
  }
  
  
  $table.bootstrapTable({
    height:getHeight(),
    pageSize: getMaxPage(), 
    url:$table.data('table')+'?'+$table.data('get'),
    pagination:true,
    sidePagination:"server",
    toolbar:'[data-toolbar]',
    search:true,
    striped:true,
    showToggle:true,
    showRefresh:true,
    showColumns:true,
    showExport:true,
    detailView:true,
    detailFormatter:"detailFormatter",
    showPaginationSwitch:true,
    mobileResponsive:true,
    minimumCountColumns:2,
    // clickToSelect:true,
    columns:columns
  });
  
  
  //Add Trash button
  $('.columns.columns-right').append($('<button type="button" class="btn btn-secondary trash" title="View Trash" onclick="trashTable()"><i class="fas fa-trash"> </i> Trash</button>'));
  // $table.on('all.bs.table', (e, name, args) => {
    // console.log(name, args);
  // });
  
  $table.on('post-body.bs.table', (e, name, args) => {
    //Init action toolbar
    for (const key in action){
      const index = key.indexOf(' '),
          name = key.substring(0, index),
          el = key.substring(index + 1),
          func=action[key];
      $('[data-toolbar]').find(el).off(name).on(name,e=>{
        func.apply(this,e);
      })
    }
    $table.find('td button').hide();
    if(!trash){
      $table.find('td button.trashed-only').show();
    }else{
      $table.find('td button:not(.trashed-only)').show();
    }
    $('[title]').tooltip({ trigger: "hover" });
  });
  
  $table.on('check.bs.table uncheck.bs.table ' +
            'check-all.bs.table uncheck-all.bs.table', () => {
    $remove.prop('disabled', !$table.bootstrapTable('getSelections').length);
    selections = getSelections();
  });
  
  $(window).resize(() => {resetView();});
}


function resetView(){
  $table.bootstrapTable('resetView',{height: getHeight()});  
}
function getSelections(){
  return $.map($table.bootstrapTable('getSelections'), ({id}) => id);
}
function getHeight() {
  var height=$(window).height() - 150;
  if(height<500) height=500;
	return height;
}
function getMaxPage() {
  var maxpage=$(window).height()>720?20:10;
	return maxpage;
}

function trashTable(){
  if(trash){
    url=$table.data('table')+'/only_deleted/?'+$table.data('get');
    trash=false;
    $('.trash').addClass('active');
  }else{
    url=$table.data('table')+'/?'+$table.data('get');
    trash=true;
    $('.trash').removeClass('active');
  }
  $table.bootstrapTable('refresh', {url: url});
}


function detailFormatter(index, row) {
  var html = [];
  $.each(row, function (key, value) {
      var str=typeof(value)=="object"?JSON.stringify(value):value;
      html.push('<p><b>' + key + ':</b> ' + str + '</p>');
  });
  return html.join('');
}

function loadView(path){
  progressLoader();
  $('.tooltip').remove();
  $.get(path)
  .done(response=>{
    $('#main-content').html(response);
    removeLoader();
    initTable();
    
    $('#main-content a[data-href]').each(function () {
      $(this).off("click").on("click", function () {
        var $this=$(this);
        loadView($this.data('href'));
        window.history.replaceState({},null,defaultpath);
      });
    });
  });
}


function loadModal(title,body,footer){
  var title =title || 'Title',
      body  =body  || 'Body',
      footer=footer|| 'Footer',
      str=
        '<div id="dynamic-modal" class="modal fade">'+
        '  <div class="modal-dialog modal-lg">'+
        '    <div class="modal-content">'+
        '      <div class="modal-header">'+
        '        <h5 class="modal-title">'+title+'</h5>'+
        '        <button class="close" data-dismiss="modal">&times;</button>'+
        '      </div>'+
        '      <div class="modal-body">'+body+'</div>'+
        '      <div class="modal-footer">'+footer+'</div>'+
        '    </div>'+
        '  </div>'+
        '</div>';
    
  $('body').append(str);
  $('.tooltip').remove();
  $('#dynamic-modal').modal();
  $('#dynamic-modal').on('shown.bs.modal', function () {
    $('#dynamic-modal button[type=submit]').click(function(){
      var url=$(this).data('url'),
          data=$(this).data('data');
      $('#dynamic-modal').modal('hide');
      console.log(data);
      submitForm(url,data);
    });
  });
  $('#dynamic-modal').on('hidden.bs.modal', function (e) {
    $(this).remove();
  });
}


function loadForm(title,url){
  progressLoader();
  var str=
    '<h3>'+
    ' <span class="title"><b>'+title+'</b></span>'+
    ' <button class="close" data-toggle="collapse" data-target="[data-form]">×</button>'+
    '</h3>'+
    '<hr>'+
    '<div class="loading">Loading form, Please wait...</div>';
  $form.html(str);
  $form.collapse('show');
  $.get(url).done((response)=>{
    $('.loading').html(response);
    removeLoader();
    var txt=$('[autofocus]').val();
    $('[autofocus]').focus().val('').val(txt);
    
    $(".datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
    
    $.each($('.selectize'), function (i, el) {
      var $el=$(el),
          options=$.parseJSON($($el.data('options')).html()),
          create,
          plugins,
          maxitems=1,
          onchange;
      if($el.hasClass('selectize-tags')){
        plugins=['remove_button'];
        maxitems=null;
      }
      if($el.hasClass('selectize-create')){
        create=input=>({value:input,text:input});
      }
      if($el.hasClass('selectize-related')){
        // $($el.data('options')).remove();
        onchange=(value)=>{
          var index = options.findIndex((item)=>{return item.text === value}),
              obj=options[index];
          for(key in obj) {
            str=obj[key];
            if(typeof(str)!="object"){              
              $('[name="'+key+'"]').val(str);
            }else{
              // $('[name="'+key+'"]').val(JSON.stringify(str));
              var callback=$el.data('callback');
              window[callback].apply(null,[str]);
            }
          }
        };
      }
      $el.selectize({
        delimiter: ',',
        persist: false,
        create:create,
        options: options,
        plugins: plugins,
        maxItems:maxitems,
        labelField: 'text',
        valueField: 'text',
        onChange:onchange,
      });
    });
    $form.find('form').on('submit',(e)=>{
      e.preventDefault();
      var url=$form.find('form').attr('action')
          data=new FormData($form.find('form')[0]);
      submitForm(url,data);
    });
  });
}

function submitForm(url,data){
  $('.invalid-tooltip').remove();
  loader();
  if(data instanceof FormData){
    $post=$.post({
      url: url,              
      data: data,
      dataType:"json",
      processData:false, 
      contentType: false,
      cache: false,
    })
  }
  else{
    $post=$.post({
      url: url,              
      data: data,
      dataType:"json"
    })
  }
  
  $post.done(response=>{
    // console.log(response);
    if(response.error){
      for(e in response.error){ 
        var el=$('[name='+e+']'),r=response.error[e];
        el.addClass('is-invalid');
        el.closest('.form-group').append('<div class="invalid-tooltip">'+r+'</div>');
      }
      loader('<h6><strong>Warning</strong>. Unable to update.</h6>Error : <br>'+
             '<pre class="text-white">'+JSON.stringify(response.error,null,2)+'</pre>'
             ,'alert-warning',false);
    }else{
      $form.collapse('hide');
      $table.bootstrapTable('refresh');
      loader('<h6><strong>Success</strong>. Data updated.</h6>','alert-success',true);
      $form.find('form').off('submit');
    }
  }).fail(response=>{
    var error=response.responseText;
    loader('<h6><strong>Failed</strong>. Unable to update.</h6>Error : <br>'+error,'alert-danger');
  });
}

function loader(title,state,autoclose){
  var state=state||'alert-info',
      title=title||'<div class="lds-ellipsis">'+
                   '  <div></div><div></div><div></div><div></div>'+
                   '</div>'+
                   '<strong>Loading, please wait...</strong>',
      str='<div class="alert '+state+' alert-dismissible alert-autoclose px-5">'+
          '  <a href="#" class="close" data-dismiss="alert">&times;</a>'+title+
          '</div>';
  $('.loader-spot').html(str);
  if(autoclose){
    removeLoader();
  }
}
function removeLoader(){
  $(".alert-autoclose").fadeTo(2000, 500).slideUp(500, function(){
    $(".alert-autoclose").remove();
  });
  progressval=100;
  setTimeout(()=>{$(".progress-bar").remove()},2500);
}

function progressLoader(){
  var str='<div class="progress-bar progress-bar-striped progress-bar-animated" '+
          'role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" '+
          'style="width:0%"></div>';
  $progress=$('.progress').html(str);
  progressval=0;
  progressAnimate();
}
function progressAnimate(){
  progressval += 5;
  $(".progress-bar").css("width",progressval+"%").attr("aria-valuenow",progressval);    
  if (progressval==25 || progressval==55 || progressval== 85){ 
      return setTimeout(progressAnimate, 500); 
  }
  return progressval >= 100 || setTimeout(progressAnimate, 50);
}

function formatNumber(num){
  return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}
$(()=> {
  $('#sidebarCollapse').on('click', function () {
    $([this,'#sidebar']).toggleClass('active');
    setTimeout(resetView,600);
  });
  
  $('#sidebar a[data-href]').each(function () {
    $(this).off('click').on("click", function () {
      var $this=$(this);
      $('#sidebar .active').removeClass('active');
      $this.closest('li').addClass('active');
      loadView($this.data('href'));
      window.history.replaceState({},null,defaultpath);
    });
  });
  
  loadView(path+'/view');
});