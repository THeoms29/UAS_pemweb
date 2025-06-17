<?php
  if (!defined('BASE_URL')) {
    define('BASE_URL', '../'); 
  }
  require_once('koneksi.php');

  $sql = "SELECT  s.schedule_id,
    s.schedule_date,
    s.start_time,
    s.end_time,
    s.daftar_orang,
    s.status,
    p.name AS package_name,
    p.price
        FROM schedules s
        JOIN packages p ON s.package_id = p.package_id
        ORDER BY s.schedule_date";

$stmt = $pdo->query($sql);
$schedules = $stmt->fetchAll();
  ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Schedule Tour</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="../CSS/navbar.css">
  <link rel="stylesheet" href="../CSS/style.css">
  <link rel="stylesheet" href="../CSS/schedule.css">
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
        <i class="bi bi-house-door"></i><b>Home</b>
      </a>
      <a href="<?php echo BASE_URL; ?>PHP/packages.php" class="nav-link text-center">
        <i class="bi bi-map"></i><b>Packages</b>
      </a>
      <a href="<?php echo BASE_URL; ?>PHP/schedule.php" class="nav-link text-center">
        <i class="bi bi-table"></i><b>Schedule</b>
      </a>
      <a href="<?php echo BASE_URL; ?>PHP/gallery.php" class="nav-link text-center">
        <i class="bi bi-camera"></i><b>Gallery</b>
      </a>
      <a href="<?php echo BASE_URL; ?>PHP/booking.php" class="nav-link text-center">
          <i class="bi bi-cart2"></i><b>My Book</b>
     </a>
      <a href="#about" class="nav-link text-center" id="about-link">
        <i class="bi bi-person-circle"></i><b>About Us</b>
      </a>
    </div>
    
    <div class="d-flex gap-2">
      <a href="<?php echo BASE_URL; ?>PHP/login.php" class="btn btn-outline-dark custom-login-btn d-flex align-items-center gap-1 rounded-pill">
        <span>Login</span><i class="bi bi-box-arrow-in-right small"></i>
      </a>
      <a href="<?php echo BASE_URL; ?>PHP/SignUp.php" class="btn btn-primary rounded-pill">
        <span>Sign-up</span>
      </a>
    </div>
  </nav>

  <div class="container-schedule">
    <h1><b>Jadwal Tour Mingguan</b></h1>

    <table class="schedule-table font-table">
      <thead>
        <tr>
          <th>Hari</th>
          <th>Destinasi</th>
          <th>Waktu</th>
          <th>Durasi</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
         <?php foreach ($schedules as $row): ?>
          <?php
          $hari_en = date('l', strtotime($row['schedule_date']));
          $hari_id = [
          'Sunday'    => 'Minggu',
          'Monday'    => 'Senin',
          'Tuesday'   => 'Selasa',
          'Wednesday' => 'Rabu',
          'Thursday'  => 'Kamis',
          'Friday'    => 'Jumat',
          'Saturday'  => 'Sabtu'
          ]
          ?>
    <tr>
      <td><?= $hari_id[$hari_en] ?? $hari_en ?></td>
      <td><?= htmlspecialchars($row['package_name']) ?></td>
      <td><?= htmlspecialchars(substr($row['start_time'], 0, 5)) ?></td>
      <td>
        <?= 
          round((strtotime($row['end_time']) - strtotime($row['start_time'])) / 3600) . ' Jam'; 
        ?>
      </td>
      <td><span class="status <?= $row['status'] ?>"><?= ucfirst($row['status']) ?></span></td>
      <td>
        <?php if ($row['status'] == 'tersedia'): ?>
          <a href="booking.php" class="btn book">Book Now</a>
        <?php elseif ($row['status'] == 'penuh'): ?>
          <button class="btn full" disabled>Full</button>
        <?php else: ?>
          <button class="btn request">Request</button>
        <?php endif; ?>
      </td>
    </tr>
  <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!-- Section About Us -->
  <section id="about" class="text-white py-5" style="background-color: #0d6fb1;">
    <div class="container">
      <div class="row align-items-center">
        <!-- Logo dan Deskripsi -->
        <div class="col-md-3 mb-4">
          <img src="../a1/baweanique2.png" width="150" height="auto" alt="Logo Baweanique" class="mb-3">
          <p>Baweanique adalah perusahaan penyedia layanan tour dan travel di Pulau Bawean.</p>
        </div>

        <!-- Kontak -->
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

        <!-- Sosial Media -->
        <div class="col-md-3 mb-4 text-center text-md-end">
          <div class="d-flex justify-content-center justify-content-md-end gap-4">
            <a href="#" class="social-icon"><i class="bi bi-facebook fs-1"></i></a>
            <a href="#" class="social-icon"><i class="bi bi-youtube fs-1"></i></a>
            <a href="#" class="social-icon"><i class="bi bi-instagram fs-1"></i></a>
            <a href="#" class="social-icon"><i class="bi bi-tiktok fs-1"></i></a>
          </div>
        </div>

        <!-- Copyright -->
        <div class="copyright text-center">
          Copyright © Nabilafarahh - Theodore
        </div>
      </div>
    </div>
  </section>

  <!-- Tombol Scroll ke Atas -->
  <button id="scrollToTopBtn" title="Kembali ke Atas">
    <i class="bi bi-arrow-up"></i>
  </button>

  <!-- Script -->
  <script src="../JS/JsSchedule.js"></script>
  <script src="../JS/Jstombolkecil.js"></script>
  <script src="../JS/JsAbout.js"></script>
</body>
</html>