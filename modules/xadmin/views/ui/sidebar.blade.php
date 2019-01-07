<div class="d-flex flex-column" style="height:100%">
  <div class="text-center pt-3">
    <img src="@asset/img/xignite.png" align="center" class="logo shadow-sm px-5 pb-2" style="width:80%">
    <h3 class="px-3 py-1 shadow-sm">{{APP_NAME}}</h3>
  </div>
  <div  style="flex:1" data-simplebar>
  
    <ul class="nav flex-column px-4 pt-0 pb-5">
      @if(read_modul('media'))
      <li>
        <a href="#" data-toggle="collapse" data-target="#pustaka">
          <i class="fas fa-chalkboard-teacher"></i> Pustaka
        </a>
        <ul id="pustaka" class="collapse show pl-4">        
          <li>
            <a class="add-tab" href="#" data-href="@url/xadmin/media/galeri/view">
              :: Galeri
            </a>
          </li>   
          <li>
            <a class="add-tab" href="#" data-href="@url/xadmin/media/dokumen/view">
              :: Dokumen
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
        <ul id="master" class="collapse show pl-4">
          <li>
            <a class="add-tab" href="#" data-href="@url/xadmin/master/pengguna/view">
              :: Pengguna
            </a>
          </li>
          <li>
            <a class="add-tab" href="#" data-href="@url/xadmin/master/grup/view">
              :: Grup
            </a>
          </li>
          <li>
            <a class="add-tab" href="#" data-href="@url/xadmin/master/modul/view">
              :: Modul
            </a>
          </li>
        </ul>
      </li>
      @endif
    </ul>
  </div>
</div>