<?php
session_start();
include 'db_connect.php';

$user_id = $_SESSION['user_id'] ?? 0;
$booking_id = $_GET['id'] ?? 0;

$stmt = $conn->prepare("UPDATE bookings SET status = 'Cancelled' WHERE id = ? AND user_id = ? AND status = 'Pending'");
$stmt->bind_param("ii", $booking_id, $user_id);
$stmt->execute();

header("Location: my-booking.php");
exit;
