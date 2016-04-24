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

(function ($) {
  $(document).ready(function() {

    $.fn.pushpin = function (options) {

      var defaults = {
        top: 0,
        bottom: Infinity,
        offset: 0
      }
      options = $.extend(defaults, options);

      $index = 0;
      return this.each(function() {
        var $uniqueId = guid(),
            $this = $(this),
            $original_offset = $(this).offset().top;

        function removePinClasses(object) {
          object.removeClass('pin-top');
          object.removeClass('pinned');
          object.removeClass('pin-bottom');
        }

        function updateElements(objects, scrolled) {
          objects.each(function () {
            // Add position fixed (because its between top and bottom)
            if (options.top <= scrolled && options.bottom >= scrolled && !$(this).hasClass('pinned')) {
              removePinClasses($(this));
              $(this).css('top', options.offset);
              $(this).addClass('pinned');
            }

            // Add pin-top (when scrolled position is above top)
            if (scrolled < options.top && !$(this).hasClass('pin-top')) {
              removePinClasses($(this));
              $(this).css('top', 0);
              $(this).addClass('pin-top');
            }

            // Add pin-bottom (when scrolled position is below bottom)
            if (scrolled > options.bottom && !$(this).hasClass('pin-bottom')) {
              removePinClasses($(this));
              $(this).addClass('pin-bottom');
              $(this).css('top', options.bottom - $original_offset);
            }
          });
        }

        updateElements($this, $(window).scrollTop());
        $(window).on('scroll.' + $uniqueId, function () {
          var $scrolled = $(window).scrollTop() + options.offset;
          updateElements($this, $scrolled);
        });

      });

    };


  });
}( jQuery ));

var identifier = '';
var galleryStart = 0;

jQuery(document).ready(function(){
  jQuery('#mainnav').pushpin( { top: jQuery('#mainnav').offset().top + jQuery('#mainnav').height() } );
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