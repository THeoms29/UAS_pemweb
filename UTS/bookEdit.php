<?php
session_start();
include 'db_connect.php';

$user_id = $_SESSION['user_id'] ?? 0;
$booking_id = $_GET['id'] ?? 0;

$stmt = $conn->prepare("SELECT * FROM bookings WHERE id = ? AND user_id = ? AND status = 'Pending'");
$stmt->bind_param("ii", $booking_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Data tidak ditemukan atau tidak bisa diubah.";
    exit;
}

$data = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_date = $_POST['departure_date'];
    $participants = (int) $_POST['participants'];
    $price_per_person = 1500000; // misalnya tetap

    $total_price = $price_per_person * $participants;

    $update = $conn->prepare("UPDATE bookings SET departure_date = ?, participants = ?, total_price = ? WHERE id = ?");
    $update->bind_param("siii", $new_date, $participants, $total_price, $booking_id);
    $update->execute();

    header("Location: my-booking.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Booking</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container my-5">
    <h2 class="mb-4">Edit Booking</h2>
    <form method="POST">
      <div class="mb-3">
        <label>Jadwal Keberangkatan</label>
        <input type="date" name="departure_date" class="form-control" value="<?= $data['departure_date'] ?>" required>
      </div>
      <div class="mb-3">
        <label>Jumlah Peserta</label>
        <input type="number" name="participants" class="form-control" value="<?= $data['participants'] ?>" required min="1">
      </div>
      <button type="submit" class="btn btn-success">Simpan</button>
      <a href="my-booking.php" class="btn btn-secondary">Batal</a>
    </form>
  </div>
</body>
</html>
