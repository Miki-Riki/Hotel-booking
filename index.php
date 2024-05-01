<?php include 'components/links.php'; ?>
<?php include 'components/header.php'; ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>EaseStay</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <div class="container-fluid main-images">
    <div class="swiper imgSwiper mt-5 mx-auto">
      <div class="swiper-wrapper">
        <div class="swiper-slide"><img class="d-block mx-auto" src="images/1.jpg"></div>
        <div class="swiper-slide"><img class="d-block mx-auto" src="images/2.jpg"></div>
        <div class="swiper-slide"><img class="d-block mx-auto" src="images/3.jpg"></div>
        <div class="swiper-slide"><img class="d-block mx-auto" src="images/4.jpg"></div>
      </div>
    </div>
  </div>
  <div id="search_parameters" class="col-lg-8 mx-auto">
    <h2>Where to?</h2>
    <form class="form p-2" method="GET" action="search.php">
      <div class="row align-items-end">
        <div class="form-group col-lg-3 mb-1">
          <label for="hotel">Location</label>
          <input type="text" class="form-control" id="hotel" name="hotel" placeholder="Travel where" required>
        </div>
        <div class="form-group col-lg-3 mb-1">
          <label for="check_in">Check in</label>
          <input type="date" class="form-control" id="check_in" name="check_in" min="<?php echo date('Y-m-d'); ?>" required>
        </div>
        <div class="form-group col-lg-3 mb-1">
          <label for="check_out">Check out</label>
          <input type="date" class="form-control" id="check_out" name="check_out" min="<?php echo date('Y-m-d'); ?>" required>
        </div>
        <div class="form-group col-lg-1 mb-1">
          <div class="form-group">
            <label for="adult">Adult</label>
            <input type="number" class="form-control" id="adult" name="adult" value="1" min="0" max="20" title="Adult can't be 0" data-toggle="tooltip" data-placement="bottom">
          </div>
        </div>
        <div class="form-group col-lg-1 mb-1">
          <div class="form-group">
            <label for="children">Children</label>
            <input type="number" class="form-control" id="children" name="children" value="0" min="0" max="25">
          </div>
        </div>
        <div class="form-group col-lg-1 mb-1 d-flex justify-content-center justify-content-lg-start">
            <button id="submitButton" type="submit" class="btn">Search</button>
        </div>
      </div>
    </form>
  </div>

  <h2 class="pt-4 mb-4 text-center fw-bold h-font">Explore our best destinations</h2>
  <div class="contanier">
    <div class="row cards mx-auto">
      <div class="col-lg-2 col-md-6">
        <div class="card">
          <img src="images/cro.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">croatia</h5>
          </div>
          <a href="/hoteli/cro_rooms.php" class="">
          </a>
        </div>
      </div>
      <div class="col-lg-2 col-md-6">
        <div class="card">
          <img src="images/spain.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">spain</h5>
          </div>
          <a href="/hoteli/sp_rooms.php" class="">
          </a>
        </div>
      </div>
      <div class="col-lg-2 col-md-6">
        <div class="card">
          <img src="images/china.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">china</h5>
          </div>
          <a href="/hoteli/ch_rooms.php" class=""></a>
        </div>
      </div>
      <div class="col-lg-2 col-md-6">
        <div class="card">
          <img src="images/egypt.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">egypt</h5>
          </div>
          <a href="/hoteli/eg_rooms.php" class=""></a>
        </div>
      </div>
      <div class="col-lg-2 col-md-6">
        <div class="card">
          <img src="images/bali.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title"> bali</h5>
          </div>
          <a href="/hoteli/ba_rooms.php" class=""></a>
        </div>
      </div>
      <div class="col-lg-2 col-md-6">
        <div class="card">
          <img src="images/caribbean.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">caribbean</h5>
          </div>
          <a href="/hoteli/ca_rooms.php" class=""></a>
        </div>
      </div>
    </div>
  </div>

  <!--TESTIMONIALS-->

  <h2 class="pt-4 mt-2 text-center fw-bold h-font">testimonials</h2>
  <div id="testimonial" class="container mt-5">
    <div #swiperRef="" class="swiper testimonial">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <div class="user d-flex flex-column align-items-center text-center mt-2">
            <div class="user-image">
              <img src="images/user.png">
            </div>
            <div class="user-name mt-2">
              <h4>Bob</h4>
            </div>
          </div>
          <div class="review">
            <p>
              EaseStay is my go-to for honest reviews and recommendations. I've discovered amazing places and had unforgettable experiences thanks to the community's insights.
            </p>
          </div>
          <div class="rating mb-1">
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="user d-flex flex-column align-items-center text-center mt-2">
            <div class="user-image">
              <img src="images/user2.jpg">
            </div>
            <div class="user-name mt-2">
              <h4>Willy</h4>
            </div>
          </div>
          <div class="review">
            <p>
              Easy to book, saving both time and money. Their customer service has been reliable, and the loyalty program offers some great perks.
            </p>
          </div>
          <div class="rating mb-1">
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-half"></i>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="user d-flex flex-column align-items-center text-center mt-2">
            <div class="user-image">
              <img src="images/user3.jpg">
            </div>
            <div class="user-name mt-2">
              <h4>Dmitrij</h4>
            </div>
          </div>
          <div class="review">
            <p>
              EaseStay's travel guides have been my companions on many adventures. Their in-depth insights into destinations and cultural tips make them a trustworthy source for planning.
            </p>
          </div>
          <div class="rating mb-1">
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="user d-flex flex-column align-items-center text-center mt-2">
            <div class="user-image">
              <img src="images/user4.jpg">
            </div>
            <div class="user-name mt-2">
              <h4>Lucija</h4>
            </div>
          </div>
          <div class="review">
            <p>
              Fantastic for spontaneous travelers. I've found some incredible deals. The interface is user-friendly.
            </p>
          </div>
          <div class="rating mb-1">
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="user d-flex flex-column align-items-center text-center mt-2">
            <div class="user-image">
              <img src="images/user5.jpg">
            </div>
            <div class="user-name mt-2">
              <h4>Sin Yu</h4>
            </div>
          </div>
          <div class="review">
            <p>
              Absolutely outstanding experience with Easestay! From the seamless booking process to the exceptional accommodations, every aspect of my stay exceeded expectations.
            </p>
          </div>
          <div class="rating mb-1">
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
            <i class="bi bi-star-fill"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--ABOUT US-->
  <div class="fluid-container about_us p-3 mb-4" id="about_us">
    <div class="card mb-3">
      <div class="row">
        <div class="col-md-7">
          <div class="card-body">
            <h2 class="card-title">About</h2>
            <p class="card-text mb-0">Welcome to EaseStay – Where Comfort Meets Exceptional Hospitality.
            </p>
            <ul>
              <li class="mt-0">Distinctive Comfort</li>
              <li>Personalized Attention</li>
              <li>Quality Assurance</li>
              <li>Tech-Forward</li>
              <li>Sustainability Focus</li>
            </ul>
            <p class="card-text">
              Book now and embark on a journey where comfort knows no bounds.
            </p>
          </div>
        </div>
        <div class="col-md-4 abt">
          <img src="images/about_us.jpg" class="img-fluid" alt="about_us">
        </div>
      </div>
    </div>
  </div>

  <!--CONTACT US-->

  <h2 id="contact_us" class="pt-4 mb-4 text-center fw-bold h-font">reach us</h2>
  <div class="container contact_us mt-3">
    <div class="row row_2">
      <div class="col-lg-8 col-md-8 p-2 map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d711533.0288277682!2d15.964364!3d45.842775!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4765d692c902cc39%3A0x3a45249628fbc28a!2sZagreb!5e0!3m2!1shr!2shr!4v1706972007697!5m2!1shr!2shr" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
      <div class="col-md-4 d-flex align-items-stretch container_2">
        <div class="info-wrap w-100 p-lg-5 p-4">
          <div class="dbox w-100 d-flex align-items-start">
            <div class="icon d-flex align-items-center justify-content-center">
              <span class="fa fa-map-marker"></span>
            </div>
            <div class="text pl-3 mt-2">
              <p><span>Address:</span> Zagreb, 10020</p>
            </div>
          </div>
          <div class="dbox w-100 d-flex align-items-center">
            <div class="icon d-flex align-items-center justify-content-center">
              <span class="fa fa-phone"></span>
            </div>
            <div class="text pl-3">
              <p><span>Phone:</span> <a href="tel://1234567920">+12 345 6789</a></p>
            </div>
          </div>
          <div class="dbox w-100 d-flex align-items-center">
            <div class="icon d-flex align-items-center justify-content-center">
              <span class="fa fa-paper-plane"></span>
            </div>
            <div class="text pl-3">
              <p><span>Email:</span> <a href="mailto:easestay@easestay.com"><span style="font-weight: 400;">easestay@easestay.com</span></a></p>
            </div>
          </div>
          <div class="dbox w-100 d-flex align-items-center">
            <div class="icon d-flex align-items-center justify-content-center">
              <span class="bi bi-globe"></span>
            </div>
            <div class="text pl-3">
              <p><span>Website:</span> <a href="index.php">easestay-hotel.com</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include 'components/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js">
  </script>

  <script>
    var swiper = new Swiper(".imgSwiper", {
      spaceBetween: 30,
      effect: "fade",
      speed: 2000,
      loop: true,
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      }
    });


    // TESTIMONIALS

    var swiper_2 = new Swiper(".testimonial", {
      slidesPerView: "3",
      slidesPerView: "auto",
      spaceBetween: 30,
      speed: 3500,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
      breakpoints: {
        320: {
          slidesPerView: "auto",
        },
        640: {
          slidesPerView: "auto",
        },
        768: {
          slidesPerView: "auto",
        },
        1024: {
          slidesPerView: "auto",
        },
      }
    });
  </script>
</body>

</html>
