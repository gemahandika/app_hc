<?php
session_name("hc_session");
session_start();

// Jika sudah login, redirect ke halaman index
if (isset($_SESSION['admin_username'])) {
    header("location:../index.php");
    exit();
}

include '../../../app/config/koneksi.php';

$username = "";
$password = "";
$err = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validasi input kosong
    if (empty($username) || empty($password)) {
        $err = "Silahkan Masukan Username dan Password";
    } else {
        // Query untuk mendapatkan user berdasarkan username
        $sql1 = "SELECT * FROM user WHERE username = ?";
        $stmt1 = mysqli_prepare($koneksi, $sql1);

        if ($stmt1) {
            mysqli_stmt_bind_param($stmt1, "s", $username);
            mysqli_stmt_execute($stmt1);

            $result1 = mysqli_stmt_get_result($stmt1);

            // Validasi akun ditemukan dan password sesuai
            if ($result1->num_rows === 0) {
                $err = "Akun Tidak ditemukan";
            } else {
                $row = $result1->fetch_assoc();

                // Periksa password menggunakan md5
                if ($row['password'] !== md5($password)) {
                    $err = "Password Salah";
                } else {
                    // Query untuk mendapatkan akses user
                    $login_id = $row['login_id'];
                    $sql2 = "SELECT akses_id FROM admin_akses WHERE login_id = ?";
                    $stmt2 = mysqli_prepare($koneksi, $sql2);

                    if ($stmt2) {
                        mysqli_stmt_bind_param($stmt2, "s", $login_id);
                        mysqli_stmt_execute($stmt2);

                        $result2 = mysqli_stmt_get_result($stmt2);

                        $akses = [];
                        while ($row2 = $result2->fetch_assoc()) {
                            $akses[] = $row2['akses_id'];
                        }

                        // Validasi akses tidak kosong
                        if (empty($akses)) {
                            $err = "Kamu Tidak Punya Akses";
                        } else {
                            // Set session dan redirect
                            $_SESSION['admin_username'] = $username;
                            $_SESSION['admin_akses'] = $akses;
                            header("location:../index.php");
                            exit();
                        }
                    } else {
                        $err = "Kesalahan pada prepared statement 2";
                    }
                }
            }
        } else {
            $err = "Kesalahan pada prepared statement 1";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dashboard HC</title>
    <link rel="shortcut icon" href="../../../app/assets/img/JNE.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body class="bg-info">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4 shadow-lg" style="width: 350px;">
            <div class="text-center">
                <img src="../../../app/assets/img/JNE.png"
                    alt="Twitter Logo" width="90">
                <h4 class="mt-3" style="border-bottom: 1px solid black;">DASHBOARD HC</h4>
                <?php
                if ($err) {
                    echo "<h6 style='color: red;'>$err</h6>";
                }
                ?>
            </div>

            <form class="mt-3" action="" method="post">
                <div class="mb-3">
                    <label for="userName" class="form-label"><b>Username</b></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input class="form-control" value="<?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8') ?>" type="text" name="username" placeholder="Username" autofocus>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="pwd" class="form-label"><b>Password</b></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input class="form-control" type="password" id="pwd" name="password" placeholder="Password">
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>

                </div>

                <button type="submit" name="login" class="btn btn-success w-100">Login</button>
            </form>

            <div class="text-center mt-3">
                <a href="#" class="text-success"></a><a href="https://jne.co.id/" target="_blank">https://jne.co.id</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById("togglePassword").addEventListener("click", function() {
            var passwordField = document.getElementById("pwd");
            var icon = this.querySelector("i");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove("bi-eye");
                icon.classList.add("bi-eye-slash");
            } else {
                passwordField.type = "password";
                icon.classList.remove("bi-eye-slash");
                icon.classList.add("bi-eye");
            }
        });
    </script>
</body>

</html>