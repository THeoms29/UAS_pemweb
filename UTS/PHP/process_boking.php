<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

require_once('koneksi.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'] ?? null;
    $schedule_id = $_POST['schedule_id'] ?? null;
    $package_id = $_POST['package_id'] ?? null;
    $action = $_POST['action'] ?? 'bookNow';

    // ✅ Status sesuai aksi
    $status = $action === 'cart' ? 'pending' : 'confirmed';

    if ($user_id && $schedule_id && $package_id) {
        try {
            $stmt = $pdo->prepare("INSERT INTO bookings (user_id, schedule_id, package_id, status) VALUES (?, ?, ?, ?)");
            $stmt->execute([$user_id, $schedule_id, $package_id, $status]);

            echo json_encode(['success' => true]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Metode tidak valid']);
}
