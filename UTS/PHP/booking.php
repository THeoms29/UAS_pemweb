<?php
session_start();
require_once('koneksi.php');

define('BASE_URL', '../');

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT b.*, p.name AS package_name, p.price AS package_price, s.schedule_date 
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
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>My Booking</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="../CSS/navbar.css">
  <link rel="stylesheet" href="../CSS/style.css">
  <link rel="stylesheet" href="../CSS/gallery.css">
  <link rel="stylesheet" href="../CSS/about.css">
  <style>
    .badge-pending { background-color: #ffc107; color: black; }
    .badge-confirmed { background-color: #28a745; }
    .badge-cancelled { background-color: #dc3545; }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-dark d-flex justify-content-between px-4 py-3">
  <div><img src="../a1/BAWEANIQUE.png" width="190" height="85" alt="Logo" /></div>
  <div class="d-flex gap-4">
    <a href="<?= BASE_URL ?>PHP/Index.php" class="nav-link text-center"><i class="bi bi-house-door"></i><b>Home</b></a>
    <a href="<?= BASE_URL ?>PHP/packages.php" class="nav-link text-center"><i class="bi bi-map"></i><b>Packages</b></a>
    <a href="<?= BASE_URL ?>PHP/schedule.php" class="nav-link text-center"><i class="bi bi-table"></i><b>Schedule</b></a>
    <a href="<?= BASE_URL ?>PHP/gallery.php" class="nav-link text-center"><i class="bi bi-camera"></i><b>Gallery</b></a>
    <a href="<?= BASE_URL ?>PHP/booking.php" class="nav-link text-center"><i class="bi bi-cart2"></i><b>My Book</b></a>
    <a href="#about" class="nav-link text-center" id="about-link"><i class="bi bi-person-circle"></i><b>About Us</b></a>
  </div>
  <div class="d-flex gap-2 align-items-center">
    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
      <span class="text-welcome">Welcome,<br><b><?= htmlspecialchars($_SESSION['user_name']); ?>!</b></span>
      <a href="<?= BASE_URL ?>PHP/logout.php" class="btn btn-danger"><i class="bi bi-box-arrow-right"></i></a>
    <?php else: ?>
      <a href="<?= BASE_URL ?>PHP/login.php" class="btn btn-outline-dark">Login</a>
      <a href="<?= BASE_URL ?>PHP/SignUp.php" class="btn btn-primary">Sign-up</a>
    <?php endif; ?>
  </div>
</nav>

<!-- Tabel Booking -->
<div class="container mt-5 mb-5">
  <h2 class="text-center mb-4">Booking Anda</h2>
  <table class="table table-bordered text-center align-middle" id="bookingTable">
    <thead style="background-color: #007bff; color: white;">
      <tr>
        <th>No</th>
        <th>Packages Name</th>
        <th>Tanggal Tour</th>
        <th>Status</th>
        <th>Total Biaya</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      $no = 1;
      foreach ($bookings as $b): 
        $status = strtolower($b['status']);
        $badgeClass = $status === 'pending' ? 'badge-pending' : ($status === 'confirmed' ? 'badge-confirmed' : 'badge-cancelled');
        $disabled = $status !== 'pending' ? 'disabled' : '';
        $total = is_numeric($b['package_price']) ? number_format($b['package_price'], 0, ',', '.') : '0';
      ?>
        <tr id="booking-row-<?= $b['booking_id'] ?>">
          <td><?= $no++ ?></td>
          <td><?= htmlspecialchars($b['package_name']) ?></td>
          <td><?= date('d - m - Y', strtotime($b['schedule_date'])) ?></td>
          <td><span class="badge <?= $badgeClass ?> px-3 py-2 fw-semibold text-capitalize"><?= $b['status'] ?></span></td>
          <td>Rp <?= $total ?></td>
          <td class="d-flex justify-content-center gap-2">
            <button class="btn btn-primary btn-sm" <?= $disabled ?>><i class="bi bi-bag-check"></i> Book Now</button>
            <button class="btn btn-warning btn-sm text-white btn-edit-booking" 
              data-booking-id="<?= $b['booking_id'] ?>" 
              data-package-id="<?= $b['package_id'] ?>" 
              data-schedule-date="<?= $b['schedule_date'] ?>" <?= $disabled ?>>
              <i class="bi bi-pencil"></i> Edit
            </button>
            <button class="btn btn-danger btn-sm btn-batal-booking" data-booking-id="<?= $b['booking_id'] ?>" <?= $disabled ?>><i class="bi bi-x-circle"></i> Batal</button>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<!-- Modal Edit Booking -->
<div class="modal fade" id="editBookingModal" tabindex="-1" aria-labelledby="editBookingLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="editBookingForm">
        <div class="modal-header">
          <h5 class="modal-title" id="editBookingLabel">Edit Jadwal Booking</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">

          <input type="hidden" id="edit-booking-id" name="booking_id">
          <input type="hidden" id="edit-schedule-date" name="schedule_date">

          <div class="mb-3">
            <label class="form-label">Tanggal Tour</label>
            <div class="date-display border rounded p-2" id="editDateDisplay" style="cursor: pointer;">
              <div>Tanggal: <span id="editSelectedDate">Pilih tanggal</span></div>
              <small style="color: #666; font-size: 12px;">Klik untuk mengubah tanggal</small>
            </div>
          </div>

          <!-- Date Picker Modal -->
          <div class="date-picker-modal" id="editDatePickerModal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background-color:rgba(0,0,0,0.5);z-index:1055;justify-content:center;align-items:center;">
            <div class="date-picker-content bg-white p-4 rounded" style="width:90%;max-width:400px;">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="m-0 text-primary">Pilih Tanggal</h5>
                <button type="button" id="closeEditDatePicker" class="btn btn-sm btn-light">&times;</button>
              </div>
              <div id="editDateOptions"></div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Simpan Perubahan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Bagian About -->
<section id="about" class="text-white py-5" style="background-color: #0d6fb1;">
  <div class="container text-center">
    <p>Baweanique adalah perusahaan penyedia layanan tour dan travel di Pulau Bawean.</p>
  </div>
</section>

<!-- Tombol Scroll -->
<button id="scrollToTopBtn" title="Kembali ke Atas"><i class="bi bi-arrow-up"></i></button>

<script src="../JS/Jstombolkecil.js"></script>
<script>
  const scrollBtn = document.getElementById('scrollToTopBtn');
  window.onscroll = () => {
    scrollBtn.style.display = (document.documentElement.scrollTop > 300) ? 'block' : 'none';
  };
  scrollBtn.onclick = () => {
    document.documentElement.scrollTo({ top: 0, behavior: 'smooth' });
  };

  document.querySelectorAll('.btn-batal-booking').forEach(button => {
    button.addEventListener('click', () => {
      const bookingId = button.getAttribute('data-booking-id');
      if (confirm('Yakin ingin membatalkan booking ini?')) {
        fetch('batal_booking.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: new URLSearchParams({ booking_id: bookingId })
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            document.getElementById(`booking-row-${bookingId}`).remove();
            alert('Booking berhasil dibatalkan.');
          } else {
            alert(data.error || 'Gagal membatalkan booking.');
          }
        })
        .catch(error => {
          alert('Terjadi kesalahan saat membatalkan booking.');
          console.error(error);
        });
      }
    });
  });

  document.querySelectorAll('.btn-edit-booking').forEach(button => {
    button.addEventListener('click', () => {
      const bookingId = button.getAttribute('data-booking-id');
      const packageId = button.getAttribute('data-package-id');
      const modal = new bootstrap.Modal(document.getElementById('editBookingModal'));
      const select = document.getElementById('edit-schedule-id');

      document.getElementById('edit-booking-id').value = bookingId;
      select.innerHTML = '<option value="">Memuat jadwal...</option>';

      fetch(`get_schedule.php?package_id=${packageId}`)
        .then(res => res.json())
        .then(data => {
          select.innerHTML = '<option value="">-- Pilih Jadwal --</option>';
          data.forEach(s => {
            select.innerHTML += `<option value="${s.schedule_id}">${s.schedule_date}</option>`;
          });
          modal.show();
        })
        .catch(() => {
          select.innerHTML = '<option value="">Gagal memuat jadwal</option>';
        });
    });
  });

  document.getElementById('editBookingForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new URLSearchParams(new FormData(this));

    fetch('edit_booking.php', {
      method: 'POST',
      body: formData
    })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          alert('Jadwal booking berhasil diperbarui.');
          location.reload();
        } else {
          alert(data.error || 'Gagal mengubah booking.');
        }
      })
      .catch(err => {
        alert('Terjadi kesalahan saat mengirim permintaan.');
        console.error(err);
      });
  });
</script>
<style>
.date-picker-modal {
  display: none; position: fixed; top: 0; left: 0; width: 100%;
  height: 100%; background: rgba(0,0,0,0.5);
  justify-content: center; align-items: center; z-index: 1055;
}
.date-picker-content {
  background: #fff; padding: 20px; border-radius: 10px;
  width: 90%; max-width: 400px;
}
.date-option {
  padding: 8px; border: 1px solid #ccc; margin-bottom: 6px;
  border-radius: 5px; cursor: pointer;
}
.date-option:hover {
  background-color: #f0f0f0;
}
</style>
<script src="../JS/WeeklyDatePickerEdit.js"></script>



</body>
</html>
