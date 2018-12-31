<style>
.widget-items,
.widget-droparea{
  min-height: 100%;
  overflow-y: scroll;
}
.widget-items .close,
.widget-droparea .close{
  display: none;
  position: absolute;
  right: 0;
  top: 0;
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
.widget-result{
  width:100%;
  min-height: 200px;
}
</style>
<div class="row no-gutters main-widget" style="height:calc(100vh - 120px)" >
  <div class="col-3 widget-items">
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
    <div class="col-12 draggable">
      <div class="handler">Col Separator</div>
    </div>
  </div>
  <div class="col">
    <div class="p-1 widget-droparea" style="height:100%"></div>
    
    <form style="height:calc(100% - 60px);" action="{{$modulepath}}/save">
      <div class="row no-gutters p-1">
        <input class="col form-control mr-1 px-1" name="path" value="{{$path|''}}">
        <select class="col-2 form-control mr-1" data-theme>
          <option>monokai</option>
          <option>xignite</option>
        </select>
        <textarea name="content" style="display:none"></textarea>
        <button class="col-2 btn btn-danger">Simpan</button>
      </div>
      <pre id="editor" class="code-editor widget-result" data-module="builder,editor">Test</pre>
    </form>d
  </div>
</div>
