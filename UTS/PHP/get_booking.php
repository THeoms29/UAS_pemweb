<?php
include 'koneksi.php';

$status = $_GET['status'] ?? 'all';

// Mapping status ke bentuk database
if ($status === 'confirmed') {
    $status = 'disetujui';
} elseif ($status === 'pending') {
    $status = 'menunggu';
}

if ($status === 'all') {
    $query = "
        SELECT 
            b.booking_id,
            b.user_id,
            b.schedule_id,
            b.status,
            b.booking_date,
            b.package_id,
            p.name AS package_name,
            p.price AS total_price
        FROM 
            bookings b
        LEFT JOIN 
            packages p ON b.package_id = p.package_id
    ";

    $stmt = mysqli_prepare($conn, $query);
} else {
    $query = "
        SELECT 
            b.booking_id,
            b.user_id,
            b.schedule_id,
            b.status,
            b.booking_date,
            b.package_id,
            p.name AS package_name,
            p.price AS total_price
        FROM 
            bookings b
        LEFT JOIN 
            packages p ON b.package_id = p.package_id
        WHERE 
            b.status = ?
    ";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $status);
}

if (!$stmt) {
    echo json_encode(['error' => 'Prepare failed: ' . mysqli_error($conn)]);
    exit;
}

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    echo json_encode(['error' => 'Query failed: ' . mysqli_error($conn)]);
    exit;
}

$bookings = [];
while ($row = mysqli_fetch_assoc($result)) {
    $bookings[] = $row;
}

header('Content-Type: application/json');
echo json_encode($bookings);
?>
