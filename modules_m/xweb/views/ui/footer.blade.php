
  <div class="footer bg-dark" style="min-height:300px">
    <div class="container">
      <div class="row">
        <div class="col" data-aos="fade-left" data-aos-delay="100">
          <div class="card text-white bg-dark border-0">
            <div class="card-body">
              <h5 class="card-title mt-2"><b>Dinas Peternakan Prov. Jawa Timur</b></h5>
              <hr>
              <p style="font-size:.8rem">
              <div class="text-muted">Alamat</div>
              Jl. Jend Achmad Yani 202 Surabaya 60235<br>
              Jawa Timur - Indonesia<br><br>
              <div class="text-muted">Telp</div>
              (031) 8292545 8280445 - 8285126 - 8285129<br><br>
              <div class="text-muted">Fax</div>
              (031)8291853
              </p>
            </div>
          </div>
        </div>
        <div class="col" data-aos="fade-left" data-aos-delay="200">
          <div class="card text-white bg-dark border-0">
            <div class="card-body">
              <h5 class="card-title mt-2"><b>Link Terkait</b></h5>
              <hr>
              <p><a href="http://disnak.jatimprov.go.id/web" target="_blank">Web Disnak Jatim</a></p>
              <p><a href="http://103.53.76.91/simtanak/login">SIMTANAK</a></p>
              <p><a href="http://p2t.jatimprov.go.id/peternakan.html">Perizinan Terpadu</a></p>
              <p><a href="http://disnak.jatimprov.go.id/web/layananpublik/klinikonline">Klinik Online Disnak</a></p>
              <p><a href="http://disnak.jatimprov.go.id/web/layananpublik/forumkonsultasi">Forum konsultasi Peternakan</a></p>
            </div>
          </div>
        </div>
        <div class="col" data-aos="fade-left" data-aos-delay="300">
          <div class="card text-white bg-dark border-0">
            <div class="card-body">
              <h5 class="card-title mt-2"><b>Media Sosial</b></h5>
              <hr>
              <p>
              <a class="twitter-timeline" data-width="300" data-height="200" href="https://twitter.com/DisnakJatim?ref_src=twsrc%5Etfw">Tweets by DisnakJatim</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
  $(()=> {
    AOS.init({
  startEvent: 'load',
});
    $("[data-scroll]").click(function() {
      $('html, body').animate({
          scrollTop: $($(this).data('scroll')).offset().top
      }, 1000);
    });
  });
  
  
  
  
 $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

     var $target = $(e.target);

     if ($target.hasClass('disabled')) {
         return false;
     }
 });

 $(".next-step").click(function (e) {
     var $active = $('.wizard.nav-tabs .nav-item .active');
     var $activeli = $active.parent("li");

     $($activeli).next().find('a[data-toggle="tab"]').removeClass("disabled");
     $($activeli).next().find('a[data-toggle="tab"]').click();
 });


 $(".prev-step").click(function (e) {

     var $active = $('.wizard.nav-tabs .nav-item .active');
     var $activeli = $active.parent("li");

     $($activeli).prev().find('a[data-toggle="tab"]').removeClass("disabled");
     $($activeli).prev().find('a[data-toggle="tab"]').click();

 });

  </script>
</body>
</html>