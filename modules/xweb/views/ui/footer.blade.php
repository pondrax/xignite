
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
  <script>
  $(()=> {
    $("[data-scroll]").click(function() {
      $('html, body').animate({
          scrollTop: $($(this).data('scroll')).offset().top
      }, 1000);
    });
    
    var mainbar=new SimpleBar($('body')[0],{autoHide:false})
    mainbar.getScrollElement().addEventListener('scroll', function(){
      var containerHeight=$(this).height()-150;
      $(this).find('.reveal').each(function(i,el){
        var elTop=$(el).offset().top
          , elHeight=$(el).height();
        if(elTop-containerHeight>0){
          $(el).removeClass('show animated')
        }else{
          if(!$(el).hasClass('animated')){
            $(el).addClass('animated')
            $(el)[0].style.webkitAnimation = 'none';
            setTimeout(function(){$(el)[0].style.webkitAnimation = ''}, 10);
          }
          setTimeout(function(){$(el).addClass('show')}, 100);          
        }
      })
    });
    
    
  });
  </script>
</body>
</html>