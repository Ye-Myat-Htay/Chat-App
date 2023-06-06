<?php

session_start();
include 'connect.php';

if(isset($_POST['change'])) {
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];

    $user = $_SESSION['email'];

    if($pass1 != $pass2) {
        echo "<div class='alert alert-danger'>
                <strong>Your new password didn't match with confirm password</strong>
                </div>";
    }
    if($pass1<9 AND $pass2<9) {
        echo "<div class='alert alert-danger'>
                <strong>Use 9 or more than 9 characters</strong>
                </div>";
    }
    if($pass1 == $pass2) {
        $update_pass = mysqli_query($db, "UPDATE users SET password='$pass1' WHERE email='$user'");
        session_destroy();

        echo "<script>alert('Go ahead and sign in')</script>";
        echo "<script>window.open('login.php', '_self')</script>";

    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Password</title>

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
                <h1 class="text-center">Create New Password</h1>
                <!-- <h3 class="text-center">Sing in to My Chat</h3> -->
            </div>
            <div class="form-control mt-3">
                <label for="">Enter Password</label>
                <input type="password" class="form-control" name="pass1" placeholder="Password">
            </div>
            <div class="form-control mt-3">
                <label for="">Confirm Password</label>
                <input type="password" class="form-control" name="pass2" placeholder="Confirm Password">
            </div>
            <div class="form-control mt-3">
                <button type="submit" name="change" class="w-100 btn btn-primary">Change</button>
            </div>
        </form>
    </div>
</body>
</html>