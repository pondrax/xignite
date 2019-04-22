@include('ui/header')
@include('ui/navbar')
  
  <div class="" style="min-height:200px;background: rgb(10,85,181);
background: linear-gradient(61deg, #ff4c79 35%, #0399bd 100%);">
    <div class="container pb-5 text-white">
      <div class="row justify-content-end">
        <div class="col-auto align-self-end bg-white px-3 py-2  mb-2 shadow border-bottom">
            @include('ui/login_menu')
        </div>
      </div>
      <p>
      </p>
    </div>
  </div>
  <div class="shadow" style="min-height:80vh">
    <div class="container">
      <div class="row">
        <div class="col-md-4 py-3 bg-white shadow">
          <div class="sticky-top px-2 pb-5 mb-5 bg-white">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb mt-2">
                <li class="breadcrumb-item"><a href="@url">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profil</li>
              </ol>
            </nav>
            <h3 class="mt-3 px-2">Profil Anda</h3>
            <h6 class="text-muted px-2">
            Verifikasi akun anda dengan melengkapi data profil pada web cettar  
            </h6>
            <br>
            <img src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22200%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20200%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16a0f2de837%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16a0f2de837%22%3E%3Crect%20width%3D%22200%22%20height%3D%22200%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2274.4296875%22%20y%3D%22104.5%22%3E200x200%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" class="rounded mx-auto d-block" alt="...">
            <br>
            <h4 style=" text-align: center;">{{logged()->name}}</h4>
            
          </div>
        </div>
        <div class="col-md-8 py-4">
          <div class="form-group col-md-12">
            <h5>Input NIK Anda</h5>
            <form id='getnik'>
            <div class="form-inline">
                <input type="text" class="form-control col-md-8" name="nik" aria-describedby="emailHelp" placeholder="Masukkan NIK">
                
            <button type="submit" class="btn btn-primary">CEK NIK</button>
            </div>
            <small id="emailHelp" class="form-text text-muted">harus 16 digit, contoh 3515154707930001</small>
            </form>
            
            <br><br><br>
            
            <!--urlfoto-->
            
            <form action="@url/profil/update" method="post" enctype="multipart/form-data">
              <input type="hidden" id="id" name="id" value="@if(!empty($profil)){{$profil->id}}@endif">
              <input type="hidden" id="nik" name="nik" value="@if(!empty($profil)){{$profil->nik}}@endif">
              <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="@if(!empty($profil)){{$profil->nama_lengkap}}@endif"  placeholder="Masukkan Nama Lengkap Anda">
              </div>
              <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="@if(!empty($profil)){{$profil->tanggal_lahir}}@endif" placeholder="Masukkan Tanggal Lahir Anda">
              </div>
              <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select class="form-control" id="jenis_kelamin" value="@if(!empty($profil)){{$profil->jenis_kelamin}}@endif" name="jenis_kelamin">
                  <option value="LAKI-LAKI">LAKI-LAKI</option>
                  <option value="PEREMPUAN">PEREMPUAN</option>
                </select>
              </div>
              <div class="form-group">
                <label for="tempat_lahir">Tempat Lahir</label>
                <input type="text" class="form-control" id="tempat_lahir" value="@if(!empty($profil)){{$profil->tempat_lahir}}@endif" name="tempat_lahir"  placeholder="Masukkan Tempat Lahir Anda">
              </div>
              <div class="form-group">
                <label for="pendidikan">Pendidikan Terakhir</label>
                <input type="text" class="form-control" id="pendidikan" name="pendidikan" value="@if(!empty($profil)){{$profil->pendidikan}}@endif" placeholder="Masukkan pendidikan Anda">
              </div>
              <div class="form-group">
                <label for="pekerjaan">Pekerjaan Terakhir</label>
                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="@if(!empty($profil)){{$profil->pekerjaan}}@endif"  placeholder="Masukkan pekerjaan Anda">
              </div>
              
              <div class="form-group">
                <label for="nama_lengkap">Tempat Tinggal</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="@if(!empty($profil)){{$profil->alamat}}@endif" placeholder="Masukkan Alamat Anda">
                
                <div class="form-inline" style="margin-top:10px;"> 
                    <input type="text" class="form-control col-md-4" id="rt" name="rt" value="@if(!empty($profil)){{$profil->rt}}@endif"  placeholder="RT">
                    <input type="text" class="form-control col-md-4" id="rw" name="rw" value="@if(!empty($profil)){{$profil->rw}}@endif" placeholder="RW">
                    <input type="text" class="form-control col-md-4" id="dusun" name="dusun" value="@if(!empty($profil)){{$profil->dusun}}@endif"  placeholder="Dusun">
                </div>
                
                <div class="form-inline" style="margin-top:10px;">
                    <input type="text" class="form-control col-md-6" id="kelurahan" name="kelurahan" value="@if(!empty($profil)){{$profil->kelurahan}}@endif"  placeholder="Kelurahan">
                    <input type="text" class="form-control col-md-6" id="kecamatan" name="kecamatan" value="@if(!empty($profil)){{$profil->kecamatan}}@endif"  placeholder="Kecamatan">
                </div>
                
              <div class="form-group">
                <label for="pekerjaan">Provinsi</label>
                <input type="text" class="form-control" id="provinsi" name="provinsi"  value="@if(!empty($profil)){{$profil->provinsi}}@endif" placeholder="Masukkan Provinsi Anda">
              </div>
              <div class="form-group">
                <label for="pekerjaan">Kabupaten/Kota</label>
                <input type="text" class="form-control" id="kabupaten" name="kabupaten" value="@if(!empty($profil)){{$profil->kabupaten}}@endif"  placeholder="Masukkan Kabupaten Anda">
              </div>  
                
                
              </div>
              
              <button type="submit" class="btn btn-primary">Simpan Data</button>
            </form>
          
          
          
          
          
          
          
          </div>
          
          
          
          
          
        </div>
      </div>
    </div>
  </div>
  <script>
     
    var frm = $('#getnik');
    frm.submit(function (ev) {
        var coba;
       
        $.get({
            url: '@url/profil/getdata',
            dataType:'json',
            data: frm.serialize(),
            success: function (data) {
                
                console.log(data);
                
                if(data['pesan']){
                    alert(data['pesan']);
                }else{
                    $('#nama_lengkap').val(data['nama_lengkap']);
                    $('#pendidikan').val(data['pendidikan']);
                    $('#tempat_lahir').val(data['tempat_lahir']);
                    $('#pekerjaan').val(data['pekerjaan']);
                    $('#alamat').val(data['alamat']);
                    $('#rt').val(data['rt']);
                    $('#rw').val(data['rw']);
                    $('#nik').val(data['nik']);
                    $('#kelurahan').val(data['kelurahan']);
                    $('#kecamatan').val(data['kecamatan']);
                    $('#provinsi').val(data['provinsi']);
                    $('#kabupaten').val(data['kabupaten']);
                    $('#jenis_kelamin').val(data['jenis_kelamin']);
                    
                    coba = data['tanggal_lahir'].replace("/", "-");
                    coba =coba.split("-").reverse().join("-");

                    $('#tanggal_lahir').val(coba);
                    
                }
            }
        });
        ev.preventDefault();
    });
      
      
  </script>
  
@include('ui/footer')