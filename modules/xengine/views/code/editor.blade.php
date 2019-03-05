<style>
.code-editor{
  height:calc(100% - 20px);
}
</style>
<form style="height:calc(100% - 60px)" action="{{$modulepath}}/save">
  <div class="row no-gutters p-1">
    <input class="col form-control mr-1 px-1" name="path" value="{{$path}}">
    <select class="col-2 form-control mr-1" data-theme>
      <option>monokai</option>
      <option>xignite</option>
    </select>
    <textarea name="content" style="display:none"></textarea>
    <button class="col-2 btn btn-danger">Simpan</button>
  </div>
  <pre id="editor" class="code-editor" data-module="editor">{{htmlentities($content)}}</pre>
</form>