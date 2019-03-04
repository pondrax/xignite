@include('ui/header')
  <div class="py-4" style="background: rgb(10,85,181);
background: linear-gradient(-61deg, rgba(10,85,181,1) 35%, rgba(0,212,255,1) 100%);">
    <div class="container">
    </div>
  </div>
  
  <div class="shadow" style="min-height:80vh">
    <div class="container py-3">
      <div class="row">
        <div class="col" data-aos="zoom-in" data-aos-delay="300">
          <div class="card shadow p-1 my-1">
            <div class="card-body">
            <h3 class="card-title">Kontak Kami</h3>
              <form>
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Nama">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control"placeholder="Email">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Alamat">
                </div>
                <div class="form-group">
                  <textarea class="form-control" placeholder="Alamat"></textarea>
                </div>
                <button class="btn btn-primary" type="submit">Kirim</button>
              </form>
            </div>
          </div>
          <br>
          <br>
          <div class="card shadow p-1 my-1">
            <div class="card-body">
            <h3 class="card-title">Informasi</h3>
              <p><strong>PPID Dinas Peternakan Prov. Jawa Timur.</strong><br>
                 <strong>Alamat</strong>: Jl. Jend Achmad Yani 202 Surabaya 60235 Jawa Timur - Indonesia<br>
                 <strong>Email</strong>: disnak@jatimprov.go.id<br>
                 <strong>Phone</strong>: (031) 8292545 8280445 - 8285126 - 8285129<br>
                 <strong>Fax</strong>: (031) 8291853</p>
              <hr>
              <strong>Jam Kerja</strong>
              <p>Senin - Kamis - 09.00 s/d 14.30 WIB, Istirahat Jam 11.00 s/d 13.00 WIB<br> Jumat - 09.00 s/d 15.00 WIB, Istirahat Jam 11.00 s/d 14.00 WIB</p>
            </div>
          </div>
        </div>
        <div class="col" data-aos="zoom-in" data-aos-delay="300">
          <div class="card shadow p-1 my-1">
            <div class="card-body">
            <h3 class="card-title">Peta</h3>
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d31657.576006851938!2d112.730529!3d-7.331759!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xbd609abff8e4cc09!2sEast+Java+Provincial+Animal+Husbandry!5e0!3m2!1sen!2sus!4v1543893505574" width="600" height="700" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  
@include('ui/footer')