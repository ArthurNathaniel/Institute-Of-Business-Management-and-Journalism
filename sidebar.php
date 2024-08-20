
</style>
<div class="sidebar_all">
    <div class="logo">

    </div>
    <br>
    <br>
    <div class="links">
        <h3> <span class="icon"><i class="fa-solid fa-chart-simple"></i></span> Admin</h3>
        <a href="">Dashboard</a>
        <a href="view_payments.php">Admission Forms</a>
        <a href="">Admission</a>
        <a href="event_management.php">Upcoming Events</a>
        <a href="add_news.php">Blog</a>
        <a href="add_gallery.php">Gallery</a>
        <a href="add_govering.php">Governing Council</a>
        <a href="add_calendar.php">Calendar</a>
        <a href="add_handbook.php">Handbook</a>
        <a href="add_src.php">SRC</a>
        <a href="view_alumni.php">Alumini</a>
        <a href="">Live</a>
      
        <a href="admin_logout.php">
                <h3> <i class="fas fa-sign-out-alt"></i> LOGOUT
                </h3>
            </a>
    </div>
    <style>
        h3 a {
            background-color: transparent;
        }
    </style>
</div>
<button id="toggleButton">
    <i class="fa-solid fa-bars-staggered"></i>
</button>

<script>
    // Get the button and sidebar elements
    var toggleButton = document.getElementById("toggleButton");
    var sidebar = document.querySelector(".sidebar_all");
    var icon = toggleButton.querySelector("i");

    // Add click event listener to the button
    toggleButton.addEventListener("click", function() {
        // Toggle the visibility of the sidebar
        if (sidebar.style.display === "none" || sidebar.style.display === "") {
            sidebar.style.display = "block";
            icon.classList.remove("fa-bars-staggered");
            icon.classList.add("fa-xmark");
        } else {
            sidebar.style.display = "none";
            icon.classList.remove("fa-xmark");
            icon.classList.add("fa-bars-staggered");
        }
    });
</script>