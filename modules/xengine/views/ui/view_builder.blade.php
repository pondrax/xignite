<div class="row no-gutters main-widget" style="height:calc(100vh - 110px)" >
  <div class="col-3 widget-items" data-simplebar>
    <div class="widget-group px-1">
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
    </div>
    <div class="widget-group px-1">
      <span class="text-muted">Form Builder</span>
      <div class="form-group col draggable">
        <div class="handler">Form group</div>
        <div class="block draggable">
          <div class="handler" data-content="coba">Label</div>
          <label class="form-label">Label</label>
        </div>
        <div class="block draggable">
          <div class="handler" data-content="coba">Input</div>
          <input type="text" class="form-control" placeholder="Input name">
        </div>
      </div>
    </div>
    <div class="widget-group">
      <span class="text-muted">Form Builder</span>
      <div class="form-group col draggable">
        <div class="handler">Form group</div>
        <div class="block draggable">
          <div class="handler" data-content="coba">Label</div>
          <label class="form-label">Label</label>
        </div>
        <div class="block draggable">
          <div class="handler" data-content="coba">Input</div>
          <input type="text" class="form-control" placeholder="Input name">
        </div>
      </div>
    </div>
    <div class="widget-group">
      <span class="text-muted">Form Builder</span>
      <div class="form-group col draggable">
        <div class="handler">Form group</div>
        <div class="block draggable">
          <div class="handler" data-content="coba">Label</div>
          <label class="form-label">Label</label>
        </div>
        <div class="block draggable">
          <div class="handler" data-content="coba">Input</div>
          <input type="text" class="form-control" placeholder="Input name">
        </div>
      </div>
    </div>
    <div class="widget-group">
      <span class="text-muted">Form Builder</span>
      <div class="form-group col draggable">
        <div class="handler">Form group</div>
        <div class="block draggable">
          <div class="handler" data-content="coba">Label</div>
          <label class="form-label">Label</label>
        </div>
        <div class="block draggable">
          <div class="handler" data-content="coba">Input</div>
          <input type="text" class="form-control" placeholder="Input name">
        </div>
      </div>
    </div>
    <div class="widget-group">
      <span class="text-muted">Form Builder</span>
      <div class="form-group col draggable">
        <div class="handler">Form group</div>
        <div class="block draggable">
          <div class="handler" data-content="coba">Label</div>
          <label class="form-label">Label</label>
        </div>
        <div class="block draggable">
          <div class="handler" data-content="coba">Input</div>
          <input type="text" class="form-control" placeholder="Input name">
        </div>
      </div>
    </div>
    <div class="widget-group">
      <span class="text-muted">Form Builder</span>
      <div class="form-group col draggable">
        <div class="handler">Form group</div>
        <div class="block draggable">
          <div class="handler" data-content="coba">Label</div>
          <label class="form-label">Label</label>
        </div>
        <div class="block draggable">
          <div class="handler" data-content="coba">Input</div>
          <input type="text" class="form-control" placeholder="Input name">
        </div>
      </div>
    </div>
  </div>
  
  <div class="col">
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href=".tab-designer">Designer</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href=".widget-preview">Preview</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href=".widget-result">Result</a>
      </li>
    </ul>
    
    <div class="tab-content border" style="height:calc(100vh - 150px)">
      <div class="tab-pane active tab-designer" style="height:100%" data-simplebar>
        <div class="widget-droparea p-2"></div>
      </div>
      <div class="tab-pane widget-preview"></div>
      <div class="tab-pane widget-result" style="height:100%">
        <form action="{{$modulepath}}/save" style="height:calc(100% - 30px);">
          <div class="row no-gutters p-1">
            <input class="col form-control mr-1 px-1" name="path" value="{{$path|''}}">
            <select class="col-2 form-control mr-1" data-theme>
              <option>monokai</option>
              <option>xignite</option>
            </select>
            <textarea name="content" style="display:none"></textarea>
            <button class="col-2 btn btn-danger">Simpan</button>
          </div>
          <pre id="editor" class="code-editor" data-module="builder,editor"></pre>
        </form>
      <div>
    </div>
    
  </div>
</div>
