<?php
session_start();
include 'db_connect.php';

$user_id = $_SESSION['user_id'] ?? 0;
$booking_id = $_GET['id'] ?? 0;

// Cek data booking-nya milik user yang login
$stmt = $conn->prepare("SELECT * FROM bookings WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $booking_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Booking tidak ditemukan.";
    exit;
}

$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Detail Booking</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container my-5">
    <h2 class="mb-4">Detail Booking</h2>
    <table class="table table-bordered">
      <tr><th>Nama Paket</th><td><?= htmlspecialchars($data['package_name']) ?></td></tr>
      <tr><th>Jadwal Keberangkatan</th><td><?= date("d M Y", strtotime($data['departure_date'])) ?></td></tr>
      <tr><th>Jumlah Peserta</th><td><?= $data['participants'] ?> Orang</td></tr>
      <tr><th>Status</th><td><?= $data['status'] ?></td></tr>
      <tr><th>Total Harga</th><td>Rp <?= number_format($data['total_price'], 0, ',', '.') ?></td></tr>
      <tr><th>Tanggal Pesan</th><td><?= date("d M Y, H:i", strtotime($data['created_at'])) ?></td></tr>
    </table>
    <a href="my-booking.php" class="btn btn-secondary">Kembali</a>
  </div>
</body>
</html>
