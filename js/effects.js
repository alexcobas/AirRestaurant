const menuItems = document.querySelectorAll('.menu-item-flex');

// Establecer el ítem "Nuestro menú" como seleccionado inicialmente
/*menuItems[0].classList.add('selected');
menuItems[0].querySelector('p').classList.add('active');
menuItems[0].querySelector('img').classList.add('active');*/

menuItems.forEach(item => {
  item.addEventListener('mousedown', function() {
    this.querySelector('p').classList.add('pressed');
    this.querySelector('img').classList.add('pressed');
  });

  item.addEventListener('mouseup', function() {
    this.querySelector('p').classList.remove('pressed');
    this.querySelector('img').classList.remove('pressed');
  });

  item.addEventListener('mouseleave', function() {
    this.querySelector('p').classList.remove('pressed');
    this.querySelector('img').classList.remove('pressed');
  });
});

menuItems.forEach(item => {
  item.addEventListener('click', function() {
    menuItems.forEach(menuItem => {
      menuItem.querySelector('p').classList.remove('active');
      menuItem.querySelector('img').classList.remove('active');
      menuItem.classList.remove('selected');
    });

    this.querySelector('p').classList.add('active');
    this.querySelector('img').classList.add('active');
    this.classList.add('selected');
  });
});

// Carousel
document.addEventListener('DOMContentLoaded', function() {
  var carousels = document.querySelectorAll('.carousel');

  carousels.forEach(function(carousel) {
    var carouselElement = new bootstrap.Carousel(carousel);
    var prevButton = carousel.querySelector('.carousel-control-prev');
    var nextButton = carousel.querySelector('.carousel-control-next');

    function updateCarouselControls() {
      var activeItem = carousel.querySelector('.carousel-item.active');

      if (activeItem.classList.contains('first')) {
        prevButton.style.display = 'none';
      } else {
        prevButton.style.display = 'block';
      }

      if (activeItem.classList.contains('last')) {
        nextButton.style.display = 'none';
      } else {
        nextButton.style.display = 'block';
      }
    }

    function disableButtons() {
      prevButton.disabled = true;
      nextButton.disabled = true;
    }

    function enableButtons() {
      prevButton.disabled = false;
      nextButton.disabled = false;
    }

    carousel.addEventListener('slide.bs.carousel', function() {
      disableButtons();
    });

    carousel.addEventListener('slid.bs.carousel', function() {
      updateCarouselControls();
      enableButtons(); 
    });

    updateCarouselControls();
  });
});



