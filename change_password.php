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
        body {
            overflow-x: hidden;
        }
    </style>
</head>
<body>
    <div class="row">
        <div class="col-sm-2">

        </div>
    
            <div class="col-sm-8">
                <form action="" method="post" enctype="multipart/form-data">
                    <table class="table table-bordered table-hover">
                        <tr aligh="center">
                            <td colspan="6" class="active"><h2>Change Password</h2></td>
                        </tr>

                        <tr>
                            <td style="font-weight:bold;">Current Password</td>
                            <td>
                                <input type="password" name="current_pass" id="mypass" required class="form-control" placeholder="Current Password">
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight:bold;">New Password</td>
                            <td>
                                <input type="password" name="u_pass1" id="mypass" required class="form-control" placeholder="New Password">
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight:bold;">Confirm Password</td>
                            <td>
                                <input type="password" name="u_pass2" id="mypass" required class="form-control" placeholder="Confirm Password">
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td colspan="6">
                                <input type="submit" name="change" value="Change" class="btn btn-info">
                            </td>
                        </tr>
                    </table>
                </form>
                <?php
                    if(isset($_POST['change'])) {
                        $c_pass = $_POST['current_pass'];
                        $pass1 = $_POST['u_pass1'];
                        $pass2 = $_POST['u_pass2'];

                        $user = $_SESSION['email'];
                        $get_user = "SELECT * FROM users WHERE email='$user'";
                        $run_user = mysqli_query($db, $get_user);
                        $row = mysqli_fetch_array($run_user);

                        $user_pass = $row['password'];

                        if($c_pass != $user_pass ) {
                            echo "<div class='alert alert-danger'>
                                    <strong>Your old password didn't match</strong>
                                    </div>";
                        }
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
                        if($pass1 == $pass2 && $c_pass == $user_pass) {
                            $update_pass = mysqli_query($db, "UPDATE users SET password='$pass1' WHERE email='$user'");

                            echo "<div class='alert alert-danger'>
                                    <strong>Your password was changed</strong>
                                    </div>";
                        }
                    }
                    ?>
            </div>
            <div class="col-sm-2">

            </div>
    </div>
</body>
</html>
<?php } ?>