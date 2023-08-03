<?php
require_once("config.php");
session_start();
    if(!isset($_SESSION["Name"])&&empty($_SESSION["Name"])){
        header('location:login.php');
    }
    echo"User Name ->".$_SESSION["Name"]."<br><br>";
    if(isset($_POST['tarnsfar'])){
        $namecategoryfrom=$_POST['category-name1'];
        $namecategoryto=$_POST['category-name2'];
        $userid=$_SESSION["userId"] ;
        $amount=$_POST['amount'];
        $date=$_POST['date'];
        $comment=$_POST['comment'];
        //جلب السجل الفئه المحول منها 
        $sql = "SELECT * FROM `category` WHERE categoryName='" .$namecategoryfrom . "'
        AND userId='".$userid."';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if ($row = $result->fetch_assoc()) {
                $categoryidfrom= $row["categoryId"];
                $amountcategoryfrom= $row["categoryAmount"];
            }  
        } 
        else{
            echo"<h3 style='color:red;text-align:center;'>
            I can't get the transfer
            Because you were not registered in one of the two categories
            </h3>";
            exit(0);
        }
        //جلب سجل الفئه المحول اليها 
        $sql = "SELECT * FROM `category` WHERE categoryName='" .$namecategoryto . "'
        AND userId='".$userid."';";
        $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                if ($row = $result->fetch_assoc()) {
                    $categoryidto = $row["categoryId"];
                    $amountcategoryto= $row["categoryAmount"]; 
                }  
                
        }  
        else{
            echo"<h3 style='color:red;text-align:center;'>
            I can't get the transfer
            Because you were not registered in one of the two categories
            </h3>";
            exit(0);
        }
        try{ 
            //شروط التحقق
            if($namecategoryfrom==$namecategoryto){
            throw new Exception("<br>The names of the categories are the same You cannot transfer interviews<br>");
            }
            if($amountcategoryfrom==0){
            throw new Exception("<br>The value of the category to be converted from is zero<br>");
            }
            else if($amount<=0||$amount>$amountcategoryfrom){
            throw new Exception("<br>The transferred value can be negative or greater than the total category from which it is transferred<br>");
            } 
        else{
        //التعديل علي قيمه الاجمالي الفئه المحول اليها
        $categoryto_tarnsfar=$amountcategoryto+$amount;
        $sql="UPDATE category SET categoryAmount='$categoryto_tarnsfar'WHERE categoryId ='$categoryidto'
        AND userId='$userid'";
        $result=mysqli_query($conn,$sql);
        //التعديل علي القيمه الاجمالي الفئه المحول منها//
        $categoryfrom_tarnsfar=$amountcategoryfrom-$amount;
        $sql="UPDATE category SET categoryAmount='$categoryfrom_tarnsfar'WHERE categoryId ='$categoryidfrom'
        AND userId='$userid'";
        $result=mysqli_query($conn,$sql);
        //الاضافه داخل جدول الحولات
        $mysqli=new mysqli($dbhost,$username,$pass,$dbname);
        /*START TRANSACTION*/
        $mysqli->begin_transaction();
        try{
        $insert="INSERT INTO transfars(categoryidfrom,categoryidto,userId,
        tarnsfaramount,transfaredate,tarnsfarcomment) VALUES('$categoryidfrom',
        '$categoryidto','$userid','$amount','$date','$comment')";
        $result=mysqli_query($conn,$insert);
        if($result){
            echo"<h3>The transfer process has been completed successfully</h3>";
        }else{
            throw new Exception("<br>Failed interviews transfer process<br>");
        }
        }//انتهاء الحواله 
        catch(mysqli_sql_exception $q){ echo $q->getMessage(); }
        }
        }catch(Exception $e){echo $e->getMessage();}
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tarnsfar many category to category</title>
    <link rel="stylesheet" href="css/categorytocategoryy.css">
</head>
<body>
<h1 class="logo">tarnsfer many category to category</h1>
<form method="POST">
    <label for="date">Date:</label>
    <input type="date" id="date" name="date"> 
    <label for="amount">Transfer Amount:</label>
    <input type="number" id="amount" name="amount">
    
    <label for="reason">Reason/Comments:</label>
    <textarea id="reason" name="comment"></textarea>
    
    <label for="from">From Category:</label>
    <select id="from" name="category-name1">
    <option value="Food & Beverage">Food & Beverage</option>
                <option value="Rent">Rent</option>
                <option value="Transport">Transport</option>
                <option value="Relaxing">Relaxing</option>
                <option value="gift">gift</option>
                <option value="house">house</option>
                <option value="tickets">tickets</option>
    </select>
    
    <label for="to">To Category:</label>
    <select id="to" name="category-name2">
    <option value="Food & Beverage">Food & Beverage</option>
                <option value="Rent">Rent</option>
                <option value="Transport">Transport</option>
                <option value="Relaxing">Relaxing</option>
                <option value="gift">gift</option>
                <option value="house">house</option>
                <option value="tickets">tickets</option>
    </select>
    <input type="submit" value="Transfer" name="tarnsfar">
    </form>
    </body>
    </html>