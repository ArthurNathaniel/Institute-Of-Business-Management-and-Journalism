<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Stay connected with the Institute of Business Management and Journalism's alumni network. Read testimonials from fellow alumni.">
    <meta name="keywords" content="IBM&J, alumni, alumni network, testimonials, media school, Ghana">
    <meta name="author" content="Institute of Business Management and Journalism">
    <title>Alumni - Institute of Business Management and Journalism</title>
    <?php include 'cdn.php'; ?>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/alumni.css">
</head>

<body>
    <?php include 'navbar.php'; ?>
    
    <section class="hero_bg">
        <div class="hero_text">
            <h1>Alumni Network</h1>
            <div class="breadcrumb">
                <p><a href="index.php">Home</a> / Alumni</p>
            </div>
        </div>
    </section>

    <section class="alumni_intro">
        <div class="container">
            <h2>Welcome, Alumni!</h2>
            <p>We are proud of our alumni and their accomplishments. The IBM&J Alumni Network aims to keep our graduates connected with each other and the institute. Join our community, share your experiences, and stay updated on the latest news and events.</p>
        </div>
    </section>

    <section class="testimonials">
        <div class="container">
            <h2>Alumni Testimonials</h2>
            <div class="swiper mySwiper4">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="testimonial">
                            <p>"My time at IBM&J was transformative. The skills I acquired and the connections I made have been invaluable in my career." - Jane Doe, Class of 2015</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial">
                            <p>"The supportive environment at IBM&J helped me grow both professionally and personally. I am proud to be an alumnus of this institution." - John Smith, Class of 2018</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial">
                            <p>"The supportive environment at IBM&J helped me grow both professionally and personally. I am proud to be an alumnus of this institution." - John Smith, Class of 2018</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial">
                            <p>"The supportive environment at IBM&J helped me grow both professionally and personally. I am proud to be an alumnus of this institution." - John Smith, Class of 2018</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial">
                            <p>"The supportive environment at IBM&J helped me grow both professionally and personally. I am proud to be an alumnus of this institution." - John Smith, Class of 2018</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial">
                            <p>"The supportive environment at IBM&J helped me grow both professionally and personally. I am proud to be an alumnus of this institution." - John Smith, Class of 2018</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial">
                            <p>"The supportive environment at IBM&J helped me grow both professionally and personally. I am proud to be an alumnus of this institution." - John Smith, Class of 2018</p>
                        </div>
                    </div>
                    <!-- Add more testimonials here -->
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <section class="footer">
        <?php include 'footer.php'; ?>
    </section>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper4", {
            slidesPerView: 1,
            spaceBetween: 10,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 40,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 50,
                },
            },
        });
    </script>
</body>

</html>
