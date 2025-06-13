<?php
require_once '../app/core/Flasher.php'; // Jika belum pakai composer/namespace

Flasher::loginFlash(); // Tampilkan pesan jika ada
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dashboard HC</title>
    <link rel="shortcut icon" href="<?= BASE_URL; ?>/img/JNE.png">

    <!-- Bootstrap CSS (gunakan versi stabil saja satu kali) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>


<body class="bg-info">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4 shadow-lg" style="width: 350px;">
            <div class="text-center">
                <img src="<?= BASE_URL; ?>/img/JNE.png"
                    alt="Twitter Logo" width="90">
                <h4 class="mt-3" style="border-bottom: 1px solid black;">DASHBOARD HC</h4>
                <?php Flasher::loginFlash(); ?>
            </div>
            <form class="mt-3" action="<?= BASE_URL; ?>/auth/login" method="post">
                <div class="mb-3">
                    <label for="userName" class="form-label"><b>Username</b></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input class="form-control" type="text" name="username" placeholder="Username" autofocus>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="pwd" class="form-label"><b>Password</b></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input class="form-control" type="password" id="pwd" name="password" placeholder="Password">
                        <span class="input-group-text" onclick="togglePassword()" style="cursor: pointer;">
                            <i class="bi bi-eye" id="toggleIcon"></i>
                        </span>
                    </div>
                </div>
                <button type="submit" class="btn btn-success w-100">Login</button>
            </form>
            <div class="text-center mt-3">
                <a href="#" class="text-success"></a><a href="https://jne.co.id/" target="_blank">https://jne.co.id</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword() {
            const pwdInput = document.getElementById("pwd");
            const icon = document.getElementById("toggleIcon");
            if (pwdInput.type === "password") {
                pwdInput.type = "text";
                icon.classList.remove("bi-eye");
                icon.classList.add("bi-eye-slash");
            } else {
                pwdInput.type = "password";
                icon.classList.remove("bi-eye-slash");
                icon.classList.add("bi-eye");
            }
        }
    </script>
</body>

</html>