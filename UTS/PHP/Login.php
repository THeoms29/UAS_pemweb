<?php
  if (!defined('BASE_URL')) {
    define('BASE_URL', '../'); 
  }

  session_start();

// Periksa apakah ini adalah request POST (dari form login)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Sertakan file koneksi database
    require_once 'koneksi.php';

    // Fungsi untuk mengirim respons JSON dan menghentikan skrip
    function send_json_response($success, $message, $redirect_url = null) {
        header('Content-Type: application/json');
        $response = ['success' => $success, 'message' => $message];
        if ($redirect_url) {
            $response['redirect'] = $redirect_url;
        }
        echo json_encode($response);
        exit; // Penting: Hentikan eksekusi agar tidak ada output HTML
    }

    // Validasi koneksi database
    if (!$conn) {
        send_json_response(false, "Koneksi ke database gagal.");
    }

    // Ambil email dan password dari POST request
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Validasi input
    if (empty($email) || empty($password)) {
        send_json_response(false, "Email dan password harus diisi.");
    }

    // Cari pengguna berdasarkan email
    $sql = "SELECT user_id, name, password FROM users WHERE email = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $sql);
    
    if (!$stmt) {
        send_json_response(false, "Terjadi kesalahan pada server.");
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        
        // Verifikasi password yang diinput dengan hash di database
        if (password_verify($password, $user['password'])) {
            // Password cocok, login berhasil
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['logged_in'] = true;

            // Ganti 'dashboard.php' dengan halaman tujuan Anda setelah login
            send_json_response(true, "Login berhasil! Anda akan dialihkan...", 'Index.php');
        } else {
            send_json_response(false, "Email atau password salah.");
        }
    } else {
        send_json_response(false, "Email atau password salah.");
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
  }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="../CSS/form.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>
    <div class="login-wrapper">
        <div class="login-container">
           <div class="logo-container">
            <img src="../a1/baweanique2.png" width="250" height="120" alt="">
          </div>
          <div class="login-form">
                <div id="alert-container" class="mb-3"></div>

                <form id="login-form">
                    <div class="form-group">
                        <div class="icon-container">
                            <span class="icon"></span>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="icon-container">
                            <span class="icon"></span>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="remember-me">
                        <label>
                          <input type="checkbox" name="remember">
                          Remember Me
                        </label>
                      </div>
                    <button type="submit" class="btn-login" id="login-btn">LOGIN</button>
                    <div class="signup-link">
                        Belum punya akun? <a href="<?php echo BASE_URL; ?>PHP/SignUp.php">Sign Up</a>
                      </div>
                </form>
            </div>
        </div>
    </div>
    <div class="footer">
        Copyright © | Design by Nabilafarahh - Theodore
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="../JS/Jsform.js"></script>
</body>
</html>