<div class="card shadow">
  <div class="card-body px-4">
    <form class="form cf pengajuan-informasi" action="{{BASE_URL}}xweb/pengajuan_informasi">
      <ul class="nav wizard nav-tabs d-flex mb-5">
        <li class="nav-item flex-fill">
          <a class="nav-link active" data-toggle="tab" href="#step1">Buat Permohonan</a>
        </li>
        <li class="nav-item flex-fill">
          <a class="nav-link disabled" data-toggle="tab" href="#step2">Identitas Diri</a>
        </li>
        <li class="nav-item flex-fill">
          <a class="nav-link disabled" data-toggle="tab" href="#step3">Rincian Informasi</a>
        </li>
        <li class="nav-item flex-fill">
          <a class="nav-link disabled" data-toggle="tab" href="#step4">Selesai</a>
        </li>
      </ul>
      
      <div class="tab-content">
        <div class="tab-pane text-center active" role="tabpanel" id="step1">
        <h5 class="">Permohonan informasi melalui PPID Dinas Peternakan Provinsi Jawa Timur</h5>
        <br>
        <a href="@url/daftar-informasi/laporan-informasi" class="btn btn-outline-primary">Lacak Status Permohonan</a>
        <p class="p-2 m-0"><i>atau</i></p>
        <button type="button" class="btn btn-danger next-step">Buat Permohonan Baru</button>
      </div>
      <div class="tab-pane" role="tabpanel" id="step2">
        <h2 class="pb-3">Isi Identitas diri</h2>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">NIK</label>
          <div class="col-sm-10">
            <input type="text" name="nik" class="form-control" placeholder="NIK">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Nama</label>
          <div class="col-sm-10">
            <input type="text" name="nama" class="form-control"placeholder="Nama">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Alamat</label>
          <div class="col-sm-10">
            <input type="text" name="alamat" class="form-control" placeholder="Alamat">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Telepon</label>
          <div class="col-sm-10">
            <input type="text" name="telepon" class="form-control" placeholder="Telepon">
          </div>
        </div>
        <button type="button" class="btn next-step">Selanjutnya</button>
      </div>
      <div class="tab-pane" role="tabpanel" id="step3">
        <h2 class="pb-2">Permohonan informasi</h2>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label">Rincian informasi yang dibutuhkan</label>
          <div class="col-sm-8">
            <textarea class="form-control" name="rincian_informasi" placeholder="Rincian informasi yang dibutuhkan"></textarea>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-4 col-form-label">Tujuan penggunaan informasi</label>
          <div class="col-sm-8">
            <textarea class="form-control" name="tujuan_informasi" placeholder="Tujuan penggunaan informasi"></textarea>
          </div>
        </div>
        <button type="submit" class="btn next-step">Buat Permohonan</button>
      </div>
      <div class="tab-pane" role="tabpanel" id="step4">
        <h2 class="text-center">Selesai</h2>
        <p class="text-center">
          Pengajuan informasi telah dilakukan, harap tunggu kabar selanjutnya melalui email disnak@jatimprov.go.id
        </p>
      </div>
      <div class="clearfix"></div>
    </div>
  </form>
</div>
<script>
$('.pengajuan-informasi').on('submit',function(e){
  var form = $(this);
  var url = form.attr('action');
  $.post({
           url: url,
           data: form.serialize(),
           success: function(response){
               console.log(response); 
           }
         });

    e.preventDefault();
});
</script>