<?php
// Debug version - tambahkan logging untuk troubleshooting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Log file untuk debugging
$log_file = 'debug_signup.log';

function write_log($message) {
    global $log_file;
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents($log_file, "[$timestamp] $message\n", FILE_APPEND);
}

write_log("=== Debug signup process started ===");

// Sertakan file koneksi database
require_once 'koneksi.php';

write_log("Database connection included");

// Fungsi untuk membersihkan input
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Response function
function send_response($success, $message, $redirect = null) {
    write_log("Sending response: " . ($success ? "SUCCESS" : "ERROR") . " - $message");
    
    $response = [
        'success' => $success,
        'message' => $message
    ];
    if ($redirect) {
        $response['redirect'] = $redirect;
    }
    
    // Jika request adalah AJAX
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
    
    // Jika bukan AJAX, set session dan redirect
    session_start();
    if ($success) {
        $_SESSION['success_message'] = $message;
        if ($redirect) {
            header("Location: $redirect");
        } else {
            header("Location: signup.html");
        }
    } else {
        $_SESSION['error_message'] = $message;
        header("Location: signup.html");
    }
    exit;
}

write_log("Method: " . $_SERVER["REQUEST_METHOD"]);
write_log("POST data: " . print_r($_POST, true));

// Cek apakah form disubmit dengan method POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    write_log("Processing POST request");
    
    // Debug: Cek apakah data POST ada
    if (empty($_POST)) {
        write_log("ERROR: No POST data received");
        send_response(false, "No data received");
    }
    
    // Ambil data dari form
    $full_name = isset($_POST['full_name']) ? clean_input($_POST['full_name']) : '';
    $email = isset($_POST['email']) ? clean_input($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
    
    write_log("Data received - Name: $full_name, Email: $email");
    
    // Array untuk menyimpan error
    $errors = [];
    
    // Validasi input
    if (empty($full_name)) {
        $errors[] = "Nama lengkap harus diisi";
        write_log("Validation error: Empty full name");
    }
    
    if (empty($email)) {
        $errors[] = "Email harus diisi";
        write_log("Validation error: Empty email");
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid";
        write_log("Validation error: Invalid email format");
    }
    
    if (empty($password)) {
        $errors[] = "Password harus diisi";
        write_log("Validation error: Empty password");
    } elseif (strlen($password) < 6) {
        $errors[] = "Password minimal 6 karakter";
        write_log("Validation error: Password too short");
    }
    
    if (empty($confirm_password)) {
        $errors[] = "Konfirmasi password harus diisi";
        write_log("Validation error: Empty confirm password");
    } elseif ($password !== $confirm_password) {
        $errors[] = "Password dan konfirmasi password tidak sama";
        write_log("Validation error: Password mismatch");
    }
    
    // Jika ada error, kirim response error
    if (!empty($errors)) {
        write_log("Validation failed with errors: " . implode(", ", $errors));
        send_response(false, implode(", ", $errors));
    }
    
    write_log("Validation passed, checking database connection");
    
    // Test koneksi database
    if (!$conn) {
        write_log("ERROR: Database connection failed");
        send_response(false, "Database connection failed");
    }
    
    write_log("Database connected successfully");
    
    // Cek apakah email sudah terdaftar
    $check_email_query = "SELECT user_id FROM user WHERE email = ?";
    $check_stmt = mysqli_prepare($conn, $check_email_query);
    
    if (!$check_stmt) {
        write_log("ERROR: Failed to prepare check email query: " . mysqli_error($conn));
        send_response(false, "Database error: " . mysqli_error($conn));
    }
    
    mysqli_stmt_bind_param($check_stmt, "s", $email);
    mysqli_stmt_execute($check_stmt);
    $result = mysqli_stmt_get_result($check_stmt);
    
    if (mysqli_num_rows($result) > 0) {
        write_log("Email already exists: $email");
        mysqli_stmt_close($check_stmt);
        send_response(false, "Email sudah terdaftar. Silakan gunakan email lain.");
    }
    mysqli_stmt_close($check_stmt);
    
    write_log("Email check passed, proceeding with insert");
    
    // Hash password untuk keamanan
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    write_log("Password hashed successfully");
    
    // Waktu saat ini untuk created_at dan updated_at
    $current_time = date('Y-m-d H:i:s');
    write_log("Current time: $current_time");
    
    // Insert data ke database
    $insert_query = "INSERT INTO users (name, email, password, created_at, updated_at) VALUES (?, ?, ?, ?, ?)";
    $insert_stmt = mysqli_prepare($conn, $insert_query);
    
    if (!$insert_stmt) {
        write_log("ERROR: Failed to prepare insert query: " . mysqli_error($conn));
        send_response(false, "Database prepare error: " . mysqli_error($conn));
    }
    
    write_log("Insert query prepared successfully");
    
    mysqli_stmt_bind_param($insert_stmt, "sssss", $full_name, $email, $hashed_password, $current_time, $current_time);
    
    write_log("Parameters bound, executing insert");
    
    if (mysqli_stmt_execute($insert_stmt)) {
        write_log("Insert executed successfully");
        $user_id = mysqli_insert_id($conn);
        write_log("New user ID: $user_id");
        mysqli_stmt_close($insert_stmt);
        send_response(true, "Akun berhasil dibuat! Silakan login.", "Login.html");
    } else {
        write_log("ERROR: Insert execution failed: " . mysqli_stmt_error($insert_stmt));
        mysqli_stmt_close($insert_stmt);
        send_response(false, "Terjadi kesalahan saat menyimpan data: " . mysqli_stmt_error($insert_stmt));
    }
    
} else {
    write_log("ERROR: Non-POST request received");
    send_response(false, "Method tidak diizinkan");
}

// Tutup koneksi database
mysqli_close($conn);
write_log("=== Debug signup process ended ===");
?>