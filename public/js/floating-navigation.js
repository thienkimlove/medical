fixNavi();
$(window).scroll(fixNavi);
//#navGlobal
function fixNavi(){
  if( $(window).scrollTop() > 110 ){
    $('#global-nav').css('top','0px');
  }else{
    var d = 190 - $(window).scrollTop();
    $('#global-nav').css('top', d+"px" );
  }
}