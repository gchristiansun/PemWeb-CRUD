<?php
session_start();
require '../app/function.php';

// cek cookie
if (isset($_COOKIE["key1"]) && isset($_COOKIE['key2'])) {
   $key1 = $_COOKIE['key1'];
   $key2 = $_COOKIE['key2'];

    // Ambil name berdasarkan id
    $result = mysqli_query($conn, "SELECT name FROM users WHERE id = $key1");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan name
    if ($key2 === hash('sha256', $row['name'])) {
        $_SESSION['login'] = true;
        $_SESSION["username"] = $row["name"];
    }
}

if(isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

if(isset($_POST["register"])) {
    if(registrasi($_POST) > 0) {
        echo "<script>
                alert('Sign Up Berhasil! ')
             </script>";
    } else {
        echo mysqli_error($conn);
    }
}

// Login
if(isset($_POST["login"])) {
    $email = $_POST["emaillog"];
    $password = $_POST["passwordlog"];

    $email = mysqli_real_escape_string($conn, $email);

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");


    // Cek email
    if(mysqli_num_rows($result) === 1) {
        // Cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            // Set session
            $_SESSION["login"] = true;
            $_SESSION["username"] = $row["name"];

            // cek remember me
            if (isset($_POST['remember'])) {
                // buat cookie

                setcookie('key1', $row['id'], time()+120);
                setcookie('key2', hash('sha256', $row['name']), time()+120);
            }

            header("Location: index.php");
            exit;
        }
    } 

    $error = true;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../style/login.css">
    <script src="../script/login.js" defer></script>
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="" method="post">
                <h1>Create Account</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>or use your email for registration</span>
                <input type="text" placeholder="Name" name="name" id="name"/>
                <input type="email" placeholder="Email" name="email" id="email"/>
                <input type="password" placeholder="Password" name="password" id="password"/>
                <input type="password" placeholder="Konfirmasi Password" name="konfirmasipassword" id="konfirmasipassword"/>
                <button type="submit" name="register">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="" method="post">
                <h1>Sign in</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>or use your account</span>
                <input type="email" placeholder="Email" name="emaillog" id="emaillog"/>
                <input type="password" placeholder="Password" name="passwordlog" id="passwirdlog"/>
                <?php if(isset($error)) : ?>
                    <p style="color:red; font-size: 12px">email atau password salah</p>
                <?php endif; ?>
                <div class="remember-me">
                    <input type="checkbox" name="remember" id="remember">
                    <span>Remember Me</span>
                </div>
                <a href="#">Forgot your password?</a>
                <button type="submit" name="login">Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>