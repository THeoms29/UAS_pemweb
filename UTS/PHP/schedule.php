<?php
  if (!defined('BASE_URL')) {
    define('BASE_URL', '../'); 
  }
  session_start();
  require_once('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Sertakan file koneksi database
    require_once 'koneksi.php';

    // Fungsi untuk mengirim respons JSON dan menghentikan skrip
    function send_json_response($success, $message, $redirect = null) {
    $resp = ['success' => $success, 'message' => $message];
    if ($redirect) {
        $resp['redirect'] = $redirect;
    }
    echo json_encode($resp);
    exit;
}

// 1) Must be POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    send_json_response(false, "Metode request tidak valid.");
}

// 2) Must be logged in
if (!isset($_SESSION['user_id'])) {
    send_json_response(false, "Silakan login terlebih dahulu.");
}

// 3) Collect & validate inputs
$schedule_id = trim($_POST['schedule_id']  ?? '');
$quantity    = trim($_POST['quantity']     ?? '');
$total_price = trim($_POST['total_price']  ?? '');

if ($schedule_id === '' || $quantity === '' || $total_price === '') {
    send_json_response(false, "Data booking tidak lengkap.");
}

// 4) Lookup package_id from schedules
$sql  = "SELECT package_id FROM schedules WHERE schedule_id = ?";
$stmt = $conn->prepare($sql);
if (! $stmt) {
    send_json_response(false, "Gagal menyiapkan query lookup jadwal.");
}
$stmt->bind_param("i", $schedule_id);
$stmt->execute();
$result = $stmt->get_result();
$row    = $result->fetch_assoc();
$stmt->close();

if (! $row) {
    send_json_response(false, "Jadwal tidak ditemukan.");
}
$package_id = $row['package_id'];

// 5) Insert booking
$sql  = "INSERT INTO bookings
           (user_id, schedule_id, package_id, quantity, total_price, status)
         VALUES (?, ?, ?, ?, ?, 'pending')";
$stmt = $conn->prepare($sql);
if (! $stmt) {
    send_json_response(false, "Gagal menyiapkan query insert booking.");
}
$stmt->bind_param(
    "iiiid",
    $_SESSION['user_id'],
    $schedule_id,
    $package_id,
    $quantity,
    $total_price
);
$ok = $stmt->execute();
$stmt->close();

if ($ok) {
    send_json_response(
      true,
      "Pemesanan berhasil! Anda akan dialihkan ke My Book.",
      "booking.php"
    );
} else {
    send_json_response(false, "Pemesanan gagal: " . $conn->error);
}
  }

  $sql = "SELECT  s.schedule_id,
    s.schedule_date,
    s.start_time,
    s.end_time,
    s.daftar_orang,
    s.status,
    p.name AS package_name,
    p.price,
    p.package_id
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

  <div class="container-schedule">
    <h1><b>Jadwal Tour Mingguan</b></h1>

    <table class="schedule-table font-table">
      <thead>
        <tr>
          <th>Hari</th>
          <th>Destinasi</th>
          <th>Waktu</th>
          <th>Durasi</th>
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
          ];
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
      <td>
        <?php if ($row['status'] == 'tersedia'): ?>
          <button class="btn book" 
                  onclick="openBookingModal('<?= htmlspecialchars($row['package_name']) ?>', 
                                         <?= $row['price'] ?>, 
                                         '<?= date('d - m - Y', strtotime($row['schedule_date'])) ?>',
                                         <?= $row['schedule_id'] ?>,
                                         <?= $row['package_id'] ?>)">
            Book Now
          </button>
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

  <!-- Modal Booking -->
  <div class="modal fade custom-modal" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header-custom">
          <h4 class="modal-title w-100" id="modalPackageName">PACKAGE NAME</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body modal-body-custom">
          <!-- Tour Image -->
          <div class="tour-image" id="modalTourImage">Tour Image</div>
          
          <!-- Date Display -->
          <div class="date-display" id="dateDisplay">
            <div>Tanggal: <span id="selectedDate">01 - 01 - 2024</span></div>
            <small style="color: #666; font-size: 12px;">Klik untuk mengubah tanggal</small>
          </div>
          
          <!-- Date Picker Modal -->
          <div class="date-picker-modal" id="datePickerModal">
            <div class="date-picker-content">
              <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h3 style="margin: 0; color: #1976d2;">Pilih Tanggal</h3>
                <button id="closeDatePicker" style="background: none; border: none; font-size: 24px; cursor: pointer; color: #666;">&times;</button>
              </div>
              
              <div style="margin-bottom: 15px; text-align: center; color: #666;">
                <small>Pilih tanggal dengan hari yang sama (interval 7 hari)</small>
              </div>
              
              <div id="dateOptions"></div>
            </div>
          </div>
          
          <!-- Price -->
          <div class="text-center">
            <span class="price-tag" id="modalPrice">Rp. 500.000/Person</span>
          </div>
          
          <!-- Include List -->
          <div class="include-list">
            <h5><b>Include :</b></h5>
            <ol id="modalIncludeList">
              <li>Tiket masuk tempat wisata</li>
              <li>Pemandu wisata profesional</li>
              <li>Transportasi antar jemput</li>
              <li>Dokumentasi foto</li>
              <li>Makan siang</li>
            </ol>
          </div>
          
          <!-- Action Buttons -->
          <div class="d-flex gap-3 justify-content-center">
            <form id="booking-form">
              <input type="hidden" name="schedule_id"    id="fd_schedule_id" value="">
              <input type="hidden" name="package_id"     id="fd_package_id"  value="">
              <input type="hidden" name="quantity"       id="fd_quantity"    value="1">
              <input type="hidden" name="total_price"    id="fd_total_price" value="0">
              <button type="submit" class="btn btn-book-now btn-custom" id="bookBtn">
                Book Now
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
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