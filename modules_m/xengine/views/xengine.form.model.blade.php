<form class="card card-body" action="xengine/make_model" method="post">
  <h3 class="m-0">:: Create model :: 
    <nav class="float-right" style="font-size:initial">
      <div class="nav nav-pills">
        <a class="nav-item nav-link active" data-toggle="tab" href="#model-tables">Tables</a>
        <a class="nav-item nav-link" data-toggle="tab" href="#model-relations">Relations</a>
        <a class="nav-item nav-link" data-toggle="tab" href="#model-config">Config</a>
      </div>
    </nav>
  </h3>
  <hr>
  <div class="tab-content">
    <div class="tab-pane fade show active" id="model-tables">
      <div class="row">
        <div class="form-group col">
          <label>Model Path</label>
          <div class="input-group">
            <input class="form-control" name="model_path" placeholder="example/models/example" required>
            <div class="input-group-append">
              <span class="input-group-text">.php</span>
            </div>
          </div>
        </div>
        <div class="form-group col-3">
          <label>Table Name</label>
          <input class="form-control" name="table" placeholder="example_table" required>
        </div>
        <div class="form-group col-2">
          <label>Primary Key</label>
          <input class="form-control" name="primary_key" placeholder="id" value="id" required>
        </div>
      </div>
      <hr class="mt-1">
      <section class="clone">
        <h6>Fields column and rule sets 
          <button type="button" class="btn btn-sm btn-info" onclick="new_set(this)">
            + add
          </button>
        </h6>
        <div class="row">
          <div class="form-group col-2">
            <label>Field</label>
            <input class="form-control" name="field[]" placeholder="Field" value="id">
          </div>
          <div class="form-group col-2">
            <label>Label</label>
            <input class="form-control" name="label[]" placeholder="Label" value="ID">
          </div>
          <div class="form-group col">
            <label>Rules</label>
            <input class="form-control" name="rules[]" placeholder="Rules" value="trim">
          </div>
          <div class="form-group col-2">
            <label>Type</label>
            <input class="form-control" name="type[]" placeholder="Type" value="int">
          </div>
          <div class="form-group col-2">
            <label>Length</label>
            <input class="form-control" name="constraint[]" placeholder="Length" value="11">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-2">
            <input class="form-control" name="field[]" placeholder="Field">
          </div>
          <div class="form-group col-2">
            <input class="form-control" name="label[]" placeholder="Name">
          </div>
          <div class="form-group col">
            <input class="form-control" name="rules[]" placeholder="Rules">
          </div>
          <div class="form-group col-2">
            <input class="form-control" name="type[]" placeholder="Type">
          </div>
          <div class="form-group col-2">
            <input class="form-control" name="constraint[]" placeholder="Length">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-2">
            <input class="form-control" name="field[]" placeholder="Field">
          </div>
          <div class="form-group col-2">
            <input class="form-control" name="label[]" placeholder="Name">
          </div>
          <div class="form-group col">
            <input class="form-control" name="rules[]" placeholder="Rules">
          </div>
          <div class="form-group col-2">
            <input class="form-control" name="type[]" placeholder="Type">
          </div>
          <div class="form-group col-2">
            <input class="form-control" name="constraint[]" placeholder="Length">
          </div>
        </div>
        <div class="row data-clone">
          <div class="form-group col-2">
            <input class="form-control" name="field[]" placeholder="Field">
          </div>
          <div class="form-group col-2">
            <input class="form-control" name="label[]" placeholder="Name">
          </div>
          <div class="form-group col">
            <input class="form-control" name="rules[]" placeholder="Rules">
          </div>
          <div class="form-group col-2">
            <input class="form-control" name="type[]" placeholder="Type">
          </div>
          <div class="form-group col-2">
            <input class="form-control" name="constraint[]" placeholder="Length">
          </div>
        </div>
      </section>
    </div>
    
    
    <div class="tab-pane fade" id="model-relations">
      <section class="clone">
        <h6>Has One
          <button type="button" class="btn btn-sm btn-info" onclick="new_set(this)">
            + add
          </button>
        </h6>
        <div class="row data-clone">
          <div class="form-group col">
            <input class="form-control" name="one_model[]" placeholder="Related model path">
          </div>
          <div class="form-group col-2">
            <input class="form-control" name="one_foreign_key[]" placeholder="Foreign key">
          </div>
          <div class="form-group col-2">
            <input class="form-control" name="one_local_key[]" placeholder="Local key">
          </div>
        </div>
      </section>
      <hr class="mt-0">
      
      <section class="clone">
        <h6>Has Many
          <button type="button" class="btn btn-sm btn-info" onclick="new_set(this)">
            + add
          </button>
        </h6>
        <div class="row data-clone">
          <div class="form-group col">
            <input class="form-control" name="many_model[]" placeholder="Related model path">
          </div>
          <div class="form-group col-2">
            <input class="form-control" name="many_foreign_key[]" placeholder="Foreign key">
          </div>
          <div class="form-group col-2">
            <input class="form-control" name="many_local_key[]" placeholder="Local key">
          </div>
        </div>
      </section>
      <hr class="mt-0">
      
      <section class="clone">
        <h6>Has Many Pivot
          <button type="button" class="btn btn-sm btn-info" onclick="new_set(this)">
            + add
          </button>
        </h6>
        <div class="row data-clone">
          <div class="form-group col">
            <input class="form-control" name="pivot_model[]" placeholder="Related model path">
          </div>
          <div class="form-group col-2">
            <input class="form-control" name="pivot_foreign_key[]" placeholder="Pivot foreign key">
          </div>
          <div class="form-group col-2">
            <input class="form-control" name="pivot_local_key[]" placeholder="Pivot local key">
          </div>
          <div class="form-group col-2">
            <input class="form-control" name="pivot_table[]" placeholder="Pivot table">
          </div>
        </div>
      </section>
    </div>
    <div class="tab-pane fade" id="model-config">
      <h6>Build Timestamps</h6>
      <div class="row px-4">
        <div class="form-group col">
          <input type="checkbox" class="form-check-input" name="created_at" id="create-at" checked>
          <label class="form-check-label" for="create-at">Created At</label>
        </div>
        <div class="form-group col">
          <input type="checkbox" class="form-check-input" name="updated_at" id="deleted-at" checked>
          <label class="form-check-label" for="updated-at">Updated At</label>
        </div>
        <div class="form-group col">
          <input type="checkbox" class="form-check-input" name="deleted_at" id="deleted-at" checked>
          <label class="form-check-label" for="deleted-at">Deleted At</label>
        </div>
      </div>
        <div class="row">
          <div class="col">
            <label>Protected Variable</label>
            <input class="form-control" name="protected" placeholder="Protected Variable" value="created_at,updated_at,deleted_at">
          </div>
        </div>
      <hr>
      <h6>Callback</h6>
      <div class="row">
        <div class="form-group col">
          <input class="form-control" name="before_get" placeholder="Before get">
        </div>
        <div class="form-group col">
          <input class="form-control" name="after_get" placeholder="After get">
        </div>
      </div>
      <div class="row">
        <div class="form-group col">
          <input class="form-control" name="before_create" placeholder="Before create" value="created_at, updated_at">
        </div>
        <div class="form-group col">
          <input class="form-control" name="after_create" placeholder="After create">
        </div>
      </div>
      <div class="row">
        <div class="form-group col">
          <input class="form-control" name="before_update" placeholder="Before update" value="updated_at">
        </div>
        <div class="form-group col">
          <input class="form-control" name="after_update" placeholder="After update">
        </div>
      </div>
    
    </div>
  </div>
    <button type="submit" class="btn btn-success">
      <i class="fas fa-save"></i> Generate
    </button>
</form>
</div>