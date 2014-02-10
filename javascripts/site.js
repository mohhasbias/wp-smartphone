(function() {

  jQuery(function($) {
    $('.nav-accordion').accordion();
    $('ul.nav-accordion>li>a').on("click", function(e){
      e.preventDefault();
    });

    $('.products-slider').orbit({
      fluid: "1100x285",
      timer: false,
      afterSlideChange: function(){
        this.$slides
          .eq(this.activeSlide)
          .find('img.lazyload').trigger('appear');
      }
    });
    
    $('#featured').orbit({
      fluid: "738x200",
      bullets: true,
      startClockOnMouseOutAfter: 1000
      // timer: false
    });
    
    $('img.lazyload').lazyload();
  });
  
  jQuery(function($){
    $(document).ready(function(){
      console.log("pagination");
      if( window.history && history.pushState ){
        historyedited = false;
        $(window).bind('popstate', function(e){
          if( historyedited ){
            loadContent(location.pathname + location.search);
          }
        })
      }
    });
    
    function loadContent(url){
      $('.Navi-old').parent().spin('small');
      $('#loading-box').addClass("loading");
      $('#loading-box.loading').spin('large', '#FFF');
      $('#outer-box').load(url + ' .products_box', function(){
        $('#loading-box').removeClass("loading");
        $('.Navi-old').parent().spin(false);
        pjaxPagination();
      });
    };
    
    function pjaxPagination(){
      $('ul.pager a').click(function(e){
        e.preventDefault(); // disable follow href
        console.log('clicking ' + $(this).attr('href'));
        //alert($(this).attr('href'));
        var url = $(this).attr('href');
        loadContent(url);
        history.pushState(null, null, url);
        historyedited = true;
      });
    };
    
    pjaxPagination();
  });

  jQuery(function($){
    $('#megamenu .nav-bar').menuAim({
      activate: function(row){ 
        console.log('activate ' + $(row));
        $(row).trigger('activate'); 
      },
      deactivate: function(row){
        console.log('deactivate ' + $(row)); 
        $(row).trigger('deactivate'); 
      },
      exitMenu: function(){
        return true;
      }
    });
  });

  jQuery(function($){
    attachRevealButton();
  })
  
}).call(this);

function attachRevealButton(){
  $('a.reveal').click(function(event){
    event.preventDefault();
    console.log("loading reveal");
    var url = $(this).attr('href');
    console.log(url);

    if( $('.reveal-modal').length > 0 ){
      var $div = $('.reveal-modal');
    } else {
      var $div = $('<div>').addClass('reveal-modal expand').appendTo('body');
    }

    if( $('#center-div').length > 0 ){
      var $centerDiv = $('#center-div');
    } else {
      var $centerDiv = $('<div>').attr('id','center-div').appendTo('body');
      $centerDiv.css({
        "position": "fixed",
        "top": "50%",
        "left": "50%",
        "background-color": "rgba(0,0,0,0.7)",
        "width": "100px",
        "height": "100px",
        "margin-left": "-50px",
        "margin-top": "-50px",
        "border-radius": "5px",
        "padding": "50px"
      });
    }
    $centerDiv.show();
    $centerDiv.spin('large','#FFF');

    $div.load(url, function(){
      $centerDiv.spin(false);
      $centerDiv.hide();
      $div
        .find('.continue_spacer-old')
          .addClass('close-reveal-modal')
          .removeAttr('href');

      $div
        .append('<a class="close-reveal-modal">&#215;</a>')
        .reveal();
    });
  });
}