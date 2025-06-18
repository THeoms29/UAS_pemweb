
document.addEventListener("DOMContentLoaded", function () {
  let currentPackageId = null;
  let currentScheduleId = null;

  document.querySelectorAll(".open-modal").forEach(button => {
    button.addEventListener("click", function () {
      currentPackageId = this.dataset.packageId;
      currentScheduleId = this.dataset.scheduleId;
      const title = this.dataset.packageName;
      const price = this.dataset.price;

      document.getElementById("modalPackageId").value = currentPackageId;
      document.getElementById("modalScheduleId").value = currentScheduleId;
      document.getElementById("modalTitle").textContent = title;
      document.getElementById("modalBody").textContent = `Harga: Rp ${price}`;

      new bootstrap.Modal(document.getElementById("detailModal")).show();
    });
  });

  document.getElementById("addCartBtn").addEventListener("click", function () {
    sendBooking("cart");
  });

  document.getElementById("bookNowBtn").addEventListener("click", function () {
    sendBooking("bookNow");
  });

  function sendBooking(action) {
    if (!currentScheduleId || !currentPackageId) {
      alert("Schedule ID atau Package ID tidak ditemukan!");
      return;
    }

    fetch("../PHP/process_booking.php", {
      method: "POST",
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: `schedule_id=${currentScheduleId}&package_id=${currentPackageId}&action=${action}`
    })
      .then(response => response.json())
      .then(data => {
        if (data.success === true) {
          alert("Booking berhasil");
          location.reload();
        } else {
          alert("Booking gagal: " + data.message);
        }
      })
      .catch(error => {
        alert("Terjadi kesalahan: " + error.message);
      });
  }
});
