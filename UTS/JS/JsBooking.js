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

  // Logika baru untuk tombol "Book Now" di halaman My Booking
  document.querySelectorAll('.btn-book-now-mybooking').forEach(button => {
    button.addEventListener('click', () => {
      const bookingId = button.getAttribute('data-booking-id');
      if (confirm('Yakin ingin mengkonfirmasi booking ini?')) {
        fetch('update_booking_status.php', { // Ganti dengan nama file baru Anda
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: new URLSearchParams({ booking_id: bookingId })
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            alert('Booking berhasil dikonfirmasi! Kamu akan diarahkan ke WhatsApp untuk konfirmasi ulang.');
            window.open('https://wa.me/6288805327491', '_blank');
            const row = document.getElementById(`booking-row-${bookingId}`);
            if (row) {
              const statusCell = row.querySelector('.badge');
              if (statusCell) {
                statusCell.textContent = 'confirmed';
                statusCell.classList.remove('badge-pending');
                statusCell.classList.add('badge-confirmed');
              }
              // Nonaktifkan atau sembunyikan tombol "Book Now" dan "Batal" setelah dikonfirmasi
              button.setAttribute('disabled', 'disabled');
              const batalButton = row.querySelector('.btn-batal-booking');
              if (batalButton) {
                batalButton.setAttribute('disabled', 'disabled');
              }
            }
          } else {
            alert(data.message || 'Gagal mengkonfirmasi booking.');
          }
        })
        .catch(error => {
          alert('Terjadi kesalahan saat mengkonfirmasi booking.');
          console.error(error);
        });
      }
    });
  });

  // Kode untuk .btn-edit-booking dan editBookingForm (jika masih diperlukan)
  // ... (biarkan kode ini tetap ada jika Anda menggunakannya di tempat lain)
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