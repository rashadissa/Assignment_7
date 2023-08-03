<?php
//متغير لحفظ قيمه رقم الفئه
$categoryid='';
session_start();
require_once('config.php');
if(!isset($_SESSION["categoryName"])&&empty($_SESSION["categoryName"])){
    echo"<br>Please Enter the name of the category whose expense you want to disblay<br>";
    header("location:addexpense.php");
}
$categoryid=$_SESSION["categoryId"] ;
//لجلب جميع المصروفات التي تخص الفئه معينه 
$sql2 = "SELECT * FROM `category` WHERE categoryId='$categoryid'";
$result = $conn->query($sql2);
if ($result->num_rows > 0) {
    if ($row = $result->fetch_assoc()) {
        $_SESSION["categoryName"] = $row["categoryName"];
    }  
} 
echo"<h3>These expense fall into this category </h3>" .$_SESSION["categoryName"] ;
$sql1="SELECT * FROM expense WHERE categoryId='$categoryid'";
$result=mysqli_query($conn,$sql1);
?>
<table>
    <tr>
        <th>expenseAmount</th>
        <th>expenseDate</th>
        <th>expensetext</th>
        <th>Pymentexpense</th>
        
    </tr>
<?php
//لتحويل البينات التي تم اخدها من قاعده البينات الي مصفوفه 
while($expense=mysqli_fetch_array($result)){
?>
<tr>
    
    <td><?php echo $expense['expenseAmount']?></td>
    <td><?php echo $expense['expenseDate']?></td>
    <td><?php echo $expense['expensetext']?></td>
    <td><?php echo $expense['Pymentexpense']?></td>
    <td><a href="editexpense.php?id=<?=$expense['expenseId'];?>">update</td>
    <td><a href="deleteexpense.php?id=<?=$expense['expenseId'];?>">delete</td>
</tr>

<?php
}

?>
</table>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>showexpense</title>
    <link rel="stylesheet" href="css/showexpense.css">
</head>
<body>
    
</body>
</html>