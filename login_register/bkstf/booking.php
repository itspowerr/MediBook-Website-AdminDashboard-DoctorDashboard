<?php

session_start();
require_once 'config.php';

if (isset($_POST['booking'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $service = $_POST['service'];

    $conn->query("INSERT INTO `booking` (`id`, `name`, `email`, `date`, `service`) VALUES (NULL, '$name', '$email', '$date', '$service')");
    if ($conn->error) {
        echo "Failed". $conn->error;
    }

    header("Location: info.php");
    exit();

}


?>