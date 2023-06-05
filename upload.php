<?php
 session_start();
 include('connect.php');
 include('include/header.php');

 if(!isset($_SESSION['email'])) {
    header('location:login.php');
 } else {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Profile Picture</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">

    <style>
        .card {
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            max-width: 400px;
            margin: auto;
            text-align: center;
            font-family: arial;
        }
        .card img {
            height: 200px;
        }
        .title {
            color: grey;
            font-size: 18px;
        }
        button {
            border: none;
            outline: 0;
            display: inline-block;
            padding : 9px;
            color : white;
            background-color: #000;
            text-align: center;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
        }
        #update_profile {
            position: absolute;
            cursor: pointer;
            padding: 10px;
            border-radius: 4px;
            color: white;
            background-color: #000;
        }
        label {
            padding: 7px;
            display: table;
            color: #fff;
        }
        input[type="file"] {
            display: none;
        }
    </style>
</head>
<body>
    <?php
    $user = $_SESSION['email'];
    $get_user = "SELECT * FROM users WHERE email='$user'";
    $run_user = mysqli_query($db, $get_user);
    $row = mysqli_fetch_array($run_user);

    $user_name = $row['name'];
    $user_profile = $row['profile'];

    echo "
            <div class='card'>
                <img src='$user_profile'>
                <h1>$user_name</h1>
                <form method='post' enctype='multipart/form-data'>
                    <label id='update_profile'><i class='fa fa-circle-o' aria-hidden='true'></i>Select Profile<input type='file' name='u_image' size='60'></label>
                    <button id='button_profile name='update'>&nbsp&nbsp&nbsp<i class='fa fa-heart' aria-hidden='true'></i>Update Profile</button>
                <form>
                <div><br><br>
        ";

        if(isset($_POST['update'])) {
            $u_image = $_FILES['u_image']['name'];
            $img_tmp = $_FILES['u_image']['tmp_name'];
            $random_number = rand(1, 100);

            if(empty($u_image)) {
                echo "<script>alert('Please select profile')</script>";
                echo "<script>window.open('upload.php', '_self')</script>";
                exit();
            } else {
                move_uploaded_file($img_tmp, "images/$u_image.$random_number");

                $update = "UPDATE users SET profile='images/$u_image.$random_number' WHERE email='$user'";

                $run = mysqli_query($db, $update);

                if($run) {
                    echo "<script>alert('Profile updated')</script>";
                    echo "<script>window.open('upload.php', '_self')</script>";
                }
            }
        }
    ?>
</body>
</html>
<?php } ?>