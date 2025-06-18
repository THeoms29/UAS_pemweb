<?php
  if (!defined('BASE_URL')) {
  define('BASE_URL', '../'); 
  }
  session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="../CSS/navbar.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/gallery.css">
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

          <div class="d-flex gap-2 align-items-center">
    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
      
      <span class="text-welcome">
        Welcome, <br><b><?php echo htmlspecialchars($_SESSION['user_name']); ?>!</b></br>
      </span>
      <a href="<?php echo BASE_URL; ?>PHP/logout.php" class="btn btn-danger">
        <span></span>
        <i class="bi bi-box-arrow-right"></i>
      </a>

    <?php else: ?>

      <a href="<?php echo BASE_URL; ?>PHP/login.php" class="btn btn-outline-dark custom-login-btn d-flex align-items-center gap-1">
        <span>Login</span>
        <i class="bi bi-box-arrow-in-right small"></i>
      </a>
      <a href="<?php echo BASE_URL; ?>PHP/SignUp.php" class="btn btn-primary">
        <span>Sign-up</span>
      </a>
      
    <?php endif; ?>
  </div>
  </nav>
  </nav>

  <!-- Tombol Scroll to Top -->
<button id="scrollToTopBtn" title="Kembali ke Atas">
  <i class="bi bi-arrow-up"></i>
  <script src="/JS/Jstombolkecil.js"></script>
</button>
<!-- Gallery -->
<div class="container-fluid mt-5">
  <h2 class="text-center mb-4"><b>Our Travel Gallery</b></h2>
  <div class="gallery-container">
   
    <div class="gallery-item size-1">
      <img src="../album/a1.jpg" alt="City streets with colorful buildings" class="gallery-img">
      <div class="overlay">
        <div class="caption">Noko Selayar</div>
      </div>
    </div>
    <div class="gallery-item size-10">
      <img src="../album/a2.jpg" alt="European city street" class="gallery-img">
      <div class="overlay">
        <div class="caption">Lantong Waterfall</div>
      </div>
    </div>
    <div class="gallery-item size-1">
      <img src="../album/a3.jpg" alt="Palm trees and lake" class="gallery-img">
      <div class="overlay">
        <div class="caption">Noko Gili</div>
      </div>
    </div>
    <div class="gallery-item size-1">
      <img src="../album/a4.jpg" alt="Pink architecture" class="gallery-img">
      <div class="overlay">
        <div class="caption">Noko Gili</div>
      </div>
    </div>
    <div class="gallery-item size-1">
      <img src="../album/a5.jpg" alt="Desert road" class="gallery-img">
      <div class="overlay">
        <div class="caption">Paddle & Vibe</div>
      </div>
    </div>
    <div class="gallery-item size-1">
      <img src="../album/a6.jpg" alt="Snowy forest" class="gallery-img">
      <div class="overlay">
        <div class="caption">Lantong Waterfall</div>
      </div>
    </div>
    <div class="gallery-item size-1">
      <img src="../album/a7.jpg " alt="Cabin by the lake" class="gallery-img">
      <div class="overlay">
        <div class="caption">Summer Splash</div>
      </div>
    </div>
    <div class="gallery-item size-1">
      <img src="../a1/8.jpg" alt="Cabin by the lake" class="gallery-img">
      <div class="overlay">
        <div class="caption">Snorkeling</div>
      </div>
    </div>
    <div class="gallery-item size-1">
      <img src="../album/b5.jpg" alt="Cabin by the lake" class="gallery-img">
      <div class="overlay">
        <div class="caption">Tajhunghe'en</div>
      </div>
    </div>
    <div class="gallery-item size-1">
      <img src="../album/a8.jpg" alt="Cabin by the lake" class="gallery-img">
      <div class="overlay">
        <div class="caption">Kano</div>
      </div>
    </div>
    <div class="gallery-item size-1">
      <img src="../album/a9.jpg" alt="Cabin by the lake" class="gallery-img">
      <div class="overlay">
        <div class="caption">Banana Boat</div>
      </div>
    </div>
    <div class="gallery-item size-1">
      <img src="../album/b8.jpg" alt="Cabin by the lake" class="gallery-img">
      <div class="overlay">
        <div class="caption">Snorkeling</div>
      </div>
    </div>
    <div class="gallery-item size-1">
      <img src="../album/c4.jpg" alt ="Cabin by the lake" class="gallery-img">
      <div class="overlay">
        <div class="caption">Pudakit Village</div>
      </div>
    </div>
    <div class="gallery-item size-1">
      <img src="../album/b7.jpg" alt="Cabin by the lake" class="gallery-img">
      <div class="overlay">
        <div class="caption">Sunset</div>
      </div>
    </div>
    <div class="gallery-item size-1">
      <img src="../album/b4.jpg" alt="Cabin by the lake" class="gallery-img">
      <div class="overlay">
        <div class="caption">Sippin' on the Boa</div>
      </div>
    </div>
    <div class="gallery-item size-1">
      <img src="../album/c3.jpg" alt="Cabin by the lake" class="gallery-img">
      <div class="overlay">
        <div class="caption">Kastoba lake</div>
      </div>
    </div>
    <div class="gallery-item size-1">
      <img src="../album/c2.jpg" alt="Cabin by the lake" class="gallery-img">
      <div class="overlay">
        <div class="caption">Noko</div>
      </div>
    </div>
    <div class="gallery-item size-1">
      <img src="../album/c5.jpg" alt="Cabin by the lake" class="gallery-img">
      <div class="overlay">
        <div class="caption">kacamataan</div>
      </div>
    </div>
    <div class="gallery-item size-1">
      <img src="../album/c6.jpg" alt="Cabin by the lake" class="gallery-img">
      <div class="overlay">
        <div class="caption">Angkuh</div>
      </div>
    </div>
    <div class="gallery-item size-1">
      <img src="../album/c7.jpg" alt="Cabin by the lake" class="gallery-img">
      <div class="overlay">
        <div class="caption">Ketemu kang parkir</div>
      </div>
    </div>
    <div class="gallery-item size-1">
      <img src="../album/c8.jpg" alt="Cabin by the lake" class="gallery-img">
      <div class="overlay">
        <div class="caption">PSHT Bawean</div>
      </div>
    </div>
    <div class="gallery-item size-1">
      <img src="../album/c9.jpg" alt="Cabin by the lake" class="gallery-img">
      <div class="overlay">
        <div class="caption">renang</div>
      </div>
    </div>
    <div class="gallery-item size-1">
      <img src="../album/d1.jpg" alt="Cabin by the lake" class="gallery-img">
      <div class="overlay">
        <div class="caption">psht bawean part 2</div>
      </div>
    </div>
    <div class="gallery-item size-1">
      <img src="../album/d2.jpg" alt="Cabin by the lake" class="gallery-img">
      <div class="overlay">
        <div class="caption">Hari paling terang bawean</div>
      </div>
    </div>
    <div class="gallery-item size-1">
      <img src="../album/d3.jpg" alt="Cabin by the lake" class="gallery-img">
      <div class="overlay">
        <div class="caption">me and the boys</div>
      </div>
    </div>
    <div class="gallery-item size-1">
      <img src="../album/d4.jpg" alt="Cabin by the lake" class="gallery-img">
      <div class="overlay">
        <div class="caption">Nelayan bawean Memasak</div>
      </div>
    </div>
    <div class="gallery-item size-1">
      <img src="../album/d5.jpg" alt="Cabin by the lake" class="gallery-img">
      <div class="overlay">
        <div class="caption">manusia terkeren Bawean</div>
      </div>
    </div>
  </div>


  <div class="pagination-container">
  <ul class="pagination">
  <li><a href="#">«</a></li>
  <li><a href="#">1</a></li>
  <li><a href="#" class="active">2</a></li>
  <li><a href="#">3</a></li>
  <li><a href="#">4</a></li>
  <li><a href="#">5</a></li>
  <li><a href="#">»</a></li>
  </ul>
</div>

  <Script src="../JS/JSgallery.js"></Script>
</div>

<!-- Bagian about us-->
<section id="about" class="text-white py-5" style="background-color: #0d6fb1;">
  <div class="container">
    <div class="row align-items-center">
      <!--logo-->
        <div class="col-md-3 mb-4">
          <img src="../a1/baweanique2.png" width="150" height="auto" alt="Logo Baweanique" class="mb-3">
          <p>Baweanique adalah perusahaan penyedia layanan tour dan travel di Pulau Bawean.</p>
        </div>
    <!-- Info -->
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
    <div class="col-md-3 mb-4 text-center text-md-end">
      <div class="d-flex justify-content-center justify-content-md-end gap-4">
        <a href="#" class="social-icon"><i class="bi bi-facebook fs-1"></i></a>
        <a href="#" class="social-icon"><i class="bi bi-youtube fs-1"></i></a>
        <a href="#" class="social-icon"><i class="bi bi-instagram fs-1"></i></a>
        <a href="#" class="social-icon"><i class="bi bi-tiktok fs-1"></i></a>
      </div>
    </div>
    <div class="copyright text-center">
        Copyright © Nabilafarahh - Theodore
    </div> 
  </div> 
</section>
<button id="scrollToTopBtn" title="Kembali ke Atas">
  <i class="bi bi-arrow-up"></i>
  <script src="../JS/Jstombolkecil.js"></script>
</button>
<script src="../JS/JsAbout.js"></script>
  </body>
</html>