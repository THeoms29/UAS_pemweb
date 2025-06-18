<?php
session_start();
require_once('koneksi.php'); // Pastikan path ke koneksi.php benar

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookingId = $_POST['booking_id'] ?? null;

    if ($bookingId) {
        try {
            // Periksa apakah booking ini milik user yang sedang login
            $checkSql = "SELECT user_id FROM bookings WHERE booking_id = ?";
            $checkStmt = $pdo->prepare($checkSql);
            $checkStmt->execute([$bookingId]);
            $booking = $checkStmt->fetch();

            if (!$booking || $booking['user_id'] !== $_SESSION['user_id']) {
                echo json_encode(['success' => false, 'message' => 'Unauthorized or booking not found.']);
                exit;
            }

            // Update status booking menjadi 'confirmed'
            $updateSql = "UPDATE bookings SET status = 'confirmed' WHERE booking_id = ?";
            $updateStmt = $pdo->prepare($updateSql);
            $updateStmt->execute([$bookingId]);

            if ($updateStmt->rowCount() > 0) {
                echo json_encode(['success' => true, 'message' => 'Status booking berhasil diupdate menjadi confirmed.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Gagal mengupdate status booking atau status sudah confirmed.']);
            }
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            echo json_encode(['success' => false, 'message' => 'Terjadi kesalahan database: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Booking ID tidak ditemukan.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Metode request tidak valid.']);
}
?>