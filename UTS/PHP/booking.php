<?php
session_start();
require_once('koneksi.php');

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT b.*, p.name AS package_name, s.schedule_date 
        FROM bookings b
        JOIN packages p ON b.package_id = p.package_id
        JOIN schedules s ON b.schedule_id = s.schedule_id
        WHERE b.user_id = ?
        ORDER BY b.created_at DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$bookings = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Book</title>
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
<h2>Booking Anda</h2>
<table border="1">
<tr>
  <th>Nama Paket</th>
  <th>Tanggal</th>
  <th>Status</th>
</tr>
<?php foreach ($bookings as $b): ?>
<tr>
  <td><?= htmlspecialchars($b['package_name']) ?></td>
  <td><?= date('d-m-Y', strtotime($b['schedule_date'])) ?></td>
  <td><?= htmlspecialchars($b['status']) ?></td>
</tr>
<?php endforeach; ?>
<h2 class="text-center my-4">Booking Anda</h2>

<div class="container mb-5">
  <table class="table table-striped table-bordered table-hover">
    <thead class="table-dark">
      <tr>
        <th>Nama Paket</th>
        <th>Tanggal</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($bookings as $b): ?>
      <tr>
        <td><?= htmlspecialchars($b['package_name']) ?></td>
        <td><?= date('d-m-Y', strtotime($b['schedule_date'])) ?></td>
        <td><?= htmlspecialchars($b['status']) ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

</table>
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
      <script src="../JS/Jstombolkecil.js"></script>
    </button>
    <script src="../JS/JsAbout.js"></script>
    <script src="../JS/JsSchedule.js"></script>
    <script src="../JS/JsScheduleModal.js"></script>
  </body>
</html>
