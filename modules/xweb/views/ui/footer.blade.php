
    <div class="footer bg-dark" style="min-height:300px">
      <div class="container">
        <div class="row">
          <div class="col" data-aos="fade-left" data-aos-delay="100">
            <div class="card text-white bg-dark border-0">
              <div class="card-body">
                <h5 class="card-title mt-2"><b>Wadul</b></h5>
                <hr>
                <p style="font-size:.8rem">
                </p>
              </div>
            </div>
          </div>
          <div class="col" data-aos="fade-left" data-aos-delay="200">
            <div class="card text-white bg-dark border-0">
              <div class="card-body">
                <h5 class="card-title mt-2"><b>Link Terkait</b></h5>
                <hr>
              </div>
            </div>
          </div>
          <div class="col" data-aos="fade-left" data-aos-delay="300">
            <div class="card text-white bg-dark border-0">
              <div class="card-body">
                <h5 class="card-title mt-2"><b>Media Sosial</b></h5>
                <hr>
                <p>
                </p>
              </div>
            </div>
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