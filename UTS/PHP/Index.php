  <?php
  if (!defined('BASE_URL')) {
    define('BASE_URL', '../'); 
  }
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BAWEANIQUE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/navbar.css">
    <link rel="stylesheet" href="../CSS/about.css">
  </head>
  <body>
    <!-- Header Navbar -->
    <nav class="navbar navbar-dark d-flex justify-content-between px-4 py-3">
      <!-- Logo -->
      <div>
          <img src="../a1/BAWEANIQUE.png" width="190" height="85" alt="" />
        </div>

      <!-- Center Menu -->
      <div class="d-flex gap-4">
        <a href="<?php echo BASE_URL; ?>PHP/Index.php" class="nav-link text-center">
          <i class="bi bi-house-door"></i>
          <b>Home</b>
        </a>
        <a href="<?php echo BASE_URL; ?>PHP/packages.php" class="nav-link text-center">
          <i class="bi bi-map"></i>
          <b>Packages</b>
        </a>
        <a href="<?php echo BASE_URL; ?>PHP/schedule.php" class="nav-link text-center">
          <i class="bi bi-table"></i>
          <b>Schedule</b>
        </a>
        <a href="<?php echo BASE_URL; ?>PHP/gallery.php" class="nav-link text-center">
          <i class="bi bi-camera"></i>
          <b>Gallery</b>
        </a>
        <a href="<?php echo BASE_URL; ?>PHP/booking.php" class="nav-link text-center">
          <i class="bi bi-cart2"></i>
          <b>My Book</b>
        </a>
        <a href="#about" class="nav-link text-center" id="about-link">
          <i class="bi bi-person-circle"></i>
          <b>About Us</b>
        </a>        
      </div>

    <div class="d-flex gap-2">
      <a href="<?php echo BASE_URL; ?>PHP/login.php" class="btn btn-outline-dark custom-login-btn d-flex align-items-center gap-1">
        <span>Login</span>
        <i class="bi bi-box-arrow-in-right small"></i>
      </a>
      <a href="<?php echo BASE_URL; ?>PHP/SignUp.php" class="btn btn-primary">
        <span>Sign-up</span>
      </a>
    </div>
  </nav>

    <div class="search-bar">
      <input type="text" class="form-control search-input" placeholder="Search..." />
    </div>

    <!--slider-->
    <div id="simpleSlider" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#simpleSlider" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#simpleSlider" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#simpleSlider" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#simpleSlider" data-bs-slide-to="3" aria-label="Slide 4"></button>
        <button type="button" data-bs-target="#simpleSlider" data-bs-slide-to="4" aria-label="Slide 5"></button>
        <button type="button" data-bs-target="#simpleSlider" data-bs-slide-to="5" aria-label="Slide 6"></button>
        <button type="button" data-bs-target="#simpleSlider" data-bs-slide-to="6" aria-label="Slide 7"></button>
      </div>
        <div class="carousel-inner" style="height: 400px; overflow: hidden;">
          <div class="carousel-item active">
            <img src="../a1/1.jpg" class="d-block w-100" alt="Slide 1" style="height: 100%; object-fit: cover;">
          </div>
          <div class="carousel-item">
            <img src="../a1/2.jpg" class="d-block w-100" alt="Slide 2" style="height: 100%; object-fit: cover;">
          </div>
          <div class="carousel-item">
            <img src="../a1/3.jpg" class="d-block w-100" alt="Slide 3" style="height: 100%; object-fit: cover;">
          </div>
          <div class="carousel-item">
            <img src="../a1/4.jpg" class="d-block w-100" alt="Slide 4" style="height: 100%; object-fit: cover;">
          </div>
          <div class="carousel-item">
            <img src="../a1/9.jpg" class="d-block w-100" alt="Slide 5" style="height: 100%; object-fit: cover;">
          </div>
          <div class="carousel-item">
            <img src="../a1/11.jpg" class="d-block w-100" alt="Slide 6" style="height: 100%; object-fit: cover;">
          </div>
          <div class="carousel-item">
            <img src="../a1/12.jpg" class="d-block w-100" alt="Slide 7" style="height: 100%; object-fit: cover;">
          </div>
        </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#simpleSlider" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#simpleSlider" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    
   <!--desc singkat-->
<section class="city-description">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <div class="city-image-container shadow">
          <img src="../a1/2.jpg" class="city-image" alt="Pesona Kota Baweanique">
        </div>
      </div>
      
      <div class="col-lg-6">
        <div class="city-content">
          <h1 class="city-title">Bawean<span class="city-highlight"> Island</span></h1>
          <h3 class="city-subtitle">Destinasi Wisata Pilihan di Jawa Timur</h3>
          <p>
            Bawean dikenal sebagai surganya petualangan alam dan budaya. Terletak di pesisir sebelah utara kota Gresik Jawa Timur,
            pulau ini menawarkan pemandangan pantai yang menakjubkan dan pegunungan yang mempesona dalam satu tempat.
          </p>
          <p>
            Dengan banyaknya destinasi wisata yang tersebar di seluruh wilayahnya,
            Pulau Bawean memadukan keindahan alam dengan kekayaan budaya lokal yang telah diwariskan selama berabad-abad.
          </p>
          <button class="btn read-more-btn mt-4">Jelajahi Lebih Lanjut</button>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- statistik -->
<section class="stats-section">
  <div class="container">
    <div class="stats-container">
      <div class="stat-box">
        <div class="stat-number">500+</div>
        <div class="stat-text">Aktivitas Wisata</div>
      </div>

      <div class="stat-box">
        <div class="stat-number">100+</div>
        <div class="stat-text">Restoran & Kafe</div>
      </div>

      <div class="stat-box">
        <div class="stat-number">35+</div>
        <div class="stat-text">Situs Bersejarah</div>
      </div>
    
      <div class="stat-box">
        <div class="stat-number">15+</div>
        <div class="stat-text">Festival Tahunan</div>
      </div>
    </div>
  </div>
</section>

<!-- Bagian about us-->
<section id="about" class="text-white py-5" style="background-color: #0d6fb1;">
  <div class="container">
    <div class="row align-items-center">
      <!--logo-->
        <div class="col-md-3 mb-4">
          <img src="../a1/baweanique2.png" width="150" height="auto" alt="Logo Baweanique" class="mb-3">
          <p>Baweanique adalah perusahaan penyedia layanan tour dan travel di Pulau Bawean.</p>
        </div>
    <!-- contact us -->
    <div class="col-md-3 mb-4 text-center text-md-start">
      <h5 class="text-uppercase mb-3">Contact Us</h5>
      <ul class="list-unstyled">
        <li class="mb-2"><i class="bi bi-geo-alt"></i> Jl. Purbonegoro No.01, Sangkapura, Bawean, Gresik</li>
        <li class="mb-2"><i class="bi bi-telephone"></i> +62xx-xxxx-xxxx</li>
        <li class="mb-2"><i class="bi bi-envelope"></i> info@baweanique.com</li>
      </ul>
    </div>
    <!-- Support -->
    <div class="col-md-3 mb-4 text-center text-md-start">
      <h5 class="text-uppercase mb-3">Support</h5>
      <ul class="list-unstyled">
        <li class="mb-2">- Documentation</li>
        <li class="mb-2">- Experience</li>
        <li class="mb-2">- Knowledge</li>
        <li class="mb-2">- Forum</li>
      </ul>
    </div>
    <!-- Sosmed -->
    <div class="col-md-3 mb-4 text-center text-md-end">
      <div class="d-flex justify-content-center justify-content-md-end gap-4">
        <a href="#" class="social-icon"><i class="bi bi-facebook fs-1"></i></a>
        <a href="#" class="social-icon"><i class="bi bi-youtube fs-1"></i></a>
        <a href="#" class="social-icon"><i class="bi bi-instagram fs-1"></i></a>
        <a href="#" class="social-icon"><i class="bi bi-tiktok fs-1"></i></a>
      </div>
    </div>

    <div class="copyright text-center">
        Copyright 
    </div> 
  </div> 
</section>

<!-- Tombol Scroll -->
<button id="scrollToTopBtn" title="Kembali ke Atas">
  <i class="bi bi-arrow-up"></i>
  <script src="../JS/Jstombolkecil.js"></script>
</button>
<script src="../JS/JsAbout.js"></script>
  </body>
  </html>