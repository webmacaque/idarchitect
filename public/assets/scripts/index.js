function menu() {
  const menuLinks = document.querySelectorAll(".header-menu__link");
  const sections = document.querySelectorAll("section");
  const menu = document.querySelector(".header-menu");

  // Smooth scroll to section
  menuLinks.forEach((link) => {
    link.addEventListener("click", function (e) {
      e.preventDefault();
      if (window.screen.width <= 1024) {
        toggleMobileMenu();
      }

      const targetId = this.getAttribute("href").substring(1);
      const targetSection = document.getElementById(targetId);

      window.scrollTo({
        top: targetSection.offsetTop - 117,
        behavior: "smooth",
      });
    });
  });

  // Highlight menu item on scroll
  window.addEventListener("scroll", function () {
    let currentSection = "";

    sections.forEach((section) => {
      const sectionTop = section.offsetTop - 117;
      if (pageYOffset >= sectionTop) {
        currentSection = section.getAttribute("id");
      }
    });

    menuLinks.forEach((link) => {
      link.classList.remove("active");
      if (link.getAttribute("href").substring(1) === currentSection) {
        link.classList.add("active");
      }
    });
  });
}

function toggleMobileMenu() {
  const header = document.querySelector(".header-mobile");
  const links = document.querySelector(".header-mobile-menu");
  const menu = document.querySelector(".header-menu");
  if (menu.style.display === "block") {
    menu.style.display = "none";
    links.style.display = "none";
    header.classList.remove("header-mobile--opened");
  } else {
    menu.style.display = "block";
    links.style.display = "block";
    header.classList.add("header-mobile--opened");
  }
}

document.addEventListener("DOMContentLoaded", function () {
  const mobileMenuToggleBurger = document.querySelector(".header-burger");

  let map;
  let center = new google.maps.LatLng(46.351751, 48.043511);

  let ico = {
    url: "http://idarchitects.ru/pin.svg",
    size: new google.maps.Size(95, 111),
    anchor: new google.maps.Point(24, 67),
  };

  menu();

  mobileMenuToggleBurger.addEventListener("click", toggleMobileMenu);

  Fancybox.bind("[data-fancybox]", {
    // Your custom options
  });

  const swiper = new Swiper(".swiper-container", {
    loop: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    on: {
      init: function () {
        this.slides.forEach((slide) => {
          let background = slide.getAttribute("data-background");
          slide.style.backgroundImage = `url(${background})`;
        });
        updateBullets(this);
      },
      slideChange: function () {
        updateBullets(this);
      },
    },
  });

  const swiperGallery = new Swiper(".swiper-container-gallery1", {
    loop: false,
    slidesPerView: 1,
    spaceBetween: 10,
    navigation: {
      nextEl: ".gallery-slider1-next",
      prevEl: ".gallery-slider1-prev",
    },
    pagination: {
      el: ".gallery-slider1-pagination",
      clickable: true,
    },
    breakpoints: {
      1024: {
        slidesPerView: 3,
      },
      767: {
        slidesPerView: 2,
      },
    },
  });

  const swiperGallery2 = new Swiper(".swiper-container-gallery2", {
    loop: false,
    slidesPerView: 1,
    spaceBetween: 10,
    navigation: {
      nextEl: ".gallery-slider2-next",
      prevEl: ".gallery-slider2-prev",
    },
    pagination: {
      el: ".gallery-slider2-pagination",
      clickable: true,
    },
    breakpoints: {
      1024: {
        slidesPerView: 3,
      },
      767: {
        slidesPerView: 2,
      },
    },
  });

  document.querySelectorAll(".custom-bullet").forEach((bullet) => {
    bullet.addEventListener("click", function () {
      const index = this.getAttribute("data-index");
      swiper.slideToLoop(index); // Use slideToLoop to ensure proper slide index in looped mode
    });
  });

  function updateBullets(swiper) {
    const activeIndex = swiper.realIndex;
    document.querySelectorAll(".custom-pagination").forEach((pagination) => {
      const bullets = pagination.querySelectorAll(".custom-bullet");
      bullets.forEach((bullet, index) => {
        if (index === activeIndex) {
          bullet.classList.add("active");
        } else {
          bullet.classList.remove("active");
        }
      });
    });
  }

  function initializeMap() {
    map = new google.maps.Map(document.getElementById("map"), {
      zoom: 17,
      center: center,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      scrollwheel: false,
      mapTypeControl: false,
      streetViewControl: false,
    });
    var location = new google.maps.LatLng(46.351751, 48.043511);
    var marker = new google.maps.Marker({
      position: location,
      map: map,
      icon: ico,
    });
    var styles = [
      {
        featureType: "all",
        elementType: "all",
        stylers: [
          { lightness: "29" },
          { invert_lightness: true },
          { hue: "#008fff" },
          { saturation: "-73" },
        ],
      },
      {
        featureType: "all",
        elementType: "labels",
        stylers: [{ saturation: "-72" }],
      },
      {
        featureType: "administrative",
        elementType: "all",
        stylers: [{ lightness: "32" }, { weight: "0.42" }],
      },
      {
        featureType: "administrative",
        elementType: "labels",
        stylers: [
          { visibility: "on" },
          { lightness: "-53" },
          { saturation: "-66" },
        ],
      },
      {
        featureType: "landscape",
        elementType: "all",
        stylers: [{ lightness: "-86" }, { gamma: "1.13" }],
      },
      {
        featureType: "landscape",
        elementType: "geometry.fill",
        stylers: [
          { hue: "#006dff" },
          { lightness: "4" },
          { gamma: "1.44" },
          { saturation: "-67" },
        ],
      },
      {
        featureType: "landscape",
        elementType: "geometry.stroke",
        stylers: [{ lightness: "5" }],
      },
      {
        featureType: "landscape",
        elementType: "labels.text.fill",
        stylers: [{ visibility: "off" }],
      },
      {
        featureType: "poi",
        elementType: "all",
        stylers: [{ visibility: "off" }],
      },
      {
        featureType: "poi",
        elementType: "labels.text.fill",
        stylers: [{ weight: "0.84" }, { gamma: "0.5" }],
      },
      {
        featureType: "poi",
        elementType: "labels.text.stroke",
        stylers: [{ visibility: "off" }, { weight: "0.79" }, { gamma: "0.5" }],
      },
      {
        featureType: "road",
        elementType: "all",
        stylers: [
          { visibility: "simplified" },
          { lightness: "-78" },
          { saturation: "-91" },
        ],
      },
      {
        featureType: "road",
        elementType: "labels.text",
        stylers: [{ color: "#ffffff" }, { lightness: "-69" }],
      },
      {
        featureType: "road.highway",
        elementType: "geometry.fill",
        stylers: [{ lightness: "5" }],
      },
      {
        featureType: "road.arterial",
        elementType: "geometry.fill",
        stylers: [{ lightness: "10" }, { gamma: "1" }],
      },
      {
        featureType: "road.local",
        elementType: "geometry.fill",
        stylers: [{ lightness: "10" }, { saturation: "-100" }],
      },
      {
        featureType: "transit",
        elementType: "all",
        stylers: [{ lightness: "-35" }],
      },
      {
        featureType: "transit",
        elementType: "labels.text.stroke",
        stylers: [{ visibility: "off" }],
      },
      {
        featureType: "water",
        elementType: "all",
        stylers: [{ saturation: "-97" }, { lightness: "-14" }],
      },
    ];
    map.setOptions({ styles: styles });
  }

  initializeMap();
});
