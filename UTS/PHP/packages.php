<?php
  session_start(); // Memulai sesi untuk mengakses variabel sesi
  if (!defined('BASE_URL')) {
    define('BASE_URL', '../'); 
  }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Packages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/about.css">
    <link rel="stylesheet" href="../CSS/navbar.css">
</head>
<body>
    <nav class="navbar navbar-dark d-flex justify-content-between px-4 py-3">
        <div>
          <img src="../a1/BAWEANIQUE.png" width="190" height="85" alt="" />
          </div>
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

      <div class="search-bar">
        <input type="text" class="form-control search-input" placeholder="Search Destination..." />
      </div>
      
    <div class="container mt-5">
      <h1 class="text-center mb-4"><b>Packages Destination</b></h1>
      <p class="text-center mb-4">Explore our exclusive packages designed for your perfect getaway.</p>
    </div>
      <div class="container mt-4">
        <div class="d-flex flex-wrap gap-3 justify-content-center">
          <div class="row">
            <div class="col-md-4 mb-4">
              <div class="card">
                <span class="badge bg-success position-absolute top-0 end-0 m-2 fs-6">Rp 1.800.000</span>
                <img src="../a1/noko.jpg" class="card-img-top" alt="Noko Gili">
                <div class="card-body">
                  <h5 class="card-title">Noko Gili</h5>
                  <p class="card-text">Pulau pasir putih yang menakjubkan ini hanya muncul saat air laut surut. Jelajahi keindahan bawah lautnya.</p>
                  <button type="button" class="btn btn-primary"
                          data-bs-toggle="modal"
                          data-bs-target="#nokoGiliModal"
                          data-keyword="noko">
                          More Info
                  </button>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-4">
              <div class="card">
                <span class="badge bg-success position-absolute top-0 end-0 m-2 fs-6">Rp 1.500.000</span>
                <img src="../a1/tajhunggheen.jpg" class="card-img-top" alt="Tajhunghe'en">
                <div class="card-body">
                  <h5 class="card-title">Tajhunghe'en</h5>
                  <p class="card-text">Nikmati pemandangan tebing karang dan ombak yang menenangkan di spot terbaik untuk bersantai.</p>
                  <button type="button" class="btn btn-primary"
                          data-bs-toggle="modal"
                          data-bs-target="#tajhungheenModal"
                          data-keyword="tajhungheen">
                          More Info
                  </button>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-4">
              <div class="card">
                <span class="badge bg-success position-absolute top-0 end-0 m-2 fs-6">Rp 3.500.000</span>
                <img src="../a1/kastoba.jpg" class="card-img-top" alt="Kastoba Lake">
                <div class="card-body">
                  <h5 class="card-title">Kastoba Lake</h5>
                  <p class="card-text">Danau alami di tengah pulau yang dikelilingi oleh hutan hijau, menawarkan ketenangan dan udara yang sejuk.</p>
                  <button type="button" class="btn btn-primary"
                          data-bs-toggle="modal"
                          data-bs-target="#kastobaModal"
                          data-keyword="kastoba">
                          More Info
                  </button>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-4">
              <div class="card">
                <span class="badge bg-success position-absolute top-0 end-0 m-2 fs-6">Rp 250.000</span>
                <img src="../a1/air terjun.jpg" class="card-img-top" alt="Laccar Waterfall">
                <div class="card-body">
                  <h5 class="card-title">Laccar Waterfall</h5>
                  <p class="card-text">Rasakan kesegaran air terjun yang tersembunyi di pedalaman pulau Bawean.</p>
                  <button type="button" class="btn btn-primary"
                          data-bs-toggle="modal"
                          data-bs-target="#laccarWaterfallModal"
                          data-keyword="laccar">
                          More Info
                  </button>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-4">
              <div class="card">
                <span class="badge bg-success position-absolute top-0 end-0 m-2 fs-6">Rp 700.000</span>
                <img src="../a1/noko selayar.jpg" class="card-img-top" alt="Noko Selayar">
                <div class="card-body">
                  <h5 class="card-title">Noko Selayar</h5>
                  <p class="card-text">Gundukan pasir berbentuk hati yang romantis, menjadi ikon unik dan spot foto favorit di Bawean.</p>
                  <button type="button" class="btn btn-primary"
                          data-bs-toggle="modal"
                          data-bs-target="#nokoSelayarModal"
                          data-keyword="selayar">
                          More Info
                  </button>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-4">
              <div class="card">
                <span class="badge bg-success position-absolute top-0 end-0 m-2 fs-6">Rp 2.500.000</span>
                <img src="../a1/cina.jpg" class="card-img-top" alt="China Island">
                <div class="card-body">
                  <h5 class="card-title">China Island</h5>
                  <p class="card-text">Pulau kecil dengan dermaga ikonik, cocok untuk berenang dan menikmati pemandangan laut yang jernih.</p>
                  <button type="button" class="btn btn-primary"
                          data-bs-toggle="modal"
                          data-bs-target="#chinaIslandModal"
                          data-keyword="china">
                          More Info
                  </button>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-4">
              <div class="card">
                <span class="badge bg-success position-absolute top-0 end-0 m-2 fs-6">Rp 100.000</span>
                <img src="../a1/air panas.jpg" class="card-img-top" alt="Pemandian Air Panas">
                <div class="card-body">
                  <h5 class="card-title">Pemandian Air Panas</h5>
                  <p class="card-text">Relaksasikan tubuh Anda di pemandian air panas alami yang dipercaya memiliki khasiat untuk kesehatan.</p>
                  <button type="button" class="btn btn-primary"
                          data-bs-toggle="modal"
                          data-bs-target="#airPanasModal"
                          data-keyword="air panas">
                          More Info
                  </button>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-4">
              <div class="card">
                <span class="badge bg-success position-absolute top-0 end-0 m-2 fs-6">Rp 950.000</span>
                <img src="../a1/rusa.jpg" class="card-img-top" alt="Bawean Deer Breeding">
                <div class="card-body">
                  <h5 class="card-title">Bawean Deer Breeding</h5>
                  <p class="card-text">Lihat dari dekat Rusa Bawean (Axis kuhlii), spesies endemik yang dilindungi dan menjadi kebanggaan pulau ini.</p>
                  <button type="button" class="btn btn-primary"
                          data-bs-toggle="modal"
                          data-bs-target="#rusaBaweanModal"
                          data-keyword="deer breeding">
                          More Info
                  </button>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-4">
              <div class="card">
                <span class="badge bg-success position-absolute top-0 end-0 m-2 fs-6">Rp 1.200.000</span>
                <img src="../a1/snorkeling.jpg" class="card-img-top" alt="Bawean Underwater">
                <div class="card-body">
                  <h5 class="card-title">Bawean Underwater</h5>
                  <p class="card-text">Selami keindahan bawah laut Bawean yang kaya akan terumbu karang dan biota laut yang beragam.</p>
                  <button type="button" class="btn btn-primary"
                          data-bs-toggle="modal"
                          data-bs-target="#underwaterModal"
                          data-keyword="underwater">
                          More Info
                  </button>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-4">
              <div class="card">
                <span class="badge bg-success position-absolute top-0 end-0 m-2 fs-6">Rp 350.000</span>
                <img src="../a1/mombhul.png" class="card-img-top" alt="Mombhul Beach">
                <div class="card-body">
                  <h5 class="card-title">Mombhul Beach</h5>
                  <p class="card-text">Pantai dengan jajaran perahu nelayan tradisional dan pemandangan sunset yang memukau.</p>
                  <button type="button" class="btn btn-primary"
                          data-bs-toggle="modal"
                          data-bs-target="#mombhulModal"
                          data-keyword="mombhul">
                          More Info
                  </button>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-4">
              <div class="card">
                <span class="badge bg-success position-absolute top-0 end-0 m-2 fs-6">Rp 800.000</span>
                <img src="../a1/lantong.jpg" class="card-img-top" alt="Lantong Waterfall">
                <div class="card-body">
                  <h5 class="card-title">Lantong Waterfall</h5>
                  <p class="card-text">Air terjun cantik lainnya yang menawarkan suasana asri dan kolam alami untuk berenang.</p>
                  <button type="button" class="btn btn-primary"
                          data-bs-toggle="modal"
                          data-bs-target="#lantongModal"
                          data-keyword="lantong">
                          More Info
                  </button>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-4">
              <div class="card">
                <span class="badge bg-success position-absolute top-0 end-0 m-2 fs-6">Rp 200.000</span>
                <img src="../a1/mangrove.jpg" class="card-img-top" alt="Mangrove">
                <div class="card-body">
                  <h5 class="card-title">Mangrove</h5>
                  <p class="card-text">Jelajahi ekosistem hutan bakau yang penting dengan jembatan kayu yang melintas di tengahnya.</p>
                  <button type="button" class="btn btn-primary"
                          data-bs-toggle="modal"
                          data-bs-target="#mangroveModal"
                          data-keyword="mangrove">
                          More Info
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    <div class="modal fade" id="nokoGiliModal" tabindex="-1" aria-labelledby="nokoGiliModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="nokoGiliModalLabel">Noko Gili</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            </button>
          </div>
          <div class="modal-body">
            <img src="../a1/noko.jpg" class="img-fluid mb-3" alt="Noko Gili">
            <h6>Keunggulan & Karakteristik</h6>
              <p>Keunggulan utama Noko Gili adalah fenomena alamnya sebagai pulau pasir yang timbul dan tenggelam.
                Dikelilingi perairan jernih, tempat ini menawarkan pengalaman eksklusif seolah berada di pulau pribadi dengan pemandangan bawah laut yang masih sangat alami.</p>
                <h6>Include</h6>
                <ul>
                  <li><strong>Snorkeling:</strong> Menyelami keindahan terumbu karang dan melihat berbagai jenis ikan berwarna-warni.</li>
                  <li><strong>Berenang & Bersantai:</strong> Menikmati kesegaran air laut yang tenang atau sekadar bersantai di hamparan pasir putih yang halus.</li>
                  <li><strong>Fotografi:</strong> Mengabadikan momen di lanskap yang unik dan fotogenik, terutama saat pulau pasir ini muncul sepenuhnya.</li>
                </ul>
                <hr>
              <div class="text-end">
                <h4 class="price-tag">Harga: Rp 1.800.000/Person</h4>
              </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="modal fade" id="tajhungheenModal" tabindex="-1" aria-labelledby="tajhungheenModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="tajhungheenModalLabel">Tajhunghe'en</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <img src="../a1/tajhunggheen.jpg" class="img-fluid mb-3" alt="Tajhunghe'en">
              <h6>Keunggulan & Karakteristik</h6>
              <p>Keunggulan utama Noko Gili adalah fenomena alamnya sebagai pulau pasir yang timbul dan tenggelam.
              Dikelilingi perairan jernih, tempat ini menawarkan pengalaman eksklusif seolah berada di pulau pribadi dengan pemandangan bawah laut yang masih sangat alami.</p>
              <h6>Include</h6>
                <ul>
                  <li><strong>Snorkeling:</strong> Menyelami keindahan terumbu karang dan melihat berbagai jenis ikan berwarna-warni.</li>
                  <li><strong>Berenang & Bersantai:</strong> Menikmati kesegaran air laut yang tenang atau sekadar bersantai di hamparan pasir putih yang halus.</li>
                  <li><strong>Fotografi:</strong> Mengabadikan momen di lanskap yang unik dan fotogenik, terutama saat pulau pasir ini muncul sepenuhnya.</li>
                </ul>
              <hr>
              <div class="text-end">
                <h4 class="price-tag">Harga: Rp 1.500.000/Person</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    <div class="modal fade" id="kastobaModal" tabindex="-1" aria-labelledby="kastobaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="kastobaModalLabel">Kastoba Lake</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <img src="../a1/kastoba.jpg" class="img-fluid mb-3" alt="Kastoba Lake">
              <h6>Keunggulan & Karakteristik</h6>
              <p>Keunggulan utama Noko Gili adalah fenomena alamnya sebagai pulau pasir yang timbul dan tenggelam.
              Dikelilingi perairan jernih, tempat ini menawarkan pengalaman eksklusif seolah berada di pulau pribadi dengan pemandangan bawah laut yang masih sangat alami.</p>
              <h6>Include</h6>
                <ul>
                  <li><strong>Snorkeling:</strong> Menyelami keindahan terumbu karang dan melihat berbagai jenis ikan berwarna-warni.</li>
                  <li><strong>Berenang & Bersantai:</strong> Menikmati kesegaran air laut yang tenang atau sekadar bersantai di hamparan pasir putih yang halus.</li>
                  <li><strong>Fotografi:</strong> Mengabadikan momen di lanskap yang unik dan fotogenik, terutama saat pulau pasir ini muncul sepenuhnya.</li>
                </ul>
              <hr>
              <div class="text-end">
                <h4 class="price-tag">Harga: Rp 3.500.000/Person</h4>
              </div>
            </div>
          </div>
      </div>
    </div>

    <div class="modal fade" id="laccarWaterfallModal" tabindex="-1" aria-labelledby="laccarWaterfallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="laccarWaterfallModalLabel">Laccar Waterfall</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <img src="../a1/air terjun.jpg" class="img-fluid mb-3" alt="Laccar Waterfall">
              <h6>Keunggulan & Karakteristik</h6>
              <p>Keunggulan utama Noko Gili adalah fenomena alamnya sebagai pulau pasir yang timbul dan tenggelam.
              Dikelilingi perairan jernih, tempat ini menawarkan pengalaman eksklusif seolah berada di pulau pribadi dengan pemandangan bawah laut yang masih sangat alami.</p>
              <h6>Include</h6>
                <ul>
                  <li><strong>Snorkeling:</strong> Menyelami keindahan terumbu karang dan melihat berbagai jenis ikan berwarna-warni.</li>
                  <li><strong>Berenang & Bersantai:</strong> Menikmati kesegaran air laut yang tenang atau sekadar bersantai di hamparan pasir putih yang halus.</li>
                  <li><strong>Fotografi:</strong> Mengabadikan momen di lanskap yang unik dan fotogenik, terutama saat pulau pasir ini muncul sepenuhnya.</li>
                </ul>
              <hr>
              <div class="text-end">
                <h4 class="price-tag">Harga: Rp 450.000/Person</h4>
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="nokoSelayarModal" tabindex="-1" aria-labelledby="nokoSelayarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="nokoSelayarModalLabel">Noko Selayar</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <img src="../a1/noko selayar.jpg" class="img-fluid mb-3" alt="Noko Selayar">
              <h6>Keunggulan & Karakteristik</h6>
              <p>Keunggulan utama Noko Gili adalah fenomena alamnya sebagai pulau pasir yang timbul dan tenggelam.
              Dikelilingi perairan jernih, tempat ini menawarkan pengalaman eksklusif seolah berada di pulau pribadi dengan pemandangan bawah laut yang masih sangat alami.</p>
              <h6>Include</h6>
                <ul>
                  <li><strong>Snorkeling:</strong> Menyelami keindahan terumbu karang dan melihat berbagai jenis ikan berwarna-warni.</li>
                  <li><strong>Berenang & Bersantai:</strong> Menikmati kesegaran air laut yang tenang atau sekadar bersantai di hamparan pasir putih yang halus.</li>
                  <li><strong>Fotografi:</strong> Mengabadikan momen di lanskap yang unik dan fotogenik, terutama saat pulau pasir ini muncul sepenuhnya.</li>
                </ul>
              <hr>
              <div class="text-end">
                <h4 class="price-tag">Harga: Rp 7000.000/Person</h4>
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="chinaIslandModal" tabindex="-1" aria-labelledby="chinaIslandModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="chinaIslandModalLabel">China Island</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <img src="../a1/cina.jpg" class="img-fluid mb-3" alt="China Island">
              <h6>Keunggulan & Karakteristik</h6>
              <p>Keunggulan utama Noko Gili adalah fenomena alamnya sebagai pulau pasir yang timbul dan tenggelam.
              Dikelilingi perairan jernih, tempat ini menawarkan pengalaman eksklusif seolah berada di pulau pribadi dengan pemandangan bawah laut yang masih sangat alami.</p>
              <h6>Include</h6>
                <ul>
                  <li><strong>Snorkeling:</strong> Menyelami keindahan terumbu karang dan melihat berbagai jenis ikan berwarna-warni.</li>
                  <li><strong>Berenang & Bersantai:</strong> Menikmati kesegaran air laut yang tenang atau sekadar bersantai di hamparan pasir putih yang halus.</li>
                  <li><strong>Fotografi:</strong> Mengabadikan momen di lanskap yang unik dan fotogenik, terutama saat pulau pasir ini muncul sepenuhnya.</li>
                </ul>
              <hr>
              <div class="text-end">
                <h4 class="price-tag">Harga: Rp 2.500.000/Person</h4>
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="airPanasModal" tabindex="-1" aria-labelledby="airPanasModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="airPanasModalLabel">Pemandian Air Panas</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <img src="../a1/air panas.jpg" class="img-fluid mb-3" alt="Pemandian Air Panas">
              <h6>Keunggulan & Karakteristik</h6>
              <p>Keunggulan utama Noko Gili adalah fenomena alamnya sebagai pulau pasir yang timbul dan tenggelam.
              Dikelilingi perairan jernih, tempat ini menawarkan pengalaman eksklusif seolah berada di pulau pribadi dengan pemandangan bawah laut yang masih sangat alami.</p>
              <h6>Include</h6>
                <ul>
                  <li><strong>Snorkeling:</strong> Menyelami keindahan terumbu karang dan melihat berbagai jenis ikan berwarna-warni.</li>
                  <li><strong>Berenang & Bersantai:</strong> Menikmati kesegaran air laut yang tenang atau sekadar bersantai di hamparan pasir putih yang halus.</li>
                  <li><strong>Fotografi:</strong> Mengabadikan momen di lanskap yang unik dan fotogenik, terutama saat pulau pasir ini muncul sepenuhnya.</li>
                </ul>
              <hr>
              <div class="text-end">
                <h4 class="price-tag">Harga: Rp 450.000/Person</h4>
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="rusaBaweanModal" tabindex="-1" aria-labelledby="rusaBaweanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="rusaBaweanModalLabel">Bawean Deer Breeding</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <img src="../a1/rusa.jpg" class="img-fluid mb-3" alt="Bawean Deer Breeding">
              <h6>Keunggulan & Karakteristik</h6>
              <p>Keunggulan utama Noko Gili adalah fenomena alamnya sebagai pulau pasir yang timbul dan tenggelam.
              Dikelilingi perairan jernih, tempat ini menawarkan pengalaman eksklusif seolah berada di pulau pribadi dengan pemandangan bawah laut yang masih sangat alami.</p>
              <h6>Include</h6>
                <ul>
                  <li><strong>Snorkeling:</strong> Menyelami keindahan terumbu karang dan melihat berbagai jenis ikan berwarna-warni.</li>
                  <li><strong>Berenang & Bersantai:</strong> Menikmati kesegaran air laut yang tenang atau sekadar bersantai di hamparan pasir putih yang halus.</li>
                  <li><strong>Fotografi:</strong> Mengabadikan momen di lanskap yang unik dan fotogenik, terutama saat pulau pasir ini muncul sepenuhnya.</li>
                </ul>
              <hr>
              <div class="text-end">
                <h4 class="price-tag">Harga: Rp 950.000/Person</h4>
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="underwaterModal" tabindex="-1" aria-labelledby="underwaterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="underwaterModalLabel">Bawean Underwater</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <img src="../a1/snorkeling.jpg" class="img-fluid mb-3" alt="Bawean Underwater">
              <h6>Keunggulan & Karakteristik</h6>
              <p>Keunggulan utama Noko Gili adalah fenomena alamnya sebagai pulau pasir yang timbul dan tenggelam.
              Dikelilingi perairan jernih, tempat ini menawarkan pengalaman eksklusif seolah berada di pulau pribadi dengan pemandangan bawah laut yang masih sangat alami.</p>
              <h6>Include</h6>
                <ul>
                  <li><strong>Snorkeling:</strong> Menyelami keindahan terumbu karang dan melihat berbagai jenis ikan berwarna-warni.</li>
                  <li><strong>Berenang & Bersantai:</strong> Menikmati kesegaran air laut yang tenang atau sekadar bersantai di hamparan pasir putih yang halus.</li>
                  <li><strong>Fotografi:</strong> Mengabadikan momen di lanskap yang unik dan fotogenik, terutama saat pulau pasir ini muncul sepenuhnya.</li>
                </ul>
              <hr>
              <div class="text-end">
                <h4 class="price-tag">Harga: Rp 1.200.000/Person</h4>
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="mombhulModal" tabindex="-1" aria-labelledby="mombhulModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="mombhulModalLabel">Mombhul Beach</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <img src="../a1/mombhul.png" class="img-fluid mb-3" alt="Mombhul Beach">
              <h6>Keunggulan & Karakteristik</h6>
              <p>Keunggulan utama Noko Gili adalah fenomena alamnya sebagai pulau pasir yang timbul dan tenggelam.
              Dikelilingi perairan jernih, tempat ini menawarkan pengalaman eksklusif seolah berada di pulau pribadi dengan pemandangan bawah laut yang masih sangat alami.</p>
              <h6>Include</h6>
                <ul>
                  <li><strong>Snorkeling:</strong> Menyelami keindahan terumbu karang dan melihat berbagai jenis ikan berwarna-warni.</li>
                  <li><strong>Berenang & Bersantai:</strong> Menikmati kesegaran air laut yang tenang atau sekadar bersantai di hamparan pasir putih yang halus.</li>
                  <li><strong>Fotografi:</strong> Mengabadikan momen di lanskap yang unik dan fotogenik, terutama saat pulau pasir ini muncul sepenuhnya.</li>
                </ul>
              <hr>
              <div class="text-end">
                <h4 class="price-tag">Harga: Rp 450.000/Person</h4>
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="lantongModal" tabindex="-1" aria-labelledby="lantongModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header"><h5 class="modal-title" id="lantongModalLabel">Lantong Waterfall</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <img src="../a1/lantong.jpg" class="img-fluid mb-3" alt="Lantong Waterfall">
            <h6>Keunggulan & Karakteristik</h6>
              <p>Keunggulan utama Noko Gili adalah fenomena alamnya sebagai pulau pasir yang timbul dan tenggelam.
              Dikelilingi perairan jernih, tempat ini menawarkan pengalaman eksklusif seolah berada di pulau pribadi dengan pemandangan bawah laut yang masih sangat alami.</p>
              <h6>Include</h6>
                <ul>
                  <li><strong>Snorkeling:</strong> Menyelami keindahan terumbu karang dan melihat berbagai jenis ikan berwarna-warni.</li>
                  <li><strong>Berenang & Bersantai:</strong> Menikmati kesegaran air laut yang tenang atau sekadar bersantai di hamparan pasir putih yang halus.</li>
                  <li><strong>Fotografi:</strong> Mengabadikan momen di lanskap yang unik dan fotogenik, terutama saat pulau pasir ini muncul sepenuhnya.</li>
                </ul>
              <hr>
              <div class="text-end">
                <h4 class="price-tag">Harga: Rp 800.000/Person</h4>
              </div>
            </div>
        </div>
      </div>
    </div>
    
    <div class="modal fade" id="mangroveModal" tabindex="-1" aria-labelledby="mangroveModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="mangroveModalLabel">Mangrove</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <img src="../a1/mangrove.jpg" class="img-fluid mb-3" alt="Mangrove">
              <h6>Keunggulan & Karakteristik</h6>
              <p>Keunggulan utama Noko Gili adalah fenomena alamnya sebagai pulau pasir yang timbul dan tenggelam.
              Dikelilingi perairan jernih, tempat ini menawarkan pengalaman eksklusif seolah berada di pulau pribadi dengan pemandangan bawah laut yang masih sangat alami.</p>
              <h6>Include</h6>
                <ul>
                  <li><strong>Snorkeling:</strong> Menyelami keindahan terumbu karang dan melihat berbagai jenis ikan berwarna-warni.</li>
                  <li><strong>Berenang & Bersantai:</strong> Menikmati kesegaran air laut yang tenang atau sekadar bersantai di hamparan pasir putih yang halus.</li>
                  <li><strong>Fotografi:</strong> Mengabadikan momen di lanskap yang unik dan fotogenik, terutama saat pulau pasir ini muncul sepenuhnya.</li>
                </ul>
              <hr>
              <div class="text-end">
                <h4 class="price-tag">Harga: Rp 450.000/Person</h4>
              </div>
            </div>
          </div>
        </div>
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
        <a href="https://youtu.be/vSa8xdmPTy0?si=RZM8l5BH_cZ261CH" class="social-icon"><i class="bi bi-youtube fs-1"></i></a>
        <a href="https://www.instagram.com/ouwchiee_/" class="social-icon"><i class="bi bi-instagram fs-1"></i></a>
        <a href="https://www.tiktok.com/@babynacho6" class="social-icon"><i class="bi bi-tiktok fs-1"></i></a>
      </div>
    </div>

    <div class="copyright text-center">
        Copyright - Baweanique Team 
    </div> 
  </div> 
</section>

    <button id="scrollToTopBtn" title="Kembali ke Atas">
      <i class="bi bi-arrow-up"></i>
      <script src="../JS/JsSearch.js"></script>
      <script src="../JS/Jstombolkecil.js"></script>
    </button>
    <script src="../JS/JsAbout.js"></script>
  </body>
</html>