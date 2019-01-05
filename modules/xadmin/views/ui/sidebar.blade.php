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