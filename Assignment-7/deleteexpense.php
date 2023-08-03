<?php

require_once('config.php');
$idexpense='';
$idexpense=$_GET['id'];

$sql="DELETE FROM expense WHERE expenseId='$idexpense'";

$deleteexoense=mysqli_query($conn,$sql);

if($deleteexoense)
{
    header('location:showexpense.php');
}
else 
{
    echo"Ther is problem in Deleting expense !! ".mysqli_error($conn);
}





?>