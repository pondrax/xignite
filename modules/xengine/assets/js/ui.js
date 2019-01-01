let UI={
  init:function(){
    $("#main>.nav-tabs").on("click", ".close", function(ev){UI.tab.remove(this,ev)});
    $('.add-tab').click(UI.tab.load);
  },
  //Module loader
  module:{
    load:function(){
      UI.tab.active().find('[data-module]').each(function(){
        if($(this).data('module')!==undefined){
          let module=$(this).data('module').split(',');
          $.each(module,function(i,v){
              console.log(v);
            UI.module.name.push(v);
            eval('Module.'+v+'.load()');
          })
        }
      })
    },
    name:[]
  },
  //UI Progress bar
  message:{
    load:function(title,state,autoclose){
      state=state||'alert-info',
      title=title||'<div class="lds-ellipsis">'+
                       '  <div></div><div></div><div></div><div></div>'+
                       '</div>'+
                       '<strong>Loading, please wait...</strong>';
      let str='<div class="alert '+state+' alert-dismissible alert-autoclose fixed-bottom m-4 w-md-25" style="right:0; left:auto; max-height:300px; max-width:500px; overflow-y:auto">'+
              '  <a href="#" class="close" data-dismiss="alert">&times;</a>'+title+
              '</div>';
              
      $('#loader').html(str);
      this.bar();
      if(autoclose){
        UI.message.remove();
      }
    },
    bar:function(){
      let bar='<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%;height:5px"></div>';
      $('#loader').prepend(bar);
      this.progress=0;
      this.animate();
    },
    animate:function(){
      this.progress += 5;
      $(".progress-bar").css("width",this.progress+"%").attr("aria-valuenow",this.progress);    
      if (this.progress==25 || this.progress==55 || this.progress== 85){ 
          return setTimeout(function(){UI.message.animate()}, 500); 
      }
      return this.progress >= 100 || setTimeout(function(){UI.message.animate()}, 50);
    },
    remove:function(){
      $(".alert-autoclose").fadeTo(2000, 500).slideUp(500, function(){
        $(".alert-autoclose").remove();
      });
      this.progress=100;
      setTimeout(function(){$(".progress-bar").remove()},2500);
    }
  },
  //UI Tabs 
  tab:{
    reload:function(href,data){
      UI.message.load();
      $.get(href,data).done(function(response){
        UI.tab.active().html(response);
        UI.module.load();
        UI.message.remove();
      }).fail(function(response){
        var error=response.responseText;
        UI.message.load('<h6><strong>Failed</strong>. Unable to load.</h6><br>'+error,'alert-danger');        
      });      
    },
    load:function(){
      let main=$('#main'),
          nav=main.find('.nav-tabs'),
          content=main.find('.tab-content'),
          tab = 'tab'+UI.string.random(10000),
          href=$(this).data('href'),
          title=$(this).text();
      content.append('<div class="tab-pane" id="'+tab+'" style="height:100%;overflow:auto"></div>');
      nav.append(
        '<li class="nav-item">'+
        '  <a class="nav-link" data-toggle="tab" href="#'+tab+'">'+
             title+'<span class="ml-2 close">×</span>'+
        '  </a>'+
        '</li>');
      nav.find('li:last a').click();
      UI.tab.reload(href,'');
    },
    remove:function(el,e){
      e.preventDefault();
      e.stopPropagation();
      let $el=$(el).closest('a');
      $el.closest('.nav-tabs').find('li:first a').click();
      $el.closest('.nav-item').remove();
      $($el.attr('href')).remove();
    },
    refresh:function(){
      $('.tooltip').remove();
      $('[data-title],[title]').tooltip({ trigger: "hover" });
    },
    active:function(){
      return $('.tab-pane.active');
    }
  },
  //String helper
  string:{
    render:function(str,obj){
      if(typeof str=='string'){
        str=str.replace(/`/g,'"');
        return str.replace(/{(.+?)}/g, function(m, key){return obj[key]||''})
      }
    },
    random:function(str){
      return parseInt(Math.random()*str);
    }
  },
  number:{
    locale:function(input){
      input=parseInt(this.reset(input));
      // console.log(isNaN(input));
      return (isNaN(input))?"":input.toLocaleString("id-ID"); 
    },
    reset:function(input){
      input=input.replace(/\./g,'');
      return input;
    }
  },
  setAccess:function(access){
    console.log(access);
    if(access!==''){
      access=access.split(',');
      for (var i in access){
        UI.tab.active().find('.'+access[i]).removeClass(access[i]);
      }
    }else{
      UI.tab.active().find('.readable, .writable, .deletable, trashed-only').remove();
    }
  },
};

let Module={
  table:{
    load:function(){
      head.load(path.css+'/lib/bootstrap-table.min.css');
      head.load(path.css+'/lib/bootstrap-table-group-by.css');
      head.load(path.js+'/lib/bootstrap-table.min.js');
      head.load(path.js+'/lib/bootstrap-table-locale-id.js');
      head.load(path.js+'/lib/bootstrap-table-export.js');
      // head.load(path.js+'/lib/bootstrap-table-group-by.js');
      head.load(path.js+'/lib/tableExport.min.js');
      UI.module.name.push('table');
      head(function(){Module.table.init()});
    },
    find:function(el){
      return UI.tab.active().find(el);
    },
    setProp:function(){
      UI.tab.refresh();
      this.table=this.find('[data-table]');
      this.toolbar=this.find('[data-toolbar]');
      this.trashed=false;
      return this;
    },
    init:function(){
      this.setProp();
      // console.log(this.table.data('table'));
      this.table.bootstrapTable({
        height:this.getHeight(),
        pageSize: this.getHeight()>700?20:10, 
        url:this.table.data('table')+'/view/data?'+this.table.data('get'),
        pagination:true,
        sidePagination:"server",
        toolbar:this.toolbar,
        locale:'id-ID',
        search:true,
        striped:true,
        showToggle:true,
        showRefresh:true,
        showColumns:true,
        // showFullscreen:true,
        showExport:true,
        detailView:true,
        detailFormatter:this.detail,
        showPaginationSwitch:true,
        mobileResponsive:true,
        minimumCountColumns:2,
        // clickToSelect:true,
      });
      if(typeof this.table.bootstrapTable("getOptions")['columns'][0] !==undefined){
          let columns=this.table.bootstrapTable("getOptions")['columns'][0];
          for (i in columns){
            if(columns[i].events=='action'){
              columns[i].events=Module.table.action;
            }
            if(columns[i].format){
              columns[i].formatter=Module.table.formatter;
            }
          }
          console.log(columns)
          columns[columns.length-1].formatter+=
            '<button class="btn btn-sm btn-success trashed-only"  data-action="modal" data-title="Kembalikan Data" data-body="Apakah anda yakin mengembalikan data terpilih `<b>{id}</b>`" data-footer="<button data-url=`{_path}/restore` data-data=`id={id}` class=`btn btn-success` type=`submit`>Kembalikan</button>" >'+
            '  <i class="fas fa-undo"></i>'+
            '</button> '+
            '<button class="btn btn-sm btn-danger trashed-only" data-action="modal" data-title="Paksa hapus data" data-body="Apakah anda yakin menghapus paksa data terpilih `<b>{id}</b>`" data-footer="<button data-url=`{_path}/remove/true` data-data=`id={id}` class=`btn btn-danger` type=`submit`>Paksa Hapus</button>" >'+
            '  <i class="fas fa-minus-square"></i>'+
            '</button>';
            
          this.table.bootstrapTable("refreshOptions", {'columns' : columns});
      }
      UI.tab.active().find('.columns.columns-right').append($('<button type="button" class="btn btn-secondary trash" title="Lihat sampah" onclick="Module.table.trash(this) "><i class="fas fa-trash"> </i></button>'));
      
      this.toolbar.append(
        '<div class="btn dropdown p-0">'
       +'  <button type="button" class="btn btn-secondary dropdown-toggle selection" data-toggle="dropdown" disabled>'
       +'    <i class="fas fa-list"></i>  Aksi baris terpilih'
       +'  </button>'
       +'  <div class="dropdown-menu">'
       +'    <a class="dropdown-item writable" href="#" data-action="form" data-title="Ubah data terpilih" data-url="{_path}/form/" data-get="id={selections}" >'
       +'      Ubah Data'
       +'    </a>'
       +'    <a class="dropdown-item writable" href="#" data-action="form" data-title="Duplikasi data terpilih" data-url="{_path}/form/copy" data-get="id={selections}" >'
       +'      Duplikasi Data'
       +'    </a>'
       +'    <a class="dropdown-item deletable" href="#" data-action="modal" data-title="Hapus data" data-body="Apakah anda yakin menghapus data terpilih `<b>{selections}</b>`" data-footer="<button data-url=`{_path}/remove` data-data=`id={selections}` class=`btn btn-danger` type=`submit`>Hapus</button>" >'
       +'      Hapus Data'
       +'    </a>'
       +'    <a class="dropdown-item trashed-only" href="#" data-action="modal" data-title="Kembalikan Data" data-body="Apakah anda yakin mengembalikan data terpilih `<b>{selections}</b>`" data-footer="<button data-url=`{_path}/restore` data-data=`id={selections}` class=`btn btn-success` type=`submit`>Kembalikan</button>" >'
       +'      Kembalikan Data'
       +'    </a>'
       +'    <a class="dropdown-item bg-danger trashed-only" href="#" data-action="modal" data-title="Paksa hapus data" data-body="Apakah anda yakin menghapus paksa data terpilih `<b>{selections}</b>`" data-footer="<button data-url=`{_path}/remove/true` data-data=`id={selections}` class=`btn btn-danger` type=`submit`>Paksa Hapus</button>" >'
       +'      Paksa Hapus Data'
       +'    </a>'
       +'  </div>'
       +'</div>'
      );
      this.actionToolbar();
      
      let access=this.table.data('access');
      this.table.on('post-body.bs.table', (e, name, args) => {
        UI.tab.refresh();
        UI.setAccess(access);
        
        let table=UI.tab.active().find('[data-table]'),
            toolbar=UI.tab.active().find('[data-toolbar]');
        toolbar.find('a.dropdown-item').hide();
        table.find('td button').hide();
        
        if(!Module.table.trashed){
          toolbar.find('.dropdown-item:not(.trashed-only)').show();
          table.find('td button:not(.trashed-only)').show();
        }
        else{
          toolbar.find('.trashed-only').show();
          table.find('td button.trashed-only').show();
        }
      })
      this.table.on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table', function(){
        Module.table.find('[data-toolbar] .selection')
          .prop('disabled', !Module.table.getSelection().length);
      });
      
      $(window).resize(() => {Module.table.resetView();});
    },
    detail:function(i,json){
      // console.log(i,json);
      return Module.tree.create(json);
    },
    action:{
      'click [data-action]':function(e,value,row,index){
        let $el=$(this),
            data=$(this).data();
        row._path=Module.table.setProp().table.data('table');
        for(var i in data){
          data[i]=UI.string.render(data[i],row);
        }
        // console.log(data)
        if(!$el.hasClass('disabled')){
          if(data.action=='modal'){
            Module.modal.open(data.title,data.body,data.footer);
          }
          if(data.action=='form'){
            Module.form.open(data.title,data.url,data.get)
          }
          if(data.action=='load'){
            UI.tab.reload(data.url,data.get)
          }
        }
      }
    },
    actionToolbar:function(){
      this.toolbar.on('click','[data-action]',function(e){
        let $el=$(this),
            data=$(this).data();
            tmp={},
            row={
              selections:Module.table.getSelection().toString(),
              _path:Module.table.setProp().table.data('table')
            };
            
        for(var i in data){
          tmp[i]=UI.string.render(data[i],row);
        }
        data=tmp;
        if(!$el.hasClass('disabled')){
          if(data.action=='modal'){
            Module.modal.open(data.title,data.body,data.footer);
          }
          if(data.action=='form'){
            Module.form.open(data.title,data.url,data.get)
          }
        }
      });      
    },
    formatter:function(item,row){
      return UI.string.render(this.format,row);
    },
    refresh:function(){
      this.setProp().table.bootstrapTable('refresh');
    },
    resetView:function(){
      this.table.bootstrapTable('resetView',{height: this.getHeight()}); 
    },
    getHeight:function(){
      return UI.tab.active().parent().height()-60;
    },
    getSelection:function(){
      return $.map(this.table.bootstrapTable('getSelections'), ({id}) => id);
    },
    trash:function(el){
      let table=UI.tab.active().find('[data-table]'),
          toolbar=UI.tab.active().find('[data-toolbar]'),
          url;
      toolbar.find('a.dropdown-item').hide();
      table.find('td button').hide();
      
      if(this.trashed){
        this.trashed=false;
        $(el).removeClass('active');
        toolbar.find('.dropdown-item:not(.trashed-only)').show();
        table.find('td button:not(.trashed-only)').show();
        
        url=table.data('table')+'/view/data?'+table.data('get');
      }
      else{
        this.trashed=true;
        $(el).addClass('active');
        toolbar.find('.trashed-only').show();
        table.find('td button.trashed-only').show();
        url=table.data('table')+'/view/data/only_deleted/?'+table.data('get');
      }
      
      table.bootstrapTable('refresh', {url: url});
      return this;
    }
  },
  form:{
    load:function(){
      head.load(path.css+'/lib/summernote.css');
      head.load(path.css+'/lib/selectize.css');
      head.load(path.js+'/lib/summernote.min.js');
      head.load(path.js+'/lib/summernote-gallery-extension.js');
      head.load(path.js+'/lib/selectize.min.js');
      
      UI.module.name.push('form');
      this.selectize=[];
      head(function(){Module.form.init()});
    },
    find:function(el){
      this.setProp();
      return this.form.find(el);
    },
    setSelectize:function(obj){
      let id=UI.tab.active().attr('id');
      this.selectize[id]=obj;
      // console.log(this.selectize);
    },
    getSelectize:function(){
      let id=UI.tab.active().attr('id');
      return this.selectize[id];
    },
    setProp:function(){
      UI.tab.refresh();
      this.form=UI.tab.active().find('[data-form]');
      UI.tab.active().off('click').on('click','.reload-tab',function(){
        let data=$(this).data();
        UI.tab.reload(data.url,data.get);
      });
      return this;
    },
    init:function(){
      this.setProp();
      this.find('.summernote').summernote({
        height:200,
        toolbar:[
            ['style', ['style']],
            ['fontname', ['fontname']],
            ['fontsize', ['fontsize']],
            ['fontstyle', ['bold', 'italic', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']], 
            ['insert', ['table', 'hr']],
            ['insert', ['link', 'gallery', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview']],
            ['help', ['help']],
          ],
        callbacks :{
           onInit: function() {
            // $(this).data('image_dialog_images_html', '<div class="row"..');
            $(this).data('image_dialog_images_url', path.url+"/media/picker");
            $(this).data('image_dialog_title', "Galeri Gambar");
            $(this).data('image_dialog_close_btn_text', "Batal");
            $(this).data('image_dialog_ok_btn_text', "Tambahkan Gambar");
          }
        }
      });
      // $('.note-editable').css('font-family','Times New Roman');
      // $('.note-editable').css('font-size','12px');
      
      $.each(this.find('.selectize'), function (i, el) {
        var $el=$(el),
            data=Module.form.getSelectize()[$el.data('options')],
            setCreate,
            setPlugins,
            setMax=1,
            setRelated,
            resetRelated;
        // console.log(data);
        resetRelated=(value)=>{
          for (var key of Object.keys(data[0])){
            if(key!='text' && key!='value'){
              $('[name="'+key+'"]').val('');
            }
          }
        };
        
        if($el.hasClass('selectize-tags')){
          setPlugins=['remove_button'];
          setMax=null;
        }
        if($el.hasClass('selectize-create')){
          setCreate=(input)=>({
            value:input, text:input
          });
        }
        if($el.hasClass('selectize-related')){
          setRelated=(value)=>{
            var index = data.findIndex((item)=>{ return item.value === value }),
                obj=data[index];
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
          options: data,
          create:setCreate,
          plugins: setPlugins,
          maxItems:setMax,
          // labelField: 'text',
          // valueField: 'value',
          onInitialize:()=>{
            //console.log(this)
          },
          onChange:setRelated,
          onItemRemove:resetRelated,
          // onOptionAdd:resetRelated,
        });
      });
      this.find('[data-number]').on('keyup',function(){
        var selection = window.getSelection().toString(); 
        if (selection !== '') {
            return; 
        }       
        // When the arrow keys are pressed, abort.
        if ($.inArray(event.keyCode, [38, 40, 37, 39]) !== -1) {
            return; 
        }       
        var $this = $(this);            
        // Get the value.
        var input = $this.val();            
        var input = input.replace(/[\D\s\._\ - ] +/g, "");
        $this.val(UI.number.locale(input)); 
      })
      this.form.off('submit').on('submit',function(e){Module.form.prepare(e)});
    },
    open:function(title,url,data){
      this.setProp();
      // console.log(this.form);
      let str=
          '<h3">'+
          ' <span class="title"><b>'+title+'</b></span>'+
          ' <button class="close" data-toggle="collapse" data-target="#'+UI.tab.active().attr('id')+' [data-form]">×</button>'+
          '</h3>'+
          '<div class="form"></div>';
          // console.log(data);
      this.form.html(str);
      this.form.collapse('show');
      UI.message.load();
      $.get(url,data).done(function(response){
        Module.form.find('.form').html(response);
        Module.form.init();
        UI.message.remove();
        Module.grab();
      }).fail(function(response){
        var error=response.responseText;
        UI.message.load('<h6><strong>Failed</strong>. Unable to load.</h6><br>'+error,'alert-danger');        
      });      
    },  
    read:function(input,el) {
      if (input.files && input.files[0]) {
        let $el=$(input).parent().find(el);
        $el.attr('src',URL.createObjectURL(input.files[0]));
        $el.on('load',function(){
          Module.form.frameset($el);
        });
      }
    },
    frameset:function(el){
      let $el=$(el),
          obj=$el.contents().find('body').children()
              .attr('style','height:100%;width:100%;object-fit:contain');
      $el.parent().find('button').off('click').on('click',function(){
        Module.modal.open('Preview',$('<div>').html(obj.clone()).html(),' ');
      });
      $el.parent().find('button').prop('disabled',false);
    },
    prepare:function(e){
      e.preventDefault();
      let formdata=new FormData(),
          form=Module.form.find('form');
      form.each(function(i){
        $(this).find('[name]').each(function(){
          let $el=$(this),
              name=$el.attr('name'),
              target=name+'['+i+']';
          if(name!='files'){
            if($el.attr('type')=='file'){
              if($el[0].files[0]!=undefined){
                formdata.append(target,$el[0].files[0]);
              }else{
                var file=new File([""], "empty");
                formdata.append(target,file);
              }
            }else{
              if(name.indexOf('[]')>-1){
                // console.log(name);
                if($el.is(':checked')){
                  formdata.append(i+'['+name.split('[]')[0]+'][]',$el.val());
                }
              }else{
                formdata.append(i+'['+name+']',$el.val());
              }
            }
          }
        })
      })
      Module.form.submit(form.attr('action'),formdata);
    },
    submit:function(url,data){
      // console.log(data);
      let $post;
      if(data instanceof FormData){
        $post=$.post({
          async: false,
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
          async: false,
          url: url,              
          data: data,
          dataType:"json"
        })
      }
      UI.message.load();
      $post.done(response=>{
        // console.log(response);
        if(response.error){        
          console.log(response.error);

          UI.tab.active().find('.is-invalid').removeClass('is-invalid');
          for(e in response.error){ 
            // console.log(e);
            var el, r=UI.string.render(response.error[e],{});
            if(UI.tab.active().find('[name='+e+']').length){
              el=UI.tab.active().find('[name='+e+']');
            }else{
              // console.log(el.length);
              el=UI.tab.active().find('[name$=__'+e+']');
            }
            el.addClass('is-invalid');
            el.closest('.form-group').find('.selectize-input').addClass('is-invalid');
            el.closest('.form-group').append('<div class="invalid-tooltip">'+r+'</div>');
          }
          UI.message.load('<h6><strong>Warning</strong>. Tidak bisa menyimpan data.</h6><br>'+
             '<pre class="text-white">'+JSON.stringify(response.error,null,2)+'</pre>'
             ,'alert-warning',false);
        }else{
          Module.form.setProp().form.collapse('hide');
          if(UI.module.name.includes('table')){
            Module.table.refresh();
          }            
          UI.message.load('<h6><strong>Success</strong>. Data tersimpan.</h6>','alert-success',true);
        }
      }).fail(function(response){
        var error=response.responseText;
        UI.message.load('<h6><strong>Failed</strong>. Tidak bisa memperbarui data.</h6><br>'+error,'alert-danger');
        
      })
    },
  },
  modal:{
    open:function(title,body,footer){
      var title =title || 'Title',
          body  =body  || 'Body',
          footer=footer|| 'Footer',
          str=
            '<div id="open-modal" class="modal fade">'+
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
      $('#open-modal').modal();
      $('#open-modal').on('shown.bs.modal', function () {
        $('#open-modal button[type=submit]').click(function(){
          $('#open-modal').modal('hide');
          let obj=$(this).data();
          Module.form.submit(obj.url,obj.data);
        });
      });
      $('#open-modal').on('hidden.bs.modal', function (e) {
        $(this).remove();
      });
    },
  },
  tree:{
    create:function(json){
      var html = '<ul>';
      var hide=['created_at','updated_at','deleted_at','state'];
      for(var key in json){
        value=json[key];
        if(hide.indexOf(key)<0){
          if(typeof value == 'object'){
            html += '<li>'+ key +' : ' + Module.tree.create(value)+'</li>';
          }else {
            valu=value!=''?value:'-';
            html += '<li>'+ key +' : '+ value +'</li>';
          }
        }
      }
      return html+'</ul>';

    }
  },
  filterbox:{
    filter:function(el){
      var value = UI.tab.active().find(el).val().toLowerCase();
      UI.tab.active().find(".table-filter tbody > tr").each(function() {
        // console.log($(this).text());
          if ($(this).text().toLowerCase().search(value) > -1) {
              $(this).show();
          }
          else {
              $(this).hide();
          }
      });
    },
    toggleCheck:function(el,name){
      let rows=UI.tab.active().find('input[name="'+name+'[]"]').closest('tr:visible');
      return rows.find('input[name="'+name+'[]"]').prop('checked',el.checked);   
    },
    toggleCheckChild:function(el){
      // console.log(el);
      return UI.tab.active().find(el).closest('tr').find('input:checkbox').prop('checked',el.checked);      
    }
  },
  grab:function(){
    $(".grab").mousedown(function (e) {
      console.log(e);
      var tr = $(e.target).closest("TR"), si = tr.index(), sy = e.pageY, b = $(document.body), drag;
      if (si == -1) return;
      b.addClass("grabCursor").css("userSelect", "none");
      tr.addClass("grabbed");
      function move (e) {
          if (!drag && Math.abs(e.pageY - sy) < 10) return;
          drag = true;
          tr.siblings().each(function() {
              var s = $(this), i = s.index(), y = s.offset().top;
              if (i >= 0 && e.pageY >= y && e.pageY < y + s.outerHeight()) {
                  if (i < tr.index())
                      s.insertAfter(tr);
                  else
                      s.insertBefore(tr);
                  return false;
              }
          });
      }
      function up (e) {
          if (drag && si != tr.index()) {
              drag = false;
              // alert("moved!");
          }
          $(document).unbind("mousemove", move).unbind("mouseup", up);
          b.removeClass("grabCursor").css("userSelect", "none");
          tr.removeClass("grabbed");
      }
      $(document).mousemove(move).mouseup(up);
    });
  },
  setYear:function(el){
    // console.log($(el).val());
    console.log(el);
    Module.form.submit(el,'');
    window.location.reload();
  },
  editor:{
    load:function(){
      head.load(path.js+'/lib/ace/ace.js');
      head.load(path.js+'/lib/ace/ext-modelist.js');
      head.load(path.js+'/lib/ace/ext-beautify.js');
      head.load(path.js+'/lib/ace/ext-language_tools.js');
      this.editor=[];
      head(function(){
        Module.editor.init()
      });
    },
    init:function(){
      let id=UI.tab.active().attr('id');
      let form=UI.tab.active().find('form');
      UI.tab.active().find('[data-module]').attr('id','editor-'+id);
      
      let editor = ace.edit("editor-"+id),
          modelist = ace.require("ace/ext/modelist"),
          filepath=UI.tab.active().find('[name=path]').val(),
          mode='ace/mode/html';
      if(filepath!==''){
        mode=modelist.getModeForPath(filepath).mode;
      console.log(filepath)
      }
          
      editor.setTheme("ace/theme/monokai");
      editor.session.setMode(mode);
      editor.setDisplayIndentGuides(true);
      editor.getSession().setUseWrapMode(true);  
      // enable autocompletion and snippets
      editor.setOptions({
        tabSize: 2,
        useSoftTabs: true,
        enableBasicAutocompletion: true,
        enableSnippets: true,
        enableLiveAutocompletion: false
      });
      editor.commands.addCommand({
        name: 'save',
        bindKey: {win: "Ctrl-S", "mac": "Cmd-S"},
        exec: function(editor) {
          // console.log("saving", editor.session.getValue())
          form.submit();
        }
      })
      editor.commands.on("afterExec", function(e){
        if (e.command.name == "insertstring"&&/^[\w.]$/.test(e.args)) {
        editor.execCommand("startAutocomplete")
        }
      })
      UI.tab.active().find('[data-theme]').on('change',function(){
        editor.setTheme("ace/theme/"+$(this).val());
      });
      form.on('submit',function(e){
        e.preventDefault();
        UI.tab.active().find('[name=content]').val(editor.getValue());
        // console.log(editor.getValue());
        Module.form.submit(form.attr('action'),form.serialize());
      });
      this.editor[UI.tab.active().attr('id')]=editor;
    },
    setValue:function(str){
      let editor=this.editor[UI.tab.active().attr('id')];
      // console.log(editor)
      var beautify = ace.require("ace/ext/beautify"); 
      editor.getSession().setValue(str);
      beautify.beautify(editor.session);
    }
  },
  builder:{
    load:function(){
      head(Module.builder.init)
    },
    init:function(){
      let $tab=UI.tab.active(),
          $transfer=[];
      
      $tab.find('.draggable').attr('draggable',true).addClass('copy')
      
      $tab.find('.main-widget').on('mouseover','.draggable',function(e){
        e.stopPropagation()
        $(this).addClass('highlight');
      }).on('mouseout','.draggable',function(){
        $('.highlight').removeClass('highlight');
        $('.drop-preview').removeClass('drop-preview');
      }).on('click','.close',function(){
        $(this).closest('.draggable').remove();
      }).on('dragstart','.draggable',function(e){
        e.stopPropagation();
        $transfer[0]=$(this);
        console.log('drag',this)
        e.originalEvent.dataTransfer.setData("Text",0);
      }).on('drop', '.widget-droparea,.droppable',function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        let $el=$($transfer[e.originalEvent.dataTransfer.getData("Text")]), $clone=$el.clone();
        console.log(this)
        if($el.hasClass('copy')|| e.ctrlKey){
          $(this).append($clone);
        }else{
          $(this).append($el);
        }
        
        $tab.find('.widget-droparea .draggable').each(function(){
          let $this=$(this),$handler=$this.find('.handler');
          $this.removeClass('copy');
          if($this.hasClass('block')){
            $this=$this.find('.handler').siblings();
          }else{
            $this.addClass('droppable');
          }
          tagname=$this.prop('tagName').toLowerCase();
          idname=''||$this.prop('id')
          classname=''||'.'+$this.attr('class').replace(/\s+/g,'.')
                   .replace(/.draggable|.highlight|.droppable|.drop-preview|.copy/g,'')
          $handler.html('<small><span class="text-primary">'+tagname+'</span>'
                                    +'<span class="text-info">'+idname+'</span>'
                                    +'<span class="text-danger">'+classname+'</span></small>'
                                    +'<span class="close">&times;</span>');
        })
        return false;
      }).on('dragover', false)
      .on('dragenter', '.widget-droparea,.droppable',function(e){
        e.stopPropagation();
        $('.drop-preview').removeClass('drop-preview');
        $(this).addClass('drop-preview');
      })
      // var target = $tab.find('.main-widget')
      // create an observer instance
      let droparea         = $tab.find(".main-widget .widget-droparea");
      //var MutationObserver    = window.MutationObserver || window.WebKitMutationObserver;
      let myObserver          = new MutationObserver (function(mutations){
        // console.log(droparea.html())
        let $el=droparea.clone();
        $el.find('.draggable').removeAttr('draggable')
          .removeClass('draggable highlight droppable drop-preview copy grid');
          // console.log($drag.attr('class'))
        $el.find('.block>*').unwrap()
        $el.find('.handler').remove()
        Module.editor.setValue($el.html().replace(/^\s*\n/gm,''))
      });
      droparea.each ( function () {
        myObserver.observe (this, {childList: true, characterData: true, attributes: true});
      } );
      // var observer = new MutationObserver(function(mutations) {
      //   console.log(target.text());   
      // });
      // configuration of the observer:
      // var config = { attributes: true, childList: true, characterData: true };
      // pass in the target node, as well as the observer options
      // observer.observe(target, config);
      // .on('DOMNodeInserted','.widget-droparea', function() {
      //   let $el=$(this).clone();
      //   $el.find('.draggable').removeAttr('draggable')
      //     .removeClass('draggable highlight droppable drop-preview copy grid');
      //     // console.log($drag.attr('class'))
      //   $el.find('.block>*').unwrap()
      //   $el.find('.handler').remove()
      //   Module.editor.setValue($el.html().replace(/^\s*\n/gm,''))
      // });
    }
  }
}