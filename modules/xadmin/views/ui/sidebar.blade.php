<div class="text-center pt-3">
  <img src="@asset/img/logo.png" align="center" class="logo shadow-sm px-5 pb-2" style="width:80%">
  <h3 class="px-3 py-1 shadow-sm">{{APP_NAME}}</h3>
</div>
<div class="px-4 pb-2 shadow-sm">
<select class="form-control" onchange="Module.setYear('@url/set_year/'+this.value)">
  @foreach($daftar_periode as $p)
  <option value="{{$p->value}}"  @if($p->value==$logged->id_tahun) selected @endif>Tahun {{$p->text}}</option>
  @endforeach
</select>
</div>
<ul class="nav flex-column px-4 py-3">
  <li>
    <a href="#" data-toggle="collapse" data-target="#laporan">
      <i class="fas fa-file-contract px-1"></i> Laporan
    </a>
    <ul id="laporan" class="collapse show pl-4">
      @if(read_modul('bab1'))
      <li>
        <a href="#" data-toggle="collapse" data-target="#laporan-1">BAB I</a>
        <ul id="laporan-1" class="collapse pl-4">      
          <li>
            <a class="add-tab" href="#" data-href="@url/xadmin/bab_i/laporan/view">
              Laporan :: BAB I
            </a>
          </li>  
          @if(read_modul('master'))
          <li>
            <a class="add-tab" href="#" data-href="@url/xadmin/bab_i/pengisi/view">
              Master :: BAB I
            </a>
          </li>
          @endif
        </ul>
      </li>   
      @endif
      @if(read_modul('bab2'))
      <li>
        <a href="#" data-toggle="collapse" data-target="#laporan-2">BAB II</a>
        <ul id="laporan-2" class="collapse pl-4">
          <li>
            <a class="add-tab" href="#" data-href="@url/xadmin/bab_ii/laporan/view">
              Laporan :: BAB II
            </a>
          </li>
          @if(read_modul('master'))
          <li>
            <a class="add-tab" href="#" data-href="@url/xadmin/bab_ii/pengisi/view">
              Master :: BAB II
            </a>
          </li>
          @endif
        </ul>
      </li>   
      @endif
      @if(read_modul('bab3'))
      <li>
        <a href="#" data-toggle="collapse" data-target="#laporan-3">BAB III</a>
        <ul id="laporan-3" class="collapse pl-4">
          <li>
            <a class="add-tab" href="#" data-href="@url/xadmin/bab_iii/laporan/view">
              Laporan :: BAB III
            </a>
          </li>
          @if(read_modul('master'))
          <li>
            <a class="add-tab" href="#" data-href="@url/xadmin/bab_iii/pengisi/view">
              Master :: BAB III
            </a>
          </li>
          @endif
        </ul>
      </li>   
      @endif
      @if(read_modul('bab4'))
      <li>
        <a href="#" data-toggle="collapse" data-target="#laporan-4">BAB IV</a>
        <ul id="laporan-4" class="collapse pl-4">
          <li>
            <a class="add-tab" href="#" data-href="@url/xadmin/bab_iv/laporan/view">
              Laporan :: BAB IV
            </a>
          </li>  
          <li>
            <a class="add-tab" href="#" data-href="@url/xadmin/bab_iv/deskripsi/view">
              Deskripsi :: BAB IV
            </a>
          </li>
          <li>
            <a class="add-tab" href="#" data-href="@url/xadmin/bab_iv/sasaran/view">
              Sasaran :: BAB IV
            </a>
          </li>
          <li>
            <a class="add-tab" href="#" data-href="@url/xadmin/bab_iv/program/view">
              Program :: BAB IV
            </a>
          </li>
          <li>
            <a class="add-tab" href="#" data-href="@url/xadmin/bab_iv/kegiatan/view">
              Kegiatan :: BAB IV
            </a>
          </li>    
          @if(read_modul('master'))
          <li>
            <a class="add-tab" href="#" data-href="@url/xadmin/bab_iv/urusan/view">
              Master :: BAB IV
            </a>
          </li>  
          @endif
        </ul>
      </li>   
      @endif
      @if(read_modul('bab5'))
      <li>
        <a href="#" data-toggle="collapse" data-target="#laporan-5">BAB V</a>
        <ul id="laporan-5" class="collapse pl-4">
          <li>
            <a class="add-tab" href="#" data-href="@url/xadmin/bab_v/laporan/view">
              Laporan :: BAB V
            </a>
          </li>      
          <li>
            <a class="add-tab" href="#" data-href="@url/xadmin/bab_v/deskripsi/view">
              Deskripsi :: BAB V
            </a>
          </li>
          <li>
            <a class="add-tab" href="#" data-href="@url/xadmin/bab_v/program/view">
              Program :: BAB V
            </a>
          </li>
          <li>
            <a class="add-tab" href="#" data-href="@url/xadmin/bab_v/kegiatan/view">
              Kegiatan :: BAB V
            </a>
          </li>   
          @if(read_modul('master'))
          <li>
            <a class="add-tab" href="#" data-href="@url/xadmin/bab_v/pengisi/view">
              Master :: BAB V
            </a>
          </li>
          @endif
        </ul>
      </li>  
      @endif
      @if(read_modul('bab6'))
      <li>
        <a href="#" data-toggle="collapse" data-target="#laporan-6">BAB VI</a>
        <ul id="laporan-6" class="collapse pl-4">
          <li>
            <a class="add-tab" href="#" data-href="@url/xadmin/bab_vi/laporan/view">
              Laporan :: BAB VI
            </a>
          </li>
          @if(read_modul('master'))
          <li>
            <a class="add-tab" href="#" data-href="@url/xadmin/bab_vi/pengisi/view">
              Master :: BAB VI
            </a>
          </li>
          @endif
        </ul>
      </li>   
      @endif
      @if(read_modul('bab7'))
      <li>
        <a href="#" data-toggle="collapse" data-target="#laporan-7">BAB VII</a>
        <ul id="laporan-7" class="collapse pl-4">
          <li>
            <a class="add-tab" href="#" data-href="@url/xadmin/bab_vii/laporan/view">
              Laporan :: VII
            </a>
          </li>
          @if(read_modul('master'))
          <li>
            <a class="add-tab" href="#" data-href="@url/xadmin/bab_vii/pengisi/view">
              Master :: BAB VII
            </a>
          </li>
          @endif
        </ul>
      </li>   
      @endif
    </ul>
  </li>
  @if(read_modul('media'))
  <li>
    <a href="#" data-toggle="collapse" data-target="#modul1">
      <i class="fas fa-chalkboard-teacher"></i> Pustaka
    </a>
    <ul id="modul1" class="collapse pl-4">        
      <li>
        <a class="add-tab" href="#" data-href="@url/xadmin/media/galeri/view">
          Galeri
        </a>
      </li>
    </ul>
  </li>
  @endif
  @if(read_modul('master'))    
  <li>
    <a href="#" data-toggle="collapse" data-target="#master">
      <i class="fas fa-cogs"></i> Master
    </a>
    <ul id="master" class="collapse pl-4">
      <li>
        <a class="add-tab" href="#" data-href="@url/xadmin/master/periode/view">
          Periode
        </a>
      </li> 
      <li>
        <a class="add-tab" href="#" data-href="@url/xadmin/master/template/view">
          Template Laporan
        </a>
      </li> 
    </ul>
  </li>
  @endif
  @if(read_modul('master'))
  <li class="">
    <a href="#" data-toggle="collapse" data-target="#user">
      <i class="fas fa-users"></i> Pengguna
    </a>
    <ul id="user" class="collapse pl-4">   
      <li>
        <a class="add-tab" href="#" data-href="@url/xadmin/users/pengguna/view">
        Data Pengguna
        </a>
      </li> 
    </ul>
  </li>
  @endif
</ul>
<br>
<br>
<br>
<br>
<br>