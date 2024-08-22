<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Welcome to the Institute of Business Management and Journalism. Explore our programs, admission process, and stay connected with our alumni.">
  <meta name="keywords" content="IBM&J, media school, Ghana, business management, journalism, admission, alumni">
  <meta name="author" content="Institute of Business Management and Journalism">
  <title>Home - Institute of Business Management and Journalism</title>
  <?php include 'cdn.php' ?>
  <link rel="stylesheet" href="./css/base.css">
  <link rel="stylesheet" href="./css/index.css">
  <link rel="stylesheet" href="./css/contact.css">
</head>

<body>
  <?php include 'navbar.php' ?>
  <section>
    <div class="hero_bg">
      <div class="swiper mySwiper">
        <div class="swiper-wrapper">
          <?php
          include 'db.php'; // Include your database connection file

          // Fetch the Go Live link from the database
          $sql = "SELECT go_live_link FROM settings WHERE id = 1";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);
          $go_live_link = $row ? $row['go_live_link'] : '#'; // Default to # if no link found

          // Close the database connection
          mysqli_close($conn);
          ?>
          <div class="swiper-slide">
            <div class="hero_text">
              <h1>Welcome to Institute of Business Management & Journalism</h1>

              <div class="hero_btn">
                <a href="apply.php">
                  <button>Apply Now</button>
                </a>

                <a href="<?php echo htmlspecialchars($go_live_link); ?>" target="_blank">
                  <button class="live">Go Live</button>
                </a>
              </div>
            </div>
            <img src="./images/alumni.jpg" alt="">
          </div>
          <div class="swiper-slide">
            <div class="hero_text">
              <h1>Institute of Business Management & Journalism</h1>
              <p>
                The only accredited communication school in the Ashanti Region, recognized by the National Accreditation Board, Ghana
              </p>
              <div class="hero_btn">
                <a href="apply.php">
                  <button>Apply Now</button>
                </a>

                <a href="<?php echo htmlspecialchars($go_live_link); ?>" target="_blank">
                  <button class="live">Go Live</button>
                </a>
              </div>
            </div>
            <img src="./images/h.jpg" alt="">
          </div>

          <div class="swiper-slide">
            <div class="hero_text">
              <h1>Institute of Business Management & Journalism</h1>
              <p>
                Affiliated with the National Board for Professional and Technical Examinations, we provide top-tier education in business and journalism.
              </p>
              <div class="hero_btn">
                <a href="apply.php">
                  <button>Apply Now</button>
                </a>

                <a href="<?php echo htmlspecialchars($go_live_link); ?>" target="_blank">
                  <button class="live">Go Live</button>
                </a>
              </div>
            </div>
            <img src="./images/hero.jpg" alt="">
          </div>

          <div class="swiper-pagination"></div>
        </div>
      </div>
    </div>
  </section>
  <section>
    <div class="about_us_home_all">
      <div class="home_about_text">
        <div class="home_about_title">
          <h4>About us <br>
            <span><i class="fa-solid fa-minus"></i></span>
          </h4>
          <h1>Welcome to <br> IBM&amp;J</h1>
        </div>
        <p>
          Institute Of Business Management & Journalism(IBM&J) College was established in 1990 as a private tertiary institution and was accredited by the Ghana Tertiary Education(GTEC) formerly Ghana National Accreditation Board in 2005 to run tertiary courses. Since the institute’s inception, it has become one of the famous and foremost private institutions of higher learning in the country and has produced a lot of professionals . IBM&J - SERVE WITH SMILE President: MR. P.F.OWUSU ESTABLISHED: 1990 COLOURS: BLUE, WHITE AND RED </p>
        <p>
          Join us at IBM&J and be a part of a legacy of excellence in media education. Whether you are passionate about communication, marketing, journalism, or broadcasting, our programs are designed to help you achieve your career goals and make a meaningful impact in the media industry. With our comprehensive curriculum, state-of-the-art facilities, and experienced faculty, IBM&J is the perfect place to start your journey towards a successful and fulfilling career in media and communication.
        </p>
        <div class="home_about_btn">
          <a href="about.php">
            <button>Read more</button>
          </a>
        </div>
      </div>
      <div class="upcoming_event">
        <div class="upcoming_title">
          <h1>Upcoming Events</h1>
        </div>
        <?php
        include 'db.php'; // Include your database connection

        // Get the current date
        $current_date = date('Y-m-d');

        // Query to select only upcoming events
        $sql = "SELECT * FROM events WHERE date >= '$current_date' ORDER BY date ASC";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
          while ($event = mysqli_fetch_assoc($result)) {
            echo '<div class="events_box" onclick="showEventDetails(' . $event['id'] . ')">';
            echo '<p class="events_date"><i class="fa-solid fa-calendar-days"></i> ' . date('j F, Y', strtotime($event['date'])) . '</p>';
            echo '<h1 class="events_title">' . htmlspecialchars($event['title']) . '</h1>';
            echo '<div class="events_flex">';
            echo '<p class="events_time"><i class="fa-regular fa-clock"></i> ' . date('h:i a', strtotime($event['time'])) . '</p>';
            echo '<p class="events_location"><i class="fa-solid fa-location-dot"></i> ' . htmlspecialchars($event['location']) . '</p>';
            echo '</div>';
            echo '</div>';
          }
        } else {
          echo '<h4> <br><br> <br>  No upcoming events</h4>';
        }

        mysqli_close($conn);
        ?>
      </div>
    </div>
  </section>

  <section>
    <div class="apply_page">
      <div class="apply_loan_box">
        <h1>Apply for Student Loan</h1>
        <p>
          Apply for a Student Loan at the Institute of Business Management & Journalism. To apply, click the button below.
        </p>
        <div class="apply_btn">
          <a href="">
            <button>
              Apply Now
            </button>
          </a>
        </div>
      </div>
      <div class="apply_scholarship_box">
        <h1>Apply for Scholarship</h1>
        <p>
          Apply for a Scholarship at the Institute of Business Management & Journalism. To apply, click the button below </p>
        <div class="apply_btn">
          <a href="">
            <button>
              Apply Now
            </button>
          </a>
        </div>

      </div>
  </section>

  <section>
    <div class="what_stand_for_all">
      <div class="stand_heading">
        <h1>What We Stand For</h1>
      </div>
      <div class="what_we_stanf_grid">
        <div class="boxs">
          <img src="./images/execellence.png" alt="">
          <h3>Excellence in Education</h3>
          <p>
            Top-notch training in Business, Marketing, Communication, Journalism, and Broadcasting.
          </p>
        </div>
        <div class="boxs">
          <img src="./images/accredited.png" alt="">

          <h3>Accredited and Recognized</h3>
          <p>Fully accredited and affiliated, ensuring top standards.</p>
        </div>
        <div class="boxs">
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
              <div class="programme_img" style=" width:100%; object-fit: cover !important;">
                <img src="./images/communication.jpg" alt="">
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
                <img src="./images/marketing.jpg" alt="">
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
              <div class="programme_img" style=" width:100%; object-fit: cover !important;">
                <img src="./images/journalism.jpg" alt="">
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
                <img src="./images/radio.jpg" alt="">
              </div>
              <div class="programme_details">
                <h4>HND in Public Relation</h4>
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
                <img src="./images/diploma.jpg" alt="">
              </div>
              <div class="programme_details">
                <h4>Diploma in Radio & TV Broadcsting</h4>
                <p> <strong>Duration:</strong> <i> 2 years</i></p>
                <div class="programme_btn">
                  <a href="">
                    <button>Read More</button>
                  </a>
                </div>
              </div>
            </div>
            <div class="swiper-slide programme_card">
              <div class="programme_img" style=" width:100%; object-fit: cover !important;">
                <img src="./images/communication.jpg" alt="">
              </div>
              <div class="programme_details">
                <h4>Diploma in Communication</h4>
                <p> <strong>Duration:</strong> <i>2 years</i></p>
                <div class="programme_btn">
                  <a href="">
                    <button>Read More</button>
                  </a>
                </div>
              </div>
            </div>

            <div class="swiper-slide programme_card">
              <div class="programme_img">
                <img src="./images/marketing.jpg" alt="">
              </div>
              <div class="programme_details">
                <h4>Diploma in Marketing</h4>
                <p><strong>Duration:</strong> <i>2 years</i></p>
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
                <img src="./images/marketing.jpg" alt="">
              </div>
              <div class="programme_details">
                <h4>Certificate - Script Writing</h4>
                <p><strong>Duration:</strong> <i>6 Months Course</i></p>
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
                <img src="./images/marketing.jpg" alt="">
              </div>
              <div class="programme_details">
                <h4>Certificate - Photography</h4>
                <p><strong>Duration:</strong> <i>6 Months Course</i></p>
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
                <img src="./images/marketing.jpg" alt="">
              </div>
              <div class="programme_details">
                <h4>Certificate - Film Editing</h4>
                <p><strong>Duration:</strong> <i>6 Months Course</i></p>
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
                <img src="./images/marketing.jpg" alt="">
              </div>
              <div class="programme_details">
                <h4>Certificate - Film Acting & Directing</h4>
                <p><strong>Duration:</strong> <i>6 Months Course</i></p>
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
                <img src="./images/marketing.jpg" alt="">
              </div>
              <div class="programme_details">
                <h4>Certificate - Graphic Designing</h4>
                <p><strong>Duration:</strong> <i>6 Months Course</i></p>
                </p>
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
      <?php
      include 'db.php';

      $sql = "SELECT * FROM news ORDER BY id DESC";
      $result = mysqli_query($conn, $sql);
      ?>
      <div class="news_swiper">
        <div class="swiper mySwiper3">
          <div class="swiper-wrapper">
            <?php if (mysqli_num_rows($result) > 0) : ?>
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
                      <h4><?php echo htmlspecialchars($row['title']); ?></h4>
                    </div>
                  </div>
                </div>
              <?php endwhile; ?>
            <?php else : ?>
              <p>No recent news</p>
            <?php endif; ?>
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
    <div class="accreditation_all">
      <div class="accreditation_title">
        <h1>Accreditation</h1>
      </div>
      <div class="accreditation_swiper">
        <div class="swiper mySwiper4">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <img src="./images/nab.jpg" alt="">
            </div>
            <div class="swiper-slide">
              <img src="./images/GTECLOGO.png" alt="">
            </div>

            <div class="swiper-slide">
              <img src="./images/ctvet.png" alt="">
            </div>
            <div class="swiper-slide">
              <img src="./images/nabptex.jpg" alt="">
            </div>

          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </div>
  </section>
  <section>
    <div class="video_all">

      <div class="video_place">
        <video width="100%" height="100%" controls>
          <source src="./images/advert.mp4" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      </div>

      <div class="video_text">
        <div class="icons_and_text">
          <div class="icons_text">
            <img src="./images/badge_4535518.png" alt="">
          </div>
          <div class="vi_text">
            <h1>Global Certification</h1>
            <p>Earn a Global Certification with the Institute of Business Management & Journalism (IBM&J).</p>
          </div>
        </div>
        <div class="icons_and_text">
          <div class="icons_text">
            <img src="./images/book_10588194.png" alt="">
          </div>
          <div class="vi_text">
            <h1>Alumini</h1>
            <p>Join a thriving network of alumni who are making a global impact with their IBM&J education.</p>
          </div>
        </div>
        <div class="icons_and_text">
          <div class="icons_text">
            <img src="./images/newspaper_1225031.png" alt="">
          </div>
          <div class="vi_text">
            <h1>Global Certification</h1>
            <p>Earn a Global Certification with the Institute of Business Management & Journalism (IBM&J).</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section>
    <div class="what_our_students_say_all">
      <div class="students_title">
        <h1> What Our Students Say </h1>
        <p>Here's what our students say—past and present—about their experience at the Institute of
          Business Management & Journalism
        </p>
      </div>
      <div class="students_swiper">
        <div class="swiper mySwiper5">
          <div class="swiper-wrapper">
            <?php
            include 'db.php'; // Include your database connection file

            $sql = "SELECT * FROM testimonials";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="swiper-slide student_slide">';
                echo '<div class="student_name"><h4>' . $row['name'] . '</h4></div>';
                echo '<div class="student_status"><p>' . $row['status'] . '</p></div>';
                echo '<div class="student_testimonial"><p>"' . $row['testimonial'] . '"</p></div>';
                echo '</div>';
              }
            } else {
              echo '<p>No testimonials available.</p>';
            }

            // Close the database connection
            mysqli_close($conn);
            ?>

          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </div>
  </section>
 
  <section>
        <div class="alumni_pictures_all">
            <div class="alumni_title">
                <h1>Few Alumni</h1>
            </div>
            <div class="alumni_all">
                <div class="alumni_card">
                    <div class="alumni_image">
                        <img src="./images/hayford.jpg" alt="">
                    </div>
                    <div class="alumni_deatails">
                        <h4>Naana Hayford</h4>
                        <p>Media Personality</p>
                    </div>
                </div>

                <div class="alumni_card">
                    <div class="alumni_image">
                        <img src="./images/antie.jpg" alt="">
                    </div>
                    <div class="alumni_deatails">
                        <h4>Auntie Naa</h4>
                        <p>Host of Oyerepa Afutuo</p>
                    </div>
                </div>

                <div class="alumni_card">
                    <div class="alumni_image">
                        <img src="./images/kwabena.jpg" alt="">
                    </div>
                    <div class="alumni_deatails">
                        <h4>Kwabena Antwi Boasiako</h4>
                        <p>Media Personality</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
  <section>
    <?php include 'footer.php'; ?>
  </section>
  <script>
    function showEventDetails(eventId) {
      window.location.href = 'event_details.php?id=' + eventId;
    }
  </script>
  <script>
    document.getElementById('play-button').addEventListener('click', function() {
      document.getElementById('video-thumbnail').classList.add('hidden');
      this.classList.add('hidden');
    });
  </script>
  <script src="./js/swiper.js"></script>
  <script src="./js/search.js"></script>
</body>

</html>