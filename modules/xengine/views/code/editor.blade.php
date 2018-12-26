<style>
.code-editor{
  height:calc(100% - 60px);
}
</style>
<div class="row no-gutters p-1">
<input class="col form-control mr-1 px-1" value="{{$path}}">
<button class="col-2 btn btn-danger">Simpan</button>
</div>
<pre id="editor" class="code-editor" data-module="editor">{{htmlentities($content)}}</pre>