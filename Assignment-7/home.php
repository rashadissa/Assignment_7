<?php
session_start();
require_once("config.php");
if(!isset($_SESSION["Name"])&&empty($_SESSION["Name"])){
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/home.css">
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/instagram.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<body>
    <header >
    <nav>
        <h2 class="logo">Expense Tracker</h2>
        <ul class="menu">
            
            <li><a href="login.php">Login</a></li>
            <li><a href="#">about us</a></li>
            <li><a href="regester.php">Sigh up</a></li>
            <li><a href="addcategory.php">add category</a></li>
            <li><a href="addexpense.php">add expense</a></li>
            <li><a href="Modifyuserdata.php">Modify user data</a></li> 
            <li><a href="transfer.php">transfer many category to category</a></li> 
            <li><a href="addrating.php">add ratings</a></li> 
            <li><a href="#">reports</a></li>
            <li><a href="logout.php">log out</a></li>
        </ul>
</header>
    </nav>
    <div class="Welcom">
        <p class="LOGO">Welcome to the Expense Tracker Websit</p>
    </div>
    <section class="footer">
        <div class="social">
            <a href=""><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-snapchat"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-linkedin"></i></a>
        </div>
        <ul class="list">
            <li><a href="#">Home</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="#">about us</a></li>            
            <li><a href="addcategory.php">add category</a></li>         
            <li><a href="addexpense.php">add expense</a></li>         
            <li><a href="Modifyuserdata.php">Modify user data</a></li>         
            <li><a href="#">reports</a></li>            
            <li><a href="regester.php">Sigh up</a></li>
        </ul>
        <p class="copyright">
        Expense Tacker @2023</p>
    </section>
</body>
</html>