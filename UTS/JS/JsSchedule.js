  document.getElementById('statusFilter').addEventListener('change', function () {
    const selected = this.value;
    const rows = document.querySelectorAll('.schedule-table tbody tr');

    rows.forEach(row => {
      const statusCell = row.querySelector('.status');
      const statusClass = statusCell.classList.contains('tersedia') ? 'tersedia' :
                          statusCell.classList.contains('penuh') ? 'penuh' :
                          statusCell.classList.contains('request') ? 'request' : '';

      if (selected === 'all' || statusClass === selected) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  });

