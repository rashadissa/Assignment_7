<?php
session_start();

require_once("config.php");
$erorr=" ";
if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
        $sql = "SELECT * FROM `users` WHERE Name='" . $username .
        "' AND password='" . $password . "';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if ($row = $result->fetch_assoc()) {
                $_SESSION["userId"] = $row["userId"];
                $_SESSION["Name"] = $row["Name"];
                $_SESSION["Email"] = $row["email"];
            }
            header('location:home.php');
        } else {
            $erorr='The password or username is incorrect';
        }
        
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>log in</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <form method="POST">
        <div class="main">
            <h1>Log in</h1>
            <input type="text" name="username" placeholder="Enter Your name" required><br>
            <input type="password" name="password" placeholder="Enter Your password" required><br>
            <?php echo $erorr;?><br>
            <input type="submit" name="submit" value="Log in"><br>
            <h3>OR</h3>

            <a href="regester.php">register</a>
        </div>
        <form>
</body>

</html>