$(window).on('load', function () {
  var $preloader = $('#page-preloader'),
    $spinner  = $preloader.find('.spinner');
  $spinner.delay(5500).fadeOut();
  $preloader.delay(5500).fadeOut('slow');
  });

  var swiper = new Swiper(".featured-slider", {
    spaceBetween: 10,
    loop:false,
    centeredSlides: false,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    breakpoints: {
      0: {
        slidesPerView: 1,
      },
      450: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 3,
      },
      1024: {
        slidesPerView: 4,
      },
    },
  });
  
  var mySwiper = new Swiper(".swiper-container", {
    speed: 500,
    slidesPerView: 1,
    loop: true,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false,
    },
  });