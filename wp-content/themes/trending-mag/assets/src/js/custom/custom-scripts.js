(function ($) {

  'use strict';

  $(document).ready(function () {

    var docSize = $(document).width();

    /**
     * Accessibility. 
     * It will add class to body on tab key press.
     */
    $(document).on('mousemove', 'body', function (e) {
      $(this).removeClass('using-tab-nav');
    });
    $(document).on('keydown', 'body', function (e) {
      if (e.which == 9) {
        $(this).addClass('using-tab-nav');
      }
    });

    /**
     * Add fa icon to submenu parent.
     */
    $('nav#site-navigation .menu-item-has-children > a').append('<i class="fa fa-angle-down"></i>');

    /**
     * Navigation menu accessibility code for mobile devices.
     */
    $(document).on('focus', '.using-tab-nav nav#site-navigation.toggled .nav-menu', function () {

      // Our nav menu trigger hack, which will be used later after the last menu item.
      var navClose = $('.using-tab-nav nav#site-navigation.toggled a#site-navigation-close');
      if (!navClose.length > 0) {
        if (!docSize > 800) {
          $('.using-tab-nav nav#site-navigation.toggled').append('<a href="#" id="site-navigation-close"></a>');
        } else {
          $(navClose).remove();
        }
      } else {
        $(navClose).focus(function () {
          if ('focus-visible' === $(navClose).attr('class')) {
            $(document)
              .find('#site-navigation')
              .slideUp()
              .removeClass('toggled');
          }
        });
      }

    });




    /*
      ============================
      = webticker
      ========================================
      */

    $("#webticker").webTicker({
      speed: 100
    });


    /*
    ========================
    =
    = Overlay search
    = 
    ====================================
    */


    $('.search-trigger, .form-close').click(function (e) {
      e.preventDefault();
      $('.search-wrapper').toggleClass('visible');
    });

    /*
    =========================
    = Canvas toggle aside
    ========================================
    */

    // offcanvas toggle sidebar 

    var $CanvasRevelBtn = $('.canvas-trigger');
    var $CanvasAside = $('.canvas-sidebar');
    var $SideCanvasMask = $('.site-overlay');
    var $CloseCanvas = $('.close-canvas');

    function removeCanvasClasses() {

      $CanvasAside.removeClass('visible');
      $SideCanvasMask.removeClass('visible');
      $('body').removeClass('offcanvas-active');

    }

    function addCanvasClasses() {

      $CanvasAside.addClass('visible');
      $SideCanvasMask.addClass('visible');
      $('body').addClass('offcanvas-active');
    }

    $CanvasRevelBtn.on('click', function () {

      addCanvasClasses();
    });

    $SideCanvasMask.on('click', function () {

      removeCanvasClasses();
    });

    $CloseCanvas.on('click', function () {

      removeCanvasClasses();
    });

    /*
    ===========================
    = Main navigation
    ====================================
    */


    $('.menu-toggle').click(function (event) {

      $('#site-navigation').slideToggle('slow');
    });


    $('#site-navigation .menu-item-has-children').append('<span class="sub-toggle"> <i class="icon ion-md-arrow-dropright"></i> </span>');
    $('#site-navigation .page_item_has_children').append('<span class="sub-toggle"> <i class="icon ion-md-arrow-dropright"></i> </span>');


    $('#site-navigation .sub-toggle').click(function () {

      $(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle('1000');
      jQuery(this).parent('.page_item_has_children').children('ul.children').first().slideToggle('1000');
      $(this).children('.fa-angle-right').first().toggleClass('fa-angle-down');

    });


    /*
    ===========================
    = Sticky sidebar
    ==========================================
    */

    if (window.matchMedia("(max-width: 991px)").matches) {

      $(".col-lg-8").removeClass("sticky-portion");

    } else {

      $('.sticky-portion').theiaStickySidebar({

        additionalMarginTop: 30

      });

    }


    /*
    ===========================
    = Banner sliders
    ====================================
    */


    // Banner slider style 1


    $('.main-rm-banner-slider-s1').slick({
      autoplay: true,
      fade: false,
      dots: false,
      arrows: true,
      slidesToShow: 3,
      slidesToScroll: 1,
      autoplaySpeed: 2000,
      infinite: true,
      speed: 500,
      cssEase: 'linear',
      prevArrow: '<button type="button" class="prev"><i class="ti ti-control-skip-backward"></i></button>',
      nextArrow: '<button type="button" class="next"><i class="ti ti-control-skip-forward"></i></button>',
      responsive: [{
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          infinite: true,
          dots: false,
          arrows: false
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });



    // full widget layout 4


    $('.full-layout-with-bg').slick({
      autoplay: true,
      fade: false,
      dots: true,
      arrows: true,
      slidesToScroll: 1,
      autoplaySpeed: 2000,
      infinite: true,
      speed: 500,
      cssEase: 'linear',
      prevArrow: '<button type="button" class="prev"><i class="ti ti-control-skip-backward"></i></button>',
      nextArrow: '<button type="button" class="next"><i class="ti ti-control-skip-forward"></i></button>',
    });

    $('.slidder-post-wrap').slick({
      autoplay: true,
      fade: true,
      dots: false,
      arrows: true,
      slidesToScroll: 1,
      autoplaySpeed: 2000,
      infinite: true,
      speed: 1000,
      cssEase: 'linear',
      prevArrow: '<button type="button" class="prev"><i class="ti ti-arrow-left"></i></button>',
      nextArrow: '<button type="button" class="next"><i class="ti ti-arrow-right"></i></button>',
    });

    $('.rm-author-list').slick({
      autoplay: true,
      fade: false,
      dots: false,
      arrows: true,
      slidesToScroll: 1,
      autoplaySpeed: 2000,
      infinite: true,
      speed: 1000,
      cssEase: 'linear',
      prevArrow: '<button type="button" class="prev"><i class="ti ti-arrow-left"></i></button>',
      nextArrow: '<button type="button" class="next"><i class="ti ti-arrow-right"></i></button>',
    });

    $('.widget-insta-slider').slick({
      autoplay: true,
      fade: false,
      dots: false,
      arrows: false,
      slidesToShow: 5,
      slidesToScroll: 1,
      autoplaySpeed: 2000,
      infinite: true,
      speed: 500,
      cssEase: 'linear',
      prevArrow: '<button type="button" class="prev"><i class="ti ti-control-skip-backward"></i></button>',
      nextArrow: '<button type="button" class="next"><i class="ti ti-control-skip-forward"></i></button>',
      responsive: [{
        breakpoint: 1024,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 1,
          infinite: true,
          dots: true,
          arrows: false
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1
        }
      }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });
    $('.main-rm-banner-slider-s2').slick({
      autoplay: true,
      fade: false,
      dots: false,
      arrows: true,
      slidesToScroll: 1,
      autoplaySpeed: 2000,
      infinite: true,
      speed: 1000,
      cssEase: 'linear',
      prevArrow: '<button type="button" class="prev"><i class="ti ti-arrow-left"></i></button>',
      nextArrow: '<button type="button" class="next"><i class="ti ti-arrow-right"></i></button>',
    });


    $('.rm-banner-s3-slider-wrap').slick({
      autoplay: true,
      fade: false,
      dots: false,
      arrows: true,
      slidesToScroll: 1,
      autoplaySpeed: 2000,
      infinite: true,
      speed: 1000,
      cssEase: 'linear',
      prevArrow: '<button type="button" class="prev"><i class="ti ti-arrow-left"></i></button>',
      nextArrow: '<button type="button" class="next"><i class="ti ti-arrow-right"></i></button>',
    });
    /* 
    =============================
    = Append back to top btn 
    =====================================
    */

    $(document).on('click', '.social-share-list a.sharer-link', function () {
      $('#trigger-sharer-counter').submit();
    });

    $(window).on('scroll', function () {

      if ($(this).scrollTop() != 0) {

        $('#rm-backtotop').fadeIn();
      } else {
        $('#rm-backtotop').fadeOut();
      }
    });

    $("body").on('click', '#rm-backtotop, .footer-btp', function () {

      $("html, body").animate({
        scrollTop: 0
      }, 1200);
      return false;

    });


  });


  /**
   * Accessibility code for mobile nav menu trap focus.
   */
  (function () {

    // add all the elements inside modal which you want to make focusable
    const focusableElements = 'a button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])';
    const modal = document.querySelector('#site-navigation'); // select the modal by it's id
    const toggleButton = document.querySelector('button.menu-toggle'); // select the modal by it's id
    const firstFocusableElement = modal.querySelectorAll(focusableElements)[0]; // get first element to be focused inside modal
    const focusableContent = modal.querySelectorAll(focusableElements);
    const lastFocusableElement = focusableContent[focusableContent.length - 1]; // get last element to be focused inside modal

    $(document).on('keydown', 'body', function (e) {

      var docSize = $(document).width();
      if (docSize > 800) {
        return;
      }

      let isTabPressed = e.key === 'Tab' || e.which == 9;

      if (!isTabPressed) {
        return;
      }
      if (e.shiftKey) { // if shift key pressed for shift + tab combination
        if (document.activeElement === firstFocusableElement) {
          toggleButton.focus(); // add focus for the last focusable element
          e.preventDefault();
        }
      } else { // if tab key is pressed
        if (document.activeElement === lastFocusableElement) { // if focused has reached to last focusable element then focus first focusable element after pressing tab
          toggleButton.focus(); // add focus for the first focusable element
          e.preventDefault();
        }
      }
    });

    toggleButton.focus();

  })();




  /**
   * Accessiliby code for search modal focus.
   */
  (function () {

    /**
     * Accessibility code for search modal focus.
     */
    // add all the elements inside modal which you want to make focusable
    const focusableElements = 'a.form-close button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])';
    const modal = document.querySelector('.search-wrapper'); // select the modal by it's id
    const firstFocusableElement = modal.querySelectorAll(focusableElements)[0]; // get first element to be focused inside modal
    const focusableContent = modal.querySelectorAll(focusableElements);
    const lastFocusableElement = focusableContent[focusableContent.length - 1]; // get last element to be focused inside modal

    $(document).on('keydown', 'body', function (e) {
      let isTabPressed = e.key === 'Tab' || e.which == 9;

      if (!isTabPressed) {
        return;
      }
      if (e.shiftKey) { // if shift key pressed for shift + tab combination
        if (document.activeElement === firstFocusableElement) {
          lastFocusableElement.focus(); // add focus for the last focusable element
          e.preventDefault();
        }
      } else { // if tab key is pressed
        if (document.activeElement === lastFocusableElement) { // if focused has reached to last focusable element then focus first focusable element after pressing tab
          firstFocusableElement.focus(); // add focus for the first focusable element
          e.preventDefault();
        }
      }
    });

    firstFocusableElement.focus();

  })();

})(jQuery);


