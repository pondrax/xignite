
          @if(logged())
            <span class="text-muted">Selamat datang, </span>
            <span class="text-info"><b>{{logged()->email}}</b></span><br>
            @if(logged()->aktif!=1)
            <div class="alert alert-danger py-0 px-2">Email belum diaktivasi. Harap aktifkan email<br> anda terlebih dahulu dihalaman profil</div>
            @endif
            <a class="" href="@url/aduanku">Aduan anda</a>
            &nbsp;
            <a class="" href="@url/profil">Profil</a>
            &nbsp;
            <a class="text-danger" href="@url/logout">Keluar</a>
          @else
          <a class="btn btn-outline-info hvr-hang" href="@url/login">Masuk</a> &nbsp;
          <a class="btn btn-danger hvr-hang" href="@url/registrasi">Daftar</a>
          @endif