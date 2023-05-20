<?php
 include('connect.php');

 if(isset($_POST['sign_up'])) {
    $name = $_POST['username']; 
    $email = $_POST['email'];
    $password = $_POST['password'];
    $country = $_POST['user_country'];
    $gender = $_POST['user_gender'];
    $rand = rand(1, 2);

    if(empty($name)) {
        echo "<script>alert('User name is required!')</script>";
        echo "<script>window.open('register.php', '_self')</script>";
    }
    if(strlen($password) < 8) {
        echo "<script>alert('Password should be minimum 8 characters!')</script>";
        echo "<script>window.open('register.php', '_self')</script>";
        exit();
    }

    $select_email = "SELECT * from users WHERE email='$email'";
    $run_email = mysqli_query($db, $select_email);
    $check_email = mysqli_num_rows($run_email);
    if($check_email == 1) {
        echo "<script>alert('Email already exist, please try again!')</script>";
        echo "<script>window.open('register.php', '_self')</script>";
        exit();
    }
    if($rand == 1)
        $profile_pic = "images/image.jpg";
    else if($rand == 2)
        $profile_pic = "images/image1.jpg";

    $insert_query = "INSERT INTO `users` (name,email,password,profile,country,gender) VALUES('$name', '$email', '$password', '$profile_pic', '$country', '$gender')";

    $result = mysqli_query($db, $insert_query);

    if($result) {
        echo "<script>alert('Your account has been created successfully.')</script>";
        echo "<script>window.open('login.php', '_self')</script>";
    } else {
        echo "<script>alert('Registratin failed, try again!')</script>";
        echo "<script>window.open('register.php', '_self')</script>";
    }
 }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .singup-form {
            width: 100%;
            max-width: 400px;
            margin: 40px auto;
        }
    </style>
</head>
<body>
    <div class="singup-form">
        <form action="" method="post">
            <div class="form-header">
                <h1 class="text-center">Register</h1>
                <!-- <h3 class="text-center">Sing in to My Chat</h3> -->
            </div>
            <div class="form-control mt-3">
                <label for="">Username</label>
                <input type="text" class="form-control" name="username" placeholder="Enter your name" required>
            </div>
            <div class="form-control mt-3">
                <label for="">Email</label>
                <input type="text" class="form-control" name="email" placeholder="example@gmail.com" required>
            </div>
            <div class="form-control mt-3">
                <label for="">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <div class="form-control mt-3">
                <label for="">Country</label>
                <select name="user_country" class="form-control" required>
                    <option disabled="">Select a country</option>
                    <option value="">USA</option>
                    <option value="">UK</option>
                    <option value="">France</option>
                    <option value="">Germany</option>
                </select>
            </div>
            <div class="form-control mt-3">
                <label for="">Gender</label>
                <select name="user_gender" class="form-control" required>
                    <option disabled="">Select your gender</option>
                    <option value="">Male</option>
                    <option value="">Female</option>
                    <option value="">Others</option>
                </select>
            </div>
            <div class="form-group mt-3">
                <label for="" class="checkbox-inline">
                    <input type="checkbox" required>
                I accept the <a href="#">Terms of Use</a>
                &amp; <a href="#">Privacy Policy</a>
                </label>
            </div>
            <div class="form-control mt-3">
                <button type="submit" name="sign_up" class="w-100 btn btn-primary">Register</button>
            </div>
            <div class="text-center small mt-3" style="color: #674288;">Already have an account, <a href="login.php">Login</a></div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>
</html>