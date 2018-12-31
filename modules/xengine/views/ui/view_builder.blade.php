<style>
.widget-items .close,
.widget-droparea .close{
  display: none;
}
.widget-items .draggable,
.widget-droparea .draggable{
  border: 1px solid rgba(100,100,100,.2);
  margin: 10px 0;
  padding: 15px 10px 12px !important;
  min-height:40px;
  position: relative;
}
.widget-items .draggable.highlight,
.widget-droparea .draggable.highlight{
  border-color: rgba(100,100,255,1);
}
.widget-droparea .handler:hover > .close{
  display: inline;
}
.widget-droparea .draggable{
  margin:0;
}
.main-widget .drop-preview{
  background: rgba(200,255,255,1);
}
.widget-items .handler,
.widget-droparea .handler{
  position:absolute;
  top:-3px;
  left:10px;
  right: 10px;
}
</style>
<div class="row no-gutters main-widget" style="height:calc(100vh - 120px)" data-module="builder">
  <div class="col-3 ml-2 widget-items">
    
    <div class="row draggable">
      <div class="handler">Row</div>
      <div class="col draggable">
        <div class="handler">Col</div>
      </div>
      <div class="col draggable">
        <div class="handler">Col</div>
      </div>
      <div class="col draggable">
        <div class="handler">Col</div>
      </div>
    </div>
    <div class="row draggable">
      <div class="handler">Row</div>
    </div>
    <div class="col draggable">
      <div class="handler">Col</div>
    </div>
  </div>
  <div class="col border p-1 ml-2 widget-droparea">
  </div>
</div>
