<?php 

session_start();
if (!isset($_SESSION['email'])){
    header("Location: index.php");
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User page</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body style="background: #fff;">
    <div class="box">
        <h1>Welcome, <span><?= $_SESSION['name']; ?></span></h1>
        <p>Welcome To <span>MediBook</span></p>
        <button onclick="window.location.href='appointment.php';">Appoint</button>
    </div>
</body>
</html>