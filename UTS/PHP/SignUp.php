<?php

  if (!defined('BASE_URL')) {
    define('BASE_URL', '../'); 
}
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

// Initialize variables
$success_message = '';
$error_message = '';
$form_data = [
    'full_name' => '',
    'email' => ''
];

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    
    write_log("Method: " . $_SERVER["REQUEST_METHOD"]);
    write_log("POST data: " . print_r($_POST, true));
    
    // Debug: Cek apakah data POST ada
    if (empty($_POST)) {
        write_log("ERROR: No POST data received");
        $error_message = "No data received";
    } else {
        // Ambil data dari form
        $full_name = isset($_POST['full_name']) ? clean_input($_POST['full_name']) : '';
        $email = isset($_POST['email']) ? clean_input($_POST['email']) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
        
        // Simpan data form untuk ditampilkan kembali jika ada error
        $form_data['full_name'] = $full_name;
        $form_data['email'] = $email;
        
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
        
        // Jika ada error, set error message
        if (!empty($errors)) {
            write_log("Validation failed with errors: " . implode(", ", $errors));
            $error_message = implode("<br>", $errors);
        } else {
            write_log("Validation passed, checking database connection");
            
            // Test koneksi database
            if (!$conn) {
                write_log("ERROR: Database connection failed");
                $error_message = "Database connection failed";
            } else {
                write_log("Database connected successfully");
                
                // Cek apakah email sudah terdaftar
                $check_email_query = "SELECT user_id FROM users WHERE email = ?";
                $check_stmt = mysqli_prepare($conn, $check_email_query);
                
                if (!$check_stmt) {
                    write_log("ERROR: Failed to prepare check email query: " . mysqli_error($conn));
                    $error_message = "Database error: " . mysqli_error($conn);
                } else {
                    mysqli_stmt_bind_param($check_stmt, "s", $email);
                    mysqli_stmt_execute($check_stmt);
                    $result = mysqli_stmt_get_result($check_stmt);
                    
                    if (mysqli_num_rows($result) > 0) {
                        write_log("Email already exists: $email");
                        mysqli_stmt_close($check_stmt);
                        $error_message = "Email sudah terdaftar. Silakan gunakan email lain.";
                    } else {
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
                            $error_message = "Database prepare error: " . mysqli_error($conn);
                        } else {
                            write_log("Insert query prepared successfully");
                            
                            mysqli_stmt_bind_param($insert_stmt, "sssss", $full_name, $email, $hashed_password, $current_time, $current_time);
                            
                            write_log("Parameters bound, executing insert");
                            
                            if (mysqli_stmt_execute($insert_stmt)) {
                                write_log("Insert executed successfully");
                                $user_id = mysqli_insert_id($conn);
                                write_log("New user ID: $user_id");
                                mysqli_stmt_close($insert_stmt);
                                $success_message = "Akun berhasil dibuat! Silakan login.";
                                
                                // Clear form data after successful registration
                                $form_data = ['full_name' => '', 'email' => ''];
                                
                                // Optional: Redirect to login page after a delay
                                echo "<script>
                                    setTimeout(function() {
                                        window.location.href = 'Login.html';
                                    }, 2000);
                                </script>";
                            } else {
                                write_log("ERROR: Insert execution failed: " . mysqli_stmt_error($insert_stmt));
                                mysqli_stmt_close($insert_stmt);
                                $error_message = "Terjadi kesalahan saat menyimpan data: " . mysqli_stmt_error($insert_stmt);
                            }
                        }
                    }
                }
                
                // Tutup koneksi database
                mysqli_close($conn);
            }
        }
    }
    
    write_log("=== Debug signup process ended ===");
}
?>

<script src="../JS/JsSign.js" defer></script>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../CSS/sign.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <div class="login-wrapper">
        <div class="login-container">
          <h2 class="title">Create Account</h2>

          <div id="alert-container"></div>
          
          <form class="login-form" id="signupForm">
            
            <div class="form-group icon-container">
              <i class="icon fas fa-user"></i>
              <input type="text" name="full_name" class="form-control" placeholder="Full Name" required>
            </div>
      
            <div class="form-group icon-container">
              <i class="icon fas fa-envelope"></i>
              <input type="email" name="email" class="form-control" placeholder="Email Address" required>
            </div>
      
            <div class="form-group icon-container">
              <i class="icon fas fa-lock"></i>
              <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
      
            <div class="form-group icon-container">
              <i class="icon fas fa-lock"></i>
              <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
            </div>
      
            <div class="remember-me">
              <label>
                <input type="checkbox" name="terms" required>
                Saya setuju dengan Syarat & Ketentuan
              </label>
            </div>
      
            <button type="submit" class="btn-login">Sign Up</button>
      
            <div class="signup-link">
              Sudah punya akun? <a href="Login.html">Sign In</a>
            </div>
          </form>
        </div>
      </div>
    
    
    <!-- Auto-redirect script untuk traditional form submission -->
    <?php if (!empty($success_message)): ?>
    <script>
        // Jika tidak ada AJAX (traditional form), redirect setelah 2 detik
        if (!window.XMLHttpRequest || !document.querySelector('#signupForm').dataset.ajax) {
            setTimeout(function() {
                window.location.href = 'Login.html';
            }, 2000);
        }
    </script>
    <?php endif; ?>
</body>
</html>