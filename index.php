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
               <p><strong>Duration:</strong> <i>3 years</i></p></p>
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
      <?php while ($row = mysqli_fetch_assoc($result)): ?>
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
  <?php include 'gallery.php'?>
</section>
  <script src="./js/swiper.js"></script>
  <script src="./js/search.js"></script>
</body>

</html>