<?php
include('connect.php');
session_start();

if(isset($_POST['sign_in'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $select_user = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($db, $select_user);
    $check_user = mysqli_num_rows($result);

    if($check_user == 1) {
        $_SESSION['email'] = $email;
        $update_msg = mysqli_query($db, "UPDATE users SET log_in='Online' WHERE email='$email'");

        $user = $_SESSION['email'];
        $get_user = "SELECT * FROM users WHERE email='$user'";
        $run_user = mysqli_query($db, $get_user);
        $row = mysqli_fetch_array($run_user);

        $user_name = $row['name'];

        echo "<script>window.open('home.php?user_name=$user_name', '_self')</script>";
    } else {
        echo "<script>alert('Username or password incorrect!')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .singin-form {
            width: 100%;
            max-width: 400px;
            margin: 40px auto;
        }
    </style>
</head>
<body>
    <div class="singin-form">
        <form action="" method="post">
            <div class="form-header">
                <h1 class="text-center">Login</h1>
                <!-- <h3 class="text-center">Sing in to My Chat</h3> -->
            </div>
            <div class="form-control mt-3">
                <label for="">Email</label>
                <input type="text" class="form-control" name="email" placeholder="example@gmail.com">
            </div>
            <div class="form-control mt-3">
                <label for="">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <div class="form-control mt-3">
                <button type="submit" name="sign_in" class="w-100 btn btn-primary">Login</button>
            </div>
            <div class="small mt-3 text-center">Forgot password? <a href="forgot_pass.php">Click here</a></div>
        </form>
        <div class="text-center small mt-3">Don't have an account? <a href="register.php">Register</a></div>
    </div>
</body>
</html>