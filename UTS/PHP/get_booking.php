<?php
include 'koneksi.php';

$status = $_GET['status'] ?? 'all';

// Mapping status untuk konsistensi (jika diperlukan)
if ($status === 'confirmed') {
    $status = 'disetujui';
} elseif ($status === 'pending') {
    $status = 'menunggu';
}

$query = "
    SELECT 
        b.booking_id,
        b.user_id,
        b.schedule_id,
        s.departure_date,
        b.status,
        b.booking_date,
        b.package_id,
        p.name AS package_name,
        p.price AS package_price,
    FROM 
        bookings b
    LEFT JOIN 
        packages p ON b.package_id = p.package_id
    LEFT JOIN 
        schedules s ON b.schedule_id = s.schedule_id
";

if ($status !== 'all') {
    $query .= " WHERE b.status = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $status);
} else {
    $stmt = mysqli_prepare($conn, $query);
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
    $row['total_price'] = (float) $row['total_price'];
    $bookings[] = $row;
}

header('Content-Type: application/json');
echo json_encode($bookings);
?>
