<?php
  if (!defined('BASE_URL')) {
    define('BASE_URL', '../'); 
  }
  session_start();
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
    
  <!--Header-->
  <div class="container-booking">
    <h1><b>My Booking</b></h1>
    <div class="filter-wrapper">
      <label for="statusFilter">Sort By:</label>
      <select id="statusFilter">
        <option value="all">Semua</option>
        <option value="disetujui">Confirmed</option>
        <option value="menunggu">Pending</option>
      </select>
    </div>
  </div>
  <div id="bookingResult" class="mt-4"></div>


<!-- Bagian about us-->
<section id="about" class="text-white py-5" style="background-color: #0d6fb1;">
  <div class="container">
    <div class="row align-items-center">
      <!--logo-->
        <div class="col-md-3 mb-4">
          <img src="baweanique2.png" width="150" height="auto" alt="Logo Baweanique" class="mb-3">
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

<!-- Tombol Scroll-->
    <button id="scrollToTopBtn" title="Kembali ke Atas">
      <i class="bi bi-arrow-up"></i>
      <script src="../JS/Jstombolkecil.js"></script>
    </button>
    <script src="JsAbout.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
document.addEventListener("DOMContentLoaded", function () {
  const statusFilter = document.getElementById("statusFilter");
  const resultContainer = document.getElementById("bookingResult");

  function loadBookings(status = "all") {
    let statusQuery = status === "disetujui" ? "confirmed" : (status === "menunggu" ? "pending" : "all");
    fetch(`get_booking.php?status=${statusQuery}`)
      .then(response => response.json())
      .then(data => {
        let html = "";
        if (data.length === 0) {
          html = "<p>Tidak ada data booking yang sesuai.</p>";
        } else {
          html = `
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Package</th>
                  <th>Tanggal Keberangkatan</th>
                  <th>Tanggal Booking</th>
                  <th>Jumlah Orang</th>
                  <th>Status</th>
                  <th>Total Harga</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
          `;
let no = 1;
html += `
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Package</th>
        <th>Tanggal Keberangkatan</th>
        <th>Tanggal Booking</th>
        <th>Jumlah Orang</th>
        <th>Status</th>
        <th>Total Harga</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
`;

data.forEach(row => {
  let badgeClass = "secondary";
  if (row.status === "disetujui" || row.status === "Confirmed") badgeClass = "success";
  else if (row.status === "menunggu" || row.status === "Pending") badgeClass = "warning";

  html += `
    <tr>
      <td>${no++}</td>
      <td>${row.package_name}</td>
      <td>${new Date(row.departure_date).toLocaleDateString("id-ID", { day: '2-digit', month: 'long', year: 'numeric' })}</td>
      <td>${new Date(row.booking_date).toLocaleDateString("id-ID", { day: '2-digit', month: 'long', year: 'numeric' })}</td>
      <td>${row.participants} Orang</td>
      <td><span class="badge bg-${badgeClass}">${row.status}</span></td>
      <td>Rp ${parseInt(row.total_price).toLocaleString("id-ID")}</td>
      <td>
        <a href="bookingDetail.php?id=${row.booking_id}" class="btn btn-sm btn-primary">Detail</a>
        <button class="btn btn-sm btn-secondary" disabled>Edit</button>
        <button class="btn btn-sm btn-danger" disabled>Batal</button>
      </td>
    </tr>
  `;
});

html += "</tbody></table>";
            
        }
        resultContainer.innerHTML = html;
      })
      .catch(error => {
        resultContainer.innerHTML = "<p>Gagal mengambil data booking.</p>";
        console.error(error);
      });
  }

  statusFilter.addEventListener("change", function () {
    loadBookings(this.value);
  });

  loadBookings(); // Load awal
});
</script>

</body>
</html>
