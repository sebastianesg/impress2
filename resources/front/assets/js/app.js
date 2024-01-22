/* WHATSAPP CHAT */
function initWhatsappChat() {
    'use strict';
    
    var mobileDetect = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    
    if (mobileDetect) {
        $('#float-cta .whatsapp-msg-container').css('display','none');
        $('#float-cta > a').on('click', function(){
            window.location = 'https://api.whatsapp.com/send?phone=5491112345678';
        });
    } else {
        
        setInterval(function(){ 
            $('.float-bubble').addClass("alert-bubble");
        }, 3000);
        
        $('#float-cta > a').click(function(){
            $(this).toggleClass('open');
            $('#float-cta .whatsapp-msg-container').toggleClass('open');
            $('#float-cta').toggleClass('open');
            setInterval(function(){ 
                $('#float-cta .whatsapp-reply').addClass("open-reply");
            }, 1000);
        });
        
        $('.whatsapp-msg-close').click(function(){
            $('#float-cta > a').toggleClass('open');
            $('#float-cta .whatsapp-msg-container').toggleClass('open');
            $('#float-cta').toggleClass('open');
            $('#float-cta .whatsapp-reply').removeClass('open-reply');
        });
        
        $('.btn-whatsapp-send').on('click', function(event){
            event.stopPropagation();
        });
        $('.btn-whatsapp-send').click(function() {
            var baseUrl = 'https://web.whatsapp.com/send?phone=5491112345678&text=';
            var textEncode = encodeURIComponent($('#float-cta .whatsapp-msg-body textarea').val());
            window.open(baseUrl + textEncode, '_blank');
        });
    }
    
}
initWhatsappChat();

/* MEGA MENU */
$(document).on('click', '.dropdown-menu', function (e) {
    e.stopPropagation();
  });
  
  // make it as accordion for smaller screens
  if ($(window).width() < 992) {
    $('.dropdown-menu a').click(function(e){
      e.preventDefault();
        if($(this).next('.submenu').length){
          $(this).next('.submenu').toggle();
        }
        $('.dropdown').on('hide.bs.dropdown', function () {
       $(this).find('.submenu').hide();
    })
    });
  }


  /* AOS JS */
AOS.init({
    once: true,
});