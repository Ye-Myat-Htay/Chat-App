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
    <title>Account Setting</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">

</head>
<body>
    <div class="row">
        <div class="col-sm-2"></div>
        <?php
        $user = $_SESSION['email'];
        $get_user = "SELECT * FROM users WHERE email='$user'";
        $run_user = mysqli_query($db, $get_user);
        $row = mysqli_fetch_array($run_user);

        $user_name = $row['name'];
        $user_pass = $row['password'];
        $user_email = $row['email'];
        $user_profile = $row['profile'];
        $user_country = $row['country'];
        $user_gender =$row['gender'];
        ?>

        <div class="cpl-sm-8">
            <form action="" method="post" enctype="miltipart/form-data">
                <table class="table table-bordered table-hover">
                    <tr aligh="center">
                        <td colspan="6" class="active"><h2>Change Account Setting</h2></td>
                    </tr>

                    <tr>
                        <td style="font-weight:bold;">Change Username</td>
                        <td>
                            <input type="text" name="u_name" required class="form-control" value="<?= $user_name ?>">
                        </td>
                    </tr>

                    <tr><td></td><td><a href="upload.php" class="btn btn-default" style="text-decoraton:none;font-size:15px"><i class="fa fa-user" aria-hidden="true"></i>Change Profile</a></td></tr>

                    <tr>
                        <td style="font-weight:bold;">Change Email</td>
                        <td>
                            <input type="email" name="u_email" required class="form-control" value="<?= $user_email ?>">
                        </td>
                    </tr>

                    <tr>
                        <td style="font-weight:bold;">Country</td>
                        <td>
                            <select name="u_country" calss="form-control">
                                <option><?= $user_country ?></option>
                                <option>USA</option>
                                <option>UK</option>
                                <option>France</option>
                                <option>Germany</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td style="font-weight:bold;">Gender</td>
                        <td>
                            <select name="u_gender" calss="form-control">
                                <option><?= $user_gender ?></option>
                                <option>Male</option>
                                <option>Female</option>
                                <option>Others</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td style="font-weight:bold;">Forgotten Password</td>
                        <td>
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Forgot Password</button>

                            <div class="modal fade" id="myModal" role="dailog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="recovery.php?id=<?= $user_id ?>" method="post" id="f">
                                                <strong>What is your school best friend name?</strong>
                                                <textarea class="form-control" name="content"  placeholder="Someone" cols="83" rows="4"></textarea><br><br>
                                                <input type="submit" name="sub" class="btn btn-default" value="Submit" style="width:100px;"><br><br>
                                                <pre>Answer the above question we will ask you this question if you forgot your <br>Password.</pre><br><br>
                                            </form>

                                            <?php
                                                if(isset($_POST['sub'])) {
                                                    $bfn = $_POST['content'];

                                                    if(empty($bfn)) {
                                                       echo "<script>alert('Please enter something')</script>";
                                                       echo "<script>window.open('account_setting.php', '_self')</script>";
                                                       exit();
                                                    } else {
                                                        $update = "UPDATE users SET forgotten_answer='$bfn' WHERE email='$user'";
                                                        $run = mysqli_query($db, $update);

                                                        if($run) {
                                                            echo "<script>alert('Working...')</script>";
                                                            echo "<script>window.open('account_setting.php', '_self')</script>";
                                                        } else {
                                                            echo "<script>alert('Error...')</script>";
                                                            echo "<script>window.open('account_setting.php', '_self')</script>";
                                                        }
                                                    }
                                                }
                                            ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                        <tr><td></td><td><a href="change_password.php" class="btn btn-default" style="text-dedcoration:none; font-size:15px;"><i class="fa fa-key fa-fw" aria-hidden="true"></i>Change Password</a></td></tr>

                        <tr class="text-center">
                            <td colspan="6">
                                <input type="submit" value="Update" name="update" class="btn btn-info">
                            </td>
                        </tr>
                </table>
            </form>
            <?php
                if(isset($_POST['update'])) {
                    $user_name = $_POST['u_name'];
                    $email = $_POST['u_email'];
                    $u_country = $_POST['u_country'];
                    $u_gender = $_POST['u_gender'];

                    $update = "UPDATE users SET name='$user_name', email='$email', country='$u_country', gender='$u_gender' WHERE email='$user' ";
                    $run = mysqli_query($db, $update);

                    if($run) {
                        echo "<script>window.open('account_setting.php', '_self')";
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