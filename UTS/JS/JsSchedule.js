// Status filter functionality
document.addEventListener('DOMContentLoaded', function() {
  const statusFilter = document.getElementById('statusFilter');
  if (statusFilter) {
    statusFilter.addEventListener('change', function () {
      const selected = this.value;
      const rows = document.querySelectorAll('.schedule-table tbody tr');

      rows.forEach(row => {
        const statusCell = row.querySelector('.status');
        if (statusCell) {
          const statusClass = statusCell.classList.contains('tersedia') ? 'tersedia' :
                              statusCell.classList.contains('penuh') ? 'penuh' :
                              statusCell.classList.contains('request') ? 'request' : '';

          if (selected === 'all' || statusClass === selected) {
            row.style.display = '';
          } else {
            row.style.display = 'none';
          }
        }
      });
    });
  }
});

class WeeklyDatePicker {
  constructor() {
    this.selectedDate = new Date();
    this.selectedDayOfWeek = this.selectedDate.getDay();
    this.init();
  }

  init() {
    this.setupEventListeners();
    this.updateDateDisplay();
  }

  setupEventListeners() {
    // Klik pada date display untuk buka modal
    const dateDisplay = document.getElementById('dateDisplay');
    if (dateDisplay) {
      dateDisplay.addEventListener('click', () => {
        this.openModal();
      });
    }

    // Close modal
    const closeDatePicker = document.getElementById('closeDatePicker');
    if (closeDatePicker) {
      closeDatePicker.addEventListener('click', () => {
        this.closeModal();
      });
    }

    // Close modal ketika klik di luar
    const datePickerModal = document.getElementById('datePickerModal');
    if (datePickerModal) {
      datePickerModal.addEventListener('click', (e) => {
        if (e.target.id === 'datePickerModal') {
          this.closeModal();
        }
      });
    }
  }

  openModal() {
    const modal = document.getElementById('datePickerModal');
    if (modal) {
      modal.style.display = 'flex';
      this.generateDateOptions();
    }
  }

  closeModal() {
    const modal = document.getElementById('datePickerModal');
    if (modal) {
      modal.style.display = 'none';
    }
  }

  generateDateOptions() {
    const container = document.getElementById('dateOptions');
    if (!container) return;
    
    container.innerHTML = '';

    // Generate tanggal untuk 1 tahun ke depan (52 minggu)
    const startDate = new Date();
    const dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

    // Cari tanggal pertama dengan hari yang sama
    let currentDate = new Date(startDate);
    while (currentDate.getDay() !== this.selectedDayOfWeek) {
      currentDate.setDate(currentDate.getDate() + 1);
    }

    // Generate 52 minggu ke depan
    for (let week = 0; week < 52; week++) {
      const dateOption = new Date(currentDate);
      dateOption.setDate(currentDate.getDate() + (week * 7));

      const dateButton = document.createElement('div');
      dateButton.className = 'date-option';

      const isSelected = this.isSameDate(dateOption, this.selectedDate);
      if (isSelected) {
        dateButton.classList.add('selected');
      }

      const dayName = dayNames[dateOption.getDay()];
      const formattedDate = this.formatDate(dateOption);
      const monthYear = `${monthNames[dateOption.getMonth()]} ${dateOption.getFullYear()}`;

      dateButton.innerHTML = `
        <div>
          <div style="font-weight: bold; font-size: 16px;">${formattedDate}</div>
          <div style="font-size: 12px; opacity: 0.8;">${dayName}</div>
        </div>
        <div style="font-size: 12px; opacity: 0.7;">${monthYear}</div>
      `;

      // Click handler
      dateButton.addEventListener('click', () => {
        this.selectDate(dateOption);
        this.closeModal();
      });

      container.appendChild(dateButton);
    }
  }

  selectDate(date) {
    this.selectedDate = new Date(date);
    this.updateDateDisplay();
    this.onDateChange(date);
  }

  updateDateDisplay() {
    const formattedDate = this.formatDate(this.selectedDate);
    const selectedDateElement = document.getElementById('selectedDate');
    if (selectedDateElement) {
      selectedDateElement.textContent = formattedDate;
    }
  }

  formatDate(date) {
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const year = date.getFullYear();
    return `${day} - ${month} - ${year}`;
  }

  isSameDate(date1, date2) {
    return date1.getDate() === date2.getDate() &&
           date1.getMonth() === date2.getMonth() &&
           date1.getFullYear() === date2.getFullYear();
  }

  onDateChange(newDate) {
    console.log('Tanggal berubah:', this.formatDate(newDate));
  }

  getSelectedDate() {
    return this.selectedDate;
  }

  setInitialDate(date) {
    this.selectedDate = new Date(date);
    this.selectedDayOfWeek = this.selectedDate.getDay();
    this.updateDateDisplay();
  }
}

// Global variables
let currentScheduleId = null;
let currentPackageId = null;
let weeklyDatePicker = null;

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
  weeklyDatePicker = new WeeklyDatePicker();
});

function openBookingModal(packageName, price, date, scheduleId, packageId) {
  currentScheduleId = scheduleId;
  currentPackageId = packageId;
  
  // Update modal content
  const modalPackageName = document.getElementById('modalPackageName');
  const modalPrice = document.getElementById('modalPrice');
  
  if (modalPackageName) {
    modalPackageName.textContent = packageName.toUpperCase();
  }
  
  if (modalPrice) {
    modalPrice.textContent = 'Rp. ' + new Intl.NumberFormat('id-ID').format(price) + '/Person';
  }
  
  // Set initial date untuk date picker
  if (weeklyDatePicker && date) {
    const [day, month, year] = date.split(' - ');
    const initialDate = new Date(year, month - 1, day);
    weeklyDatePicker.setInitialDate(initialDate);
  }
  
  // Update modal content based on package
  updateModalContent(packageName);
  
  // Show modal
  const modal = new bootstrap.Modal(document.getElementById('bookingModal'));
  modal.show();
}

function updateModalContent(packageName) {
  const modalImage = document.getElementById('modalTourImage');
  const modalIncludeList = document.getElementById('modalIncludeList');
  
  if (!modalImage || !modalIncludeList) return;
  
  if (packageName.toLowerCase().includes('snorkeling')) {
    modalImage.textContent = 'Snorkeling Image';
    modalImage.style.backgroundColor = '#4fc3f7';
    modalIncludeList.innerHTML = `
      <li>Tiket snorkeling dan akses area wisata</li>
      <li>Peralatan snorkeling lengkap</li>
      <li>Pemandu wisata lokal (guide berpengalaman)</li>
      <li>Dokumentasi foto underwater</li>
      <li>Transportasi</li>
    `;
  } else if (packageName.toLowerCase().includes('pantai')) {
    modalImage.textContent = 'Beach Image';
    modalImage.style.backgroundColor = '#81c784';
    modalIncludeList.innerHTML = `
      <li>Tiket masuk pantai</li>
      <li>Pemandu wisata profesional</li>
      <li>Transportasi antar jemput</li>
      <li>Dokumentasi foto</li>
      <li>Makanan ringan</li>
    `;
  } else if (packageName.toLowerCase().includes('mangrove')) {
    modalImage.textContent = 'Mangrove Image';
    modalImage.style.backgroundColor = '#66bb6a';
    modalIncludeList.innerHTML = `
      <li>Tiket masuk area mangrove</li>
      <li>Perahu tradisional</li>
      <li>Pemandu wisata lokal</li>
      <li>Dokumentasi foto</li>
      <li>Air mineral</li>
    `;
  } else {
    modalImage.textContent = 'Tour Image';
    modalImage.style.backgroundColor = '#e3f2fd';
    modalIncludeList.innerHTML = `
      <li>Tiket masuk tempat wisata</li>
      <li>Pemandu wisata profesional</li>
      <li>Transportasi antar jemput</li>
      <li>Dokumentasi foto</li>
      <li>Makan siang</li>
    `;
  }
}

function addToCart() {
  if (weeklyDatePicker) {
    const selectedDate = weeklyDatePicker.formatDate(weeklyDatePicker.getSelectedDate());
    alert(`Item berhasil ditambahkan ke cart!\nTanggal: ${selectedDate}`);
  } else {
    alert('Item berhasil ditambahkan ke cart!');
  }
}

function bookNow() {
  if (weeklyDatePicker) {
    const selectedDate = weeklyDatePicker.formatDate(weeklyDatePicker.getSelectedDate());
    if (currentScheduleId && currentPackageId) {
      alert(`Booking berhasil!\nSchedule ID: ${currentScheduleId}\nPackage ID: ${currentPackageId}\nTanggal: ${selectedDate}`);
      // Redirect ke halaman booking dengan parameter
      // window.location.href = `booking.php?schedule_id=${currentScheduleId}&package_id=${currentPackageId}&date=${encodeURIComponent(selectedDate)}`;
    } else {
      alert('Terjadi kesalahan. Silakan coba lagi.');
    }
  } else {
    if (currentScheduleId && currentPackageId) {
      alert(`Booking berhasil!\nSchedule ID: ${currentScheduleId}\nPackage ID: ${currentPackageId}`);
    } else {
      alert('Terjadi kesalahan. Silakan coba lagi.');
    }
  }
}