<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_id = $_POST['booking_id'] ?? null;
    $schedule_id = $_POST['schedule_id'] ?? null;

    if (!$booking_id || !$schedule_id || !is_numeric($booking_id) || !is_numeric($schedule_id)) {
        http_response_code(400);
        echo json_encode(['error' => 'Data tidak valid.']);
        exit;
    }

    $stmt = mysqli_prepare($conn, "UPDATE bookings SET schedule_id = ? WHERE booking_id = ?");
    mysqli_stmt_bind_param($stmt, "ii", $schedule_id, $booking_id);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => true, 'message' => 'Jadwal booking berhasil diperbarui.']);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Gagal memperbarui booking: ' . mysqli_error($conn)]);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Metode tidak diizinkan']);
}
?>
