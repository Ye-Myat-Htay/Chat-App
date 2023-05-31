<?php
 session_start();
 include('../connect.php');
 include('find_friends_function.php');
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
    <title>Search for friends</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../css/find_people.css" />
    <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">

</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <a href="#" class="navbar-brand">
            <?php
                $user = $_SESSION['email'];
                $get_user = "SELECT * FROM users WHERE email='$user'";
                $run_user = mysqli_query($db, $get_user);
                $row = mysqli_fetch_array($run_user);
                $user_name = $row['name'];
                echo "<a class='navbar-brand' href='../home.php?user_name=$user_name'>My Chat</a>";
            ?>
        </a>
        <ul class="navbar-nav">
            <li><a style="color:white; text-decoration:none; font-size:20px;" href="../account_setting.php">Setting</a></li>
        </ul>
    </nav><br>
    <div class="row">
        <div class="col-sm-4">

        </div>
        <div class="col-sm-4">
            <form action="" class="search-form" method="get">
                <input type="text" name="search_query" placeholder="Search Friends">
                <button class="btn btn" type="submit" name="search_btn">Search</button>
            </form>
        </div>
        <div class="col-sm-4">
            
        </div>
    </div><br><br>
    <?php search_user(); ?>
</body>
</html>