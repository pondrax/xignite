<div class="row no-gutters main-widget" style="height:calc(100vh - 120px)" >
  <div class="col-3 widget-items px-1">
    <div class="widget-group p-0 m-0">
      <span class="text-muted">Grid Layout</span>
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
      <pre id="editor" class="code-editor" data-module="builder,editor">Test</pre>
    </form>d
  </div>
</div>
