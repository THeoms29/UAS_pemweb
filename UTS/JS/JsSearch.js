document.addEventListener("DOMContentLoaded", function () {
  const params = new URLSearchParams(window.location.search);
  const query = params.get("q");

  // Delay pencarian setelah semua elemen (card & modal) selesai dimuat
  if (query) {
    setTimeout(() => {
      const keyword = query.toLowerCase();
      const buttons = document.querySelectorAll("button[data-bs-toggle='modal']");
      let found = false;

      buttons.forEach(btn => {
        const btnKeyword = btn.getAttribute("data-keyword").toLowerCase();
        if (btnKeyword.includes(keyword)) {
          found = true;
          btn.click(); // trigger modal
        }
      });

      if (!found) {
        alert("Destinasi tidak ditemukan.");
      }
    }, 500); // tunggu 0.5 detik agar elemen sudah siap
  }

  // Fitur manual dari input di halaman packages
  const input = document.querySelector(".search-input");
  if (input) {
    input.addEventListener("keydown", function (e) {
      if (e.key === "Enter") {
        e.preventDefault();
        const keyword = input.value.trim().toLowerCase();
        const buttons = document.querySelectorAll("button[data-bs-toggle='modal']");
        let found = false;

        buttons.forEach(btn => {
          const btnKeyword = btn.getAttribute("data-keyword").toLowerCase();
          if (btnKeyword.includes(keyword)) {
            found = true;
            btn.click();
          }
        });

        if (!found) {
          alert("Destinasi tidak ditemukan.");
        }
      }
    });
  }
});
