<?php
include('connect.php');
session_start();

if(isset($_POST['submit'])) {
    $email = $_POST['email'];
    $recovery_account = $_POST['bf'];

    $select = "SELECT * FROM users WHERE email='$email' AND forgotten_answer='$recovery_account'";
    $query = mysqli_query($db, $select);
    $check_user = mysqli_num_rows($query);

    if($check_user == 1) {
        $_SESSION['email'] = $email;
        // $update_msg = mysqli_query($db, "UPDATE users SET log_in='Online' WHERE email='$email'");

        // $user = $_SESSION['email'];
        // $get_user = "SELECT * FROM users WHERE email='$user'";
        // $run_user = mysqli_query($db, $get_user);
        // $row = mysqli_fetch_array($run_user);

        // $user_name = $row['name'];

        echo "<script>window.open('create_password.php', '_self')</script>";
    } else {
        echo "<script>alert('Your email or bestfriend name is incorrect!')</script>";
        echo "<script>window.open('forgot_pass.php', '_self')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>

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
                <h1 class="text-center">Forgot Password</h1>
                <!-- <h3 class="text-center">Sing in to My Chat</h3> -->
            </div>
            <div class="form-control mt-3">
                <label for="">Email</label>
                <input type="text" class="form-control" name="email" placeholder="example@gmail.com">
            </div>
            <div class="form-control mt-3">
                <label for="">Bestfriend Name</label>
                <input type="text" class="form-control" name="bf" placeholder="Someone...">
            </div>
            <div class="form-control mt-3">
                <button type="submit" name="submit" class="w-100 btn btn-primary">Submit</button>
            </div>
        </form>
        <div class="text-center small mt-3">Back to signin? <a href="login.php">Click here</a></div>
    </div>
</body>
</html>