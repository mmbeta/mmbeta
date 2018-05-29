// Materialize Pushpin

var guid = (function() {
  function s4() {
    return Math.floor((1 + Math.random()) * 0x10000)
      .toString(16)
      .substring(1);
  }
  return function() {
    return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
           s4() + '-' + s4() + s4() + s4();
  };
})();


var identifier = '';
var galleryStart = 0;

jQuery(document).ready(function(){
  // jQuery('#mainnav').pushpin( { top: jQuery('#mainnav').offset().top + jQuery('#mainnav').height() } );
  if(jQuery('#owl-carousel-single').length > 0){
    jQuery("#owl-carousel-single").owlCarousel({
      navigation : true, // Show next and prev buttons
      slideSpeed : 300,
      paginationSpeed : 400,
      singleItem:true,
      autoHeight : true,
      pagination : false
    });    
  }
});

// Make modal gallery

var galleryItems = jQuery('figure.gallery-item');


if(galleryItems.length > 0){
  jQuery(galleryItems).find('figcaption').hide();

  jQuery(galleryItems).on('click', function(event){ 
    event.preventDefault();
    galleryStart = parseInt(jQuery(event.target).attr('data-imgcount')) - 1;
    jQuery("#owl-carousel-single").data('owlCarousel').reinit({});
    jQuery("#owl-carousel-single").data('owlCarousel').goTo(galleryStart);
    jQuery('#galleryModal').modal('toggle');
  })

  jQuery(document).keydown(function(e) {
    switch(e.which) {
        case 37: // left
        jQuery("#owl-carousel-single").data('owlCarousel').prev();
        break;
        
        case 39: // right
        jQuery("#owl-carousel-single").data('owlCarousel').next();
        break;

        default: return; // exit this handler for other keys
    }
    e.preventDefault(); // prevent the default action (scroll / move caret)
  });

}

// Make images with class .popup pop up in a modal
if (jQuery('img.popup').length > 0) {
  jQuery('.popup').on('click', function(event){
    var path = jQuery(event.target).data('imgpath');
    jQuery('#modal_image').attr('src', path);
    jQuery('#imageModal').modal();
  })
}

//Make more button hide when clicked.
if(jQuery('button.button-toggle')){
  jQuery('button.button-toggle').on('click', function(element){
    jQuery(element.target).hide();
  })
}