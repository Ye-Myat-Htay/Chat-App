<?php

$db = mysqli_connect('localhost', 'root', '', 'chat_app');
if(!$db) {
    die(mysqli_error($db));
}