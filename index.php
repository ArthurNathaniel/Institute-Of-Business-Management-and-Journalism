<?php
include 'db.php';

$sql = "SELECT * FROM news ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>
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
  <section>
    <div class="programmme_all">
      <div class="programme_title">
        <h1>Find Programme</h1>
      </div>
      <div class="programme_search">
        <input type="text" id="searchInput" placeholder="Search for a programme" onkeyup="filterProgrammes()">
      </div>
      <div class="programme_swiper">
        <div class="swiper mySwiper2">
          <div class="swiper-wrapper">
            <div class="swiper-slide programme_card">
              <div class="programme_img">
                <img src="./images/hero_2.jpg" alt="">
              </div>
              <div class="programme_details">
                <h4>HND in Communication</h4>
                <p> <strong>Duration:</strong> <i>3 years</i></p>
                <div class="programme_btn">
                  <a href="">
                    <button>Read More</button>
                  </a>
                </div>
              </div>
            </div>

            <div class="swiper-slide programme_card">
              <div class="programme_img">
                <img src="./images/hero_2.jpg" alt="">
              </div>
              <div class="programme_details">
                <h4>HND in Marketing</h4>
                <p><strong>Duration:</strong> <i>3 years</i></p>
                </p>
                <div class="programme_btn">
                  <a href="">
                    <button>Read More</button>
                  </a>
                </div>
              </div>
            </div>

            <div class="swiper-slide programme_card">
              <div class="programme_img">
                <img src="./images/hero_2.jpg" alt="">
              </div>
              <div class="programme_details">
                <h4>HND in Journalism</h4>
                <p> <strong>Duration:</strong> <i>3 years</i></p>
                <div class="programme_btn">
                  <a href="">
                    <button>Read More</button>
                  </a>
                </div>
              </div>
            </div>

            <div class="swiper-slide programme_card">
              <div class="programme_img">
                <img src="./images/hero_2.jpg" alt="">
              </div>
              <div class="programme_details">
                <h4>HND in Radio & TV Broadcsting</h4>
                <p> <strong>Duration:</strong> <i>3 years</i></p>
                <div class="programme_btn">
                  <a href="">
                    <button>Read More</button>
                  </a>
                </div>
              </div>
            </div>

            <div class="swiper-slide programme_card">
              <div class="programme_img">
                <img src="./images/hero_2.jpg" alt="">
              </div>
              <div class="programme_details">
                <h4>Diploma in Radio & TV Broadcsting</h4>
                <p> <strong>Duration:</strong> <i> 3 Months</i></p>
                <div class="programme_btn">
                  <a href="">
                    <button>Read More</button>
                  </a>
                </div>
              </div>
            </div>


          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
      <div id="noResults">
        No programmes found.
      </div>
    </div>
  </section>

  <section>
    <div class="news_all">
      <div class="news_title">
        <h4><span><i class="fa-solid fa-minus"></i></span>OUR RECENT NEWS</h4>
        <h1>Latest news updated weekly</h1>
      </div>
      <div class="news_swiper">
        <div class="swiper mySwiper3">
          <div class="swiper-wrapper">
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
              <div class="swiper-slide news_card" onclick="showNewsDetails(<?php echo $row['id']; ?>)">
                <div class="news_image">
                  <img src="<?php echo $row['image']; ?>" alt="">
                </div>
                <div class="news_content">
                  <div class="date">
                    <p><?php echo date('d M, Y', strtotime($row['date'])); ?></p>
                  </div>
                  <div class="title">
                    <h4><?php echo $row['title']; ?></h4>
                  </div>
                </div>
              </div>
            <?php endwhile; ?>
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </div>
  </section>
  <section>
    <?php include 'gallery.php' ?>
  </section>
  <section>
    <div class="contact_all">
      <div class="contact_title">
        <h4><span><i class="fa-solid fa-minus"></i></span> GET IN TOUCH WITH US</h4>
        <h1>Contact Us</h1>
      </div>
      <div class="contact_grid">
        <div class="contact_box">
          <img src="./images/call.png" alt="">
          <a href="tel:054 217 0510">
            <h1>+233 54 217 0510</h1>
          </a>
        </div>
        <div class="contact_box">
          <img src="./images/email.png" alt="">
          <a href="mailto:info@ibmandj.org">
            <h1>info@ibmandj.org</h1>
          </a>
        </div>
        <div class="contact_box">
          <img src="./images/location.png" alt="">
          <a href="https://maps.app.goo.gl/VAyaeUS6mUQMxSrv6">
            <h1>Krofrom near X5</h1>
          </a>
        </div>
      </div>
      <div class="map">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.489528806891!2d-1.6186742255184505!3d6.709953220969604!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfdb979891440c09%3A0x330dbd28233997e5!2sInstitute%20of%20Business%20Management%20%26%20Journalism%20(IBM%26J)!5e0!3m2!1sen!2sgh!4v1722256712017!5m2!1sen!2sgh" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
  </section>
  <section></section>
  <script src="./js/swiper.js"></script>
  <script src="./js/search.js"></script>
</body>

</html>