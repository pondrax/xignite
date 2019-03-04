<style>
.widget-item{
  border:1px dashed transparent;
  position: relative;
}
.widget-item:hover{
  border-color: rgba(200,200,200,1);
  
}
.widget-item:active>.widget-handlers,
.widget-item:hover>.widget-handlers{
  display: block;
}
.widget-item .widget-handlers{
  position: absolute;
  left:-1px;
  right:-1px;
  top:-20px;
  font-size: 10px;
  padding: 2px 5px;
  display: none;
  cursor:move;
  color: rgba(200,200,200,1);
  background: rgba(255,255,255,1);
  border:1px dashed rgba(200,200,200,1);
}
.widget-item .widget-close{
  float: right;
  font-weight: bold;
  cursor: pointer;
}
.dropable{
  border:1px dotted #ccc;
}
.dropable .placeholder{
color:#ccc;
}
</style>
<div class="row no-gutters main-widget" style="height:calc(100vh - 120px)">
  <div class="col-3 ml-2 widget-items">
    <div class="row p-2">
      <div class="placeholder text-center w-100">Row</div>
    </div>
    <div class="col p-2">
      <div class="placeholder text-center w-100">Col</div>
    </div>
  </div>
  <div class="col border p-0 ml-2">
    <div class="dropable" style="width:100%;height:100%;">   
    </div>
  </div>
</div>


<script>

head(function(){

  Module.builder={
    init:function(){
      let $tab=UI.tab.active();
      //$item=$tab.find('.widget-items>div').wrap('<div id="'+UI.string.random(10000)+'" class="widget-item copy"><div class="widget-content dropable">');
      //$item.closest('.widget-item').prepend('<div class="widget-handlers"><span class="widget-grab">===</span><span class="widget-info"></span><span class="widget-close">x</span>');
      $tab.find('.widget-items>div').each(function(){
        let widget='<div id="'+UI.string.random(10000)+'" class="widget-item copy">'
                  +'  <div class="widget-content">'
                  +$(this).addClass('dropable').prop('outerHTML')
        $(this).html(widget);
      });
      
      $tab.find('.main-widget .widget-item').attr('draggable',true);
      $tab.find('.main-widget').on('dragstart','.widget-item',function(e){
        e.originalEvent.dataTransfer.setData('Text', '#'+this.id);
      });
      $tab.find('.main-widget').on('click','.widget-close',function(){
        $el=$(this).closest('.widget-item');
        $el.remove();
      });
    
      $tab.find('.main-widget').on('drop', '.dropable',function(e) {
        e.preventDefault();
        e.stopPropagation();
        let $el=$(e.originalEvent.dataTransfer.getData('Text')),
            $clone=$el.clone();
        if($el.hasClass('copy')){
          $clone.attr('id',$clone.attr('id')+'-'+UI.string.random(1000000));
          $clone.removeClass('copy');
          $(this).append($clone);
        }else{
          $(this).append($el);
        }
        return false;
      }).on('dragover', false);
    }
  }
  Module.builder.init()
})
</script>