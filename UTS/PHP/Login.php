<?php
  if (!defined('BASE_URL')) {
    define('BASE_URL', '../'); 
  }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="form.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>
    <div class="login-wrapper">
        <div class="login-container">
           <!-- <h1 class="title">BAWEANIQUE</h1> -->
           <div class="logo-container">
            <img src="baweanique2.png" width="250" height="120" alt="">
          </div>
            <div class="login-form">
                <form id="login-form">
                    <div class="form-group">
                        <div class="icon-container">
                            <span class="icon"></span>
                            <input type="text" class="form-control" id="Username" placeholder="Username" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="icon-container">
                            <span class="icon"></span>
                            <input type="password" class="form-control" id="Password" placeholder="Password" value="">
                        </div>
                    </div>
                    <div class="remember-me">
                        <label>
                          <input type="checkbox" required>
                          Remember Me?</a>
                        </label>
                      </div>
                    <button type="button" class="btn-login" id="login-btn">LOGIN</button>
                    <div class="signup-link">
                        Belum punya akun? <a href="Sign.php">Sign Up</a>
                      </div>
                </form>
            </div>
        </div>
    </div>
    <div class="footer">
        Copyright © | Design by Nabilafarahh - Theodore
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="../Jsform.js"></script>
</body>
</html>