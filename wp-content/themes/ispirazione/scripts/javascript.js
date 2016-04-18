/*! DaisyNav v1.0.0 | (c) 2013 CircleWaves (support@circlewaves.com)
*/
(function(a,f,g,h){a.extend({daisyNav:function(){a("ul.menu-list li.menu-item-has-children>a").append('<span class="menu-expand"></span>');a(".menu-toggle-button").click(function(){if(a(this).data("menu-id"))for(var b=a(this).data("menu-id").split(" "),e=b.length,c=0;c<e;c++){var d=b[c];d&&a("#"+d).toggleClass("show-for-devices")}else a("ul.menu-list").toggleClass("show-for-devices");a(this).toggleClass("active")});a(".menu-list .menu-expand").click(function(b){b.preventDefault();a(this).parent().next("ul").toggleClass("show-for-devices")})}})})(jQuery,
window,document);

/*  fakeLoader.js  */
!function(i){function s(){var s=i(window).width(),c=i(window).height(),d=i(".fl").outerWidth(),e=i(".fl").outerHeight();i(".fl").css({position:"absolute",rigth:"0%",top:"0%" })}i.fn.fakeLoader=function(c){var d=i.extend({timeToHide:1200,pos:"absolute",top:"30%",left:"-7%",width:"auto",height:"auto",zIndex:"999",bgColor:"#2ecc71",spinner:"spinner7",imagePath:""},c),e='<div class="fl spinner1"><div class="double-bounce1"></div><div class="double-bounce2"></div></div>',l='<div class="fl spinner2"><div class="spinner-container container1"><div class="circle1"></div><div class="circle2"></div><div class="circle3"></div><div class="circle4"></div></div><div class="spinner-container container2"><div class="circle1"></div><div class="circle2"></div><div class="circle3"></div><div class="circle4"></div></div><div class="spinner-container container3"><div class="circle1"></div><div class="circle2"></div><div class="circle3"></div><div class="circle4"></div></div></div>',n='<div class="fl spinner3"><div class="dot1"></div><div class="dot2"></div></div>',v='<div class="fl spinner4"></div>',a='<div class="fl spinner5"><div class="cube1"></div><div class="cube2"></div></div>',r='<div class="fl spinner6"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>',t='<div class="fl spinner7"><div class="circ1"></div><div class="circ2"></div><div class="circ3"></div><div class="circ4"></div></div>',o=i(this),h={position:d.pos,width:d.width,height:d.height,top:d.top,left:d.left};return o.css(h),o.each(function(){var i=d.spinner;switch(i){case"spinner1":o.html(e);break;case"spinner2":o.html(l);break;case"spinner3":o.html(n);break;case"spinner4":o.html(v);break;case"spinner5":o.html(a);break;case"spinner6":o.html(r);break;case"spinner7":o.html(t);break;default:o.html(e)}""!=d.imagePath&&o.html('<div class="fl"><img src="'+d.imagePath+'"></div>'),s()}),setTimeout(function(){i(o).fadeOut()},d.timeToHide),this.css({backgroundColor:d.bgColor,zIndex:d.zIndex})},i(window).load(function(){s(),i(window).resize(function(){s()})})}(jQuery);

 /* Reloj Digital */
    function digiClock( ) {
        var crTime = new Date( );
        var crHrs = crTime.getHours( );
        var crMns = crTime.getMinutes( );
        var crScs = crTime.getSeconds( );
        crMns = (crMns < 10 ? "0" : "") + crMns;
        crScs = (crScs < 10 ? "0" : "") + crScs;
        var timeOfDay = (crHrs < 12) ? "am" : "pm";
        crHrs = (crHrs > 12) ? crHrs - 12 : crHrs;
        crHrs = (crHrs == 0) ? 12 : crHrs;
        var crTimeString = crHrs + ":" + crMns + ":" + crScs + " " + timeOfDay;

        $("#clock").html(crTimeString);
    }







$(document).ready(function() {

  $(".eventosslider #evcal_list").hide();


 /* Cierra listado de eventos del header 
  $('.bxCerrarEvnt').click(function() {
           $('.evoDV #evcal_list').hide();
      }); */
      
$(document).on('click', '.bxCerrarEvnt', function () {
    $(this).parent('div').fadeOut();
});


    /* obtiene la variable de color de eventos */
    var colorEvento = $("span.evcal_cblock").attr("data-bgcolor");
 
    /* Toogle para el streaming */
    $(".Xclose").click(function () {
        $(".embed-container , .wrapDescripcionStreaming").fadeToggle(400);
    });
    
    /* Toogle para mapa footer */
    $(".too_mapa").click(function () {
        $(".siteinfo").fadeToggle('easeInBounce');
        $(this).toggleClass('too_mapT');
    });
    
   /* Reloj Digital */
   setInterval('digiClock()', 1000);

var oID = $(".srp-post-title-link[id]")         // find spans with ID attribute
  .map(function() { return this.id; }) // convert to set of IDs
  .get(); // convert to instance of Array (optional)
            
                

});

