<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <?php include 'cdn.php' ?>
  <link rel="stylesheet" href="./css/base.css">
  <link rel="stylesheet" href="./css/index.css">
</head>

<body>
  <?php include 'navbar.php' ?>
  <section>
    <div class="hero_bg">
      <div class="swiper mySwiper">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <div class="hero_text">
              <h1>Premier Accredited Communication School</h1>
              <p>
                The only accredited communication school in the Ashanti Region, recognized by the National Accreditation Board, Ghana
              </p>
              <div class="hero_btn">
                <a href="">
                  <button>Apply Now</button>
                </a>

                <a href="">
                  <button class="live">Go Live</button>
                </a>
              </div>
            </div>
            <img src="./images/hero_1.jpg" alt="">
          </div>

          <div class="swiper-slide">
            <div class="hero_text">
              <h1>Excellence in Business and Journalism Education</h1>
              <p>
                Affiliated with the National Board for Professional and Technical Examinations, we provide top-tier education in business and journalism.
              </p>
              <div class="hero_btn">
                <a href="">
                  <button>Apply Now</button>
                </a>

                <a href="">
                  <button class="live">Go Live</button>
                </a>
              </div>
            </div>
            <img src="./images/hero_2.jpg" alt="">
          </div>

          <div class="swiper-pagination"></div>
        </div>
      </div>
  </section>
  <section>
    <div class="what_stand_for_all">
      <div class="stand_heading">
        <h1>What We Stand For</h1>
      </div>
      <div class="what_we_stanf_grid">
        <div class="box">
          <img src="./images/execellence.png" alt="">
          <h3>Excellence in Education</h3>
          <p>
            Top-notch training in Business, Marketing, Communication, Journalism, and Broadcasting.
          </p>
        </div>
        <div class="box">
          <img src="./images/accredited.png" alt="">

          <h3>Accredited and Recognized</h3>
          <p>Fully accredited and affiliated, ensuring top standards.</p>
        </div>
        <div class="box">
          <img src="./images/professional.png" alt="">
          <h3>Professional Development</h3>
          <p>Hands-on experience and skills for career excellence.</p>
        </div>
      </div>
    </div>
  </section>
  <script src="./js/swiper.js"></script>
</body>

</html>