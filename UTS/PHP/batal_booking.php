<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_id = $_POST['booking_id'] ?? null;

    if (!$booking_id || !is_numeric($booking_id)) {
        http_response_code(400);
        echo json_encode(['error' => 'ID booking tidak valid.']);
        exit;
    }

    $stmt = mysqli_prepare($conn, "DELETE FROM bookings WHERE booking_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $booking_id);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => true, 'message' => 'Booking berhasil dibatalkan.']);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Gagal membatalkan booking: ' . mysqli_error($conn)]);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Metode tidak diizinkan']);
}
?>
