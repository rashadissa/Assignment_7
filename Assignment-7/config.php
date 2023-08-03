<?php
try{
    $dbhost='localhost';
    $username='root';
    $pass='';
    $dbname='expensetracker';
    $conn=mysqli_connect($dbhost,$username,$pass,$dbname);
    //echo "conn true";
}catch(Exception $e){
    echo $e->getMessage();
    exit();
}
