<?php
 session_start();
 include('connect.php');
 if(!isset($_SESSION['email'])) {
    header('location:login.php');
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="css/home.css" />
    <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">

</head>
<body>
    <div class="container main-section">
        <div class="row">
            <div class="col-md-3 col-xs-12 col-sm-3 left-sidebar">
                <div class="input-group search-box">
                    <div class="input-group btn">
                        <center><a href="include/find_friends.php"><button class="btn btn-default search-icon" name="search_user" type="submit">Add new user</button></a></center>
                    </div>
                </div>
                <div class="left-chat">
                    <ul>
                        <?php include('include/get_users_data.php'); ?>
                    </ul>
                </div>
            </div>
            <div class="clo-md-9 col-sm-9 col-xs-12 right-sidebar">
                <div class="row">
                    <!-- getting the information of logged in user -->
                        <?php
                    
                    $user = $_SESSION['email'];
                    $get_user = "SELECT * FROM users WHERE email='$user'";
                    $result = mysqli_query($db, $get_user);
                    $row = mysqli_fetch_array($result);

                    $user_id = $row['id'];
                    $user_name = $row['name'];
                ?>

                <!-- getting the user data on which user click -->
                <?php
                    if(isset($_GET['user_name'])) {
                        global $db;

                        $get_username = $_GET['user_name'];
                        $get_user = "SELECT * FROM users WHERE name='$get_username'";
                        $result = mysqli_query($db, $get_user);
                        $row_user = mysqli_fetch_array($result);

                        $username = $row_user['name'];
                        $user_profile_image = $row_user['profile'];
                    }

                    $total_messages = "SELECT * FROM users_chat WHERE (sender_username='$user_name' AND receiver_username='$username') OR (receiver_username='$user_name' AND sender_username='$username')";
                    $run_message = mysqli_query($db, $total_messages);
                    $total = mysqli_num_rows($run_message);
                ?>
                <div class="col-md-12 right-header">
                    <div class="right-header-image">
                        <img src="<?= $user_profile_image ?>" alt="">
                    </div>
                    <div class="right-header-detail">
                        <form action="" method="get">
                            <p><?= $username ?></p>
                            <span><?= $total ?> messages</span>&nbsp &nbsp
                            <button name="logout" class="btn btn-danger">Logout</button>
                        </form>
                        <?php
                            if(isset($_GET['logout'])) {
                                $update_msg = mysqli_query($db, "UPDATE users SET log_in='Offline' WHERE name='$user_name'");
                                header('location:logout.php');
                                exit();
                            }
                        ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-12 right-header-contentChat" id="scrolling_to_bottom">
                    <?php
                        $update_msg = mysqli_query($db, "UPDATE users_chat SET msg_status='read' WHERE sender_username='$username' AND receiver_username='$user_name'");

                        $select_msg = "SELECT * FROM users_chat WHERE (sender_username='$user_name' AND receiver_username='$username') OR (receiver_username='$user_name' AND sender_username='$username') ORDER BY 1 ASC";

                        $run_msg = mysqli_query($db, $select_msg);

                        while($row = mysqli_fetch_array($run_msg)) {
                            $sender_username = $row['sender_username'];
                            $receiver_username = $row['receiver_username'];
                            $msg_content = $row['msg_content'];
                            $msg_date = $row['msg_date'];

                    ?>
                    <ul>
                        <?php
                            if($user_name == $sender_username AND $username == $receiver_username) {
                                echo "<li>
                                        <div class='rightside-right-chat'>
                                            <span>$username<small>$msg_date</small></span>
                                            <br></br>
                                            <p>$msg_content</p>
                                        </div>
                                </li>";
                            }
                            else if($user_name == $receiver_username AND $username == $sender_username) {
                                echo "<li>
                                        <div class='rightside-right-chat'>
                                            <span>$username<small>$msg_date</small></span>
                                            <br></br>
                                            <p>$msg_content</p>
                                        </div>
                                </li>";
                            }
                        ?>
                    </ul>
                    <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 right-chat-textbox">
                    <form action="" method="post">
                        <input type="text" name="msg_content" autocomplete="off" placeholder="Write message...">
                        <button class="btn" name="submit"><i style="color:white; font-size:25px ;margin:auto;" class="bi bi-send-fill" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
            </div> 
        </div>
    </div>
    <?php
        if(isset($_POST['submit'])) {
            $msg = $_POST['msg_content'];

            if(empty($msg)) {
                echo "<script>alert('Message was unable to send')</script>";
            } else if(strlen($msg) > 100) {
                echo "<script>alert('Message is too long, use only 100 characters.')</script>";
            } else {
                $insert = "INSERT INTO users_chat(sender_username,receiver_username,msg_content,msg_status,msg_date) VALUES('$user_name','$username','$msg','unread',NOW())";
                $run = mysqli_query($db, $insert);
            }
        }
    ?>

    <!-- <script>
        $('#scrolling_to_bottom').animate({
            scrollTop: $('#scrolling_to_bottom').get(0).scrollHeight}, 1000);
    </script>
    <script>
        $(document).ready(function() {
            let height = $(window).height();
            $('.left-chat').css('height', (height - 92) + 'px');
            $('.right-header-contentChat').css('height', (height - 163) + 'px')
        });
    </script> -->
</body>
</html>