<?php
session_start();
if(!isset($_SESSION["Name"] )&&empty($_SESSION["Name"] )){
    header('location:login.php');
}
require_once('config.php');
echo"User Name ->".$_SESSION["Name"];
$username= $email=$pass= $rpass='';
//array Error
$errors=array("username"=>'','email'=>'','pass'=>'','rpass'=>'','cpassword'=>'','box'=>'');
if(isset($_POST['submit'])){
    if(empty($_POST['username'])){
        $errors['username']="Add user name ";
    }
    else{
        $username=$_POST['username'];
        if(preg_match('/^[a-z\d_]{5,15}/i',$username)==false){
            $errors['username']="Please Enter charachter and digits min5 and max 15";
        }
    }
    if(empty($_POST['email'])){
        $errors['email']="Add Email ";
    }
    else{
        $email=$_POST['email'];
        if(filter_var($email,FILTER_VALIDATE_EMAIL)==false){
            $errors['email']="please Enter Email style m@g.com";
        }
    $stm="SELECT email FROM user WHERE email ='$email'";
    
    $data=mysqli_query($conn,$stm);
    if($data){
        $errors['email']="Email already exists";
    }
    }
    if(empty($_POST['password'])){
        $errors['pass']="Add Password ";
    }
    else {
            $pass=$_POST['password'];
            $number = preg_match('@[0-9]@', $pass);
            $uppercase = preg_match('@[A-Z]@', $pass);
            $lowercase = preg_match('@[a-z]@', $pass);
            $specialChars = preg_match('@[^\w]@', $pass);
            if(strlen($pass) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
                $errors['pass'] = "please Enter strong password!!";
            } 
    }
    if(empty($_POST['rpassword'])){
        $errors['rpass']="Add confirm password ";
    }
    else{
        $rpass=$_POST['rpassword'];
    }
    if($pass!=$rpass){
        $errors['cpassword']="Please Enter The Same Password  ";
    }
    if(empty($_POST['chekbox'])){
        $errors['box']="Please click on the agreement button";
    }
    if(array_filter($errors)==[]){
        $userid=$_SESSION["userId"];
        $sql="UPDATE users SET Name='$username', email='$email' ,password='$pass' WHERE userId =$userid";
        $update=mysqli_query($conn,$sql);
        if($update){
            echo"Data has been modified successfully";
            header('location:home.php');
        }
        
        else {
            echo"Failed to modify data";
        }
    }
}
?>      
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data User</title>
</head>
<link rel="stylesheet" href="css/main.css">
<body> 
    <div class="main">
        <h1 id="top">Update Data User </h1> 
        <form method="POST">
        <?php echo$errors['username'];?><br>
        <input type="text" name="username" placeholder="Enter Your name" required><br>
        <?php echo$errors['email'];?><br>
        <input type="text" name="email" placeholder="Enter E-mail" required><br>
        <?php 
        echo$errors['pass'];
        ?><br>
        <input type="password" name="password" placeholder="Enter password" required><br>
        <?php echo$errors['cpassword'];?><br>
        <input type="password" name="rpassword" placeholder="Enter confirm password " required><br>
        <h7 class="chekbox">I accept all terms</h7><br>
        <?php echo$errors['box'];?><br>
        <input  id="chekbox" type="checkbox" name="chekbox" required>
        <input type="submit" name="submit" value="Update" required><br>
        <form>
    </div>
</body>
</html>
