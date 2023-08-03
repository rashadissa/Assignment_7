<?php
session_start();
if(!isset($_SESSION["categoryName"])&&empty($_SESSION["categoryName"])){
    echo"<br>Please Enter the name of the category whose expense you want to disblay<br>";
    header("location:addexpense.php");
}
echo"<h1> user name <h1/>".$_SESSION['Name'];
echo"<h1> total Amount <h1/>".$_SESSION["categoryTotal"];
echo"<h1> category Name<h1/>".$_SESSION["categoryName"] ;
?>