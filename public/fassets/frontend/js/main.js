;(function ($) {
    "use strict";
    $(document).on('ready', function () {
        $('.header-search').each(function () {
            $('.search-popup-button').on('click', function () {
                $(this).siblings('.popup-search-form').fadeIn();
            });
            $('.popup-search-form .close-form').on('click', function () {
                $(this).parents('.popup-search-form').fadeOut();
            });
        });
        
        
        $('.gallery .gallery-item .gallery-icon a').attr('rel', 'gallery1').addClass('fancybox');
        /*-----------------------
        Fancybox Lightbox Active
        ------------------------*/
        $(".fancybox").fancybox({
            fitToView	: true,
            width		: '70%',
            height		: '70%',
            autoSize	: true,
            closeClick	: true,
            openEffect	: 'none',
            closeEffect	: 'none'
        });
        
        
        if (typeof imagesLoaded == 'function') {
            $('.masonrys > div').addClass('masonry-item');
            var $boxes = $('.masonry-item');
            $boxes.hide();
            var $container = $('.masonrys');
            $container.imagesLoaded(function () {
                $boxes.fadeIn();
                $container.masonry({
                    itemSelector: '.masonry-item',
                });
            });
        }
        // Select all links with hashes
        $('.nav a[href*="#"]')
          // Remove links that don't actually link to anything
          .not('[href="#"]')
          .not('[href="#0"]')
          .on('click',function(event) {
        // On-page links
        if (
          location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
          // Figure out element to scroll to
          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
          // Does a scroll target exist?
          if (target.length) {
            // Only prevent default if animation is actually gonna happen
            event.preventDefault();
            $('html, body').animate({
              scrollTop: target.offset().top
            }, 1000, function() {
              // Callback after animation
              // Must change focus!
              var $target = $(target);
              $target.focus();
              if ($target.is(":focus")) { // Checking if the target was focused
                return false;
              } else {
                $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
                $target.focus(); // Set focus again
              };
            });
          }
        }
        });
    });
    /* Preloader Js
    ===================*/
    $(window).on("load", function () {
        $('.preloader').fadeOut(500);
        /* Slick Nav Acitve */
        $('.primary-menu').slicknav();
        $('.slicknav_menu').prepend(slick_data.logo);
        $('.primary-menu .sub-menu .sub-menu').parent('li').append('<i class="icofont-rounded-right"></i>');
        $(".post-single").fitVids();
    });
})(jQuery);