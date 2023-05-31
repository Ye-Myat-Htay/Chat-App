<?php
include('../connect.php');

function search_user() {
    global $db;

    if(isset($_GET['search_btn'])) {
        $search_query = $_GET['search_query'];
        $get_user = "SELECT * FROM users WHERE name LIKE '%search_query%' OR country LIKE '%$search_query%'";
    } else {
        $get_user = "SELECT * FROM users ORDER BY country,name DESC LIMIT 5";
    }
    $run_user = mysqli_query($db, $get_user);

    while($row_user = mysqli_fetch_array($run_user)) {
        $user_name = $row_user['name'];
        $user_profile = $row_user['profile'];
        $country = $row_user['country'];
        $gender = $row_user['gender'];

        // display all at once
        echo "
            <div class='card'>
                <img src='../$user_profile'>
                <h1>$user_name</h1>
                <p class='title'>$country</p>
                <p>$gender</p>
                <form method='post'>
                    <p><button name='add'>Chat with $user_name</button><p>
                <form>
                <div><br><br>
        ";
        if(isset($_POST['add'])) {
            echo "<script>window.open('../home.php?user_name=$user_name', '_self')</script>";
        }
    }
}
?>