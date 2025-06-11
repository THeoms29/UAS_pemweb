<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Booking</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="about.css">
    <link rel="stylesheet" href="booking.css">
</head>
<body class="bg-light">
    <!-- Header Navbar -->
  <nav class="navbar navbar-dark d-flex justify-content-between px-4 py-3">
    <!-- Logo -->
    <div>
        <img src="BAWEANIQUE.png" width="190" height="85" alt="" />
      </div>
    <!-- Center Menu -->
    <div class="d-flex gap-4">
      <a href="Index.html" class="nav-link text-center">
        <i class="bi bi-house-door"></i>
        <b>Home</b>
      </a>
      <a href="packages.html" class="nav-link text-center">
        <i class="bi bi-map"></i>
        <b>Packages</b>
      </a>
      <a href="schedule.html" class="nav-link text-center">
        <i class="bi bi-table"></i>
        <b>Schedule</b>
      </a>
      <a href="gallery.html" class="nav-link text-center">
        <i class="bi bi-camera"></i>
        <b>Gallery</b>
      </a>
      <a href="booking.html" class="nav-link text-center">
          <i class="bi bi-cart2"></i>
          <b>My Book</b>
        </a>
      <a href="#about" class="nav-link text-center" id="about-link">
        <i class="bi bi-person-circle"></i>
        <b>About Us</b>
      </a>
    </div>
    <!-- Right Buttons -->
    <div class="d-flex gap-2">
      <a href="login.html" class="btn btn-outline-dark custom-login-btn d-flex align-items-center gap-1 rounded-pill">
        <span>Login</span>
        <i class="bi bi-box-arrow-in-right small"></i>
      </a>
      <a href="signup.html" class="btn btn-primary rounded-pill">
        <span>Sign-up</span>
      </a>
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
  <script src="Jstombolkecil.js"></script>
</button>

<!-- Tombol Scroll-->
    <button id="scrollToTopBtn" title="Kembali ke Atas">
      <i class="bi bi-arrow-up"></i>
      <script src="Jstombolkecil.js"></script>
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
                  <th>ID</th>
                  <th>User</th>
                  <th>Schedule</th>
                  <th>ID Package</th>
                  <th>Nama Package</th>
                  <th>Status</th>
                  <th>Tanggal Booking</th>
                  <th>Total Harga</th>
                </tr>
              </thead>
              <tbody>
          `;
          data.forEach(row => {
            html += `
              <tr>
                <td>${row.booking_id}</td>
                <td>${row.user_id}</td>
                <td>${row.schedule_id}</td>
                <td>${row.package_id}</td>
                <td>${row.package_name}</td>
                <td>${row.status}</td>
                <td>${row.booking_date}</td>
                <td>${row.total_price}</td>
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
