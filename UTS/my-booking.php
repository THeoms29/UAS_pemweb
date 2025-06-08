<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My Booking</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container my-5">
    <h2 class="mb-4 text-center">My Booking</h2>
    
    <div class="table-responsive">
      <table class="table table-bordered table-striped align-middle text-center">
        <thead class="table-primary">
          <tr>
            <th>No</th>
            <th>Nama Paket</th>
            <th>Tanggal Keberangkatan</th>
            <th>Peserta</th>
            <th>Status</th>
            <th>Total Biaya</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Bali 3D2N</td>
            <td>15 Juli 2025</td>
            <td>2 Orang</td>
            <td><span class="badge bg-warning">Pending</span></td>
            <td>Rp 3.000.000</td>
            <td>
              <a href="#" class="btn btn-sm btn-info"><i class="bi bi-eye"></i> Detail</a>
              <a href="#" class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i> Edit</a>
              <a href="#" class="btn btn-sm btn-danger"><i class="bi bi-x-circle"></i> Batal</a>
            </td>
          </tr>
          <tr>
            <td>2</td>
            <td>Jogja Heritage Tour</td>
            <td>20 Agustus 2025</td>
            <td>4 Orang</td>
            <td><span class="badge bg-success">Confirmed</span></td>
            <td>Rp 5.000.000</td>
            <td>
              <a href="#" class="btn btn-sm btn-info"><i class="bi bi-eye"></i> Detail</a>
              <a href="#" class="btn btn-sm btn-secondary disabled"><i class="bi bi-pencil"></i> Edit</a>
              <a href="#" class="btn btn-sm btn-secondary disabled"><i class="bi bi-x-circle"></i> Batal</a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
