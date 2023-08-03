<?php
session_start();
$result=[];
require_once('config.php');
if(isset($_POST['submit'])){
    if(isset($_POST['date1'])&&isset($_POST['date2'])){
        $date1=$_POST['date1'];
        $date2=$_POST['date2'];
        $sql="SELECT * FROM expense WHERE expenseDate BETWEEN '$date1' AND '$date2'";
        $result=mysqli_query($conn,$sql);
    }
}
?>
 <style>
    table{
    width: 40%;
    border-spacing: 0px;
}

table td{
    padding: 10px;
    background-color: #eee;
    border:1px solid #e2e2e2;

}

table td a{
    text-decoration: none;
    color: red;
}
</style>
<table>
    <tr>
        <th>expenseAmount</th>
        <th>expenseDate</th>
        <th>expensetext</th>
        <th>Pymentexpense</th>
    </tr> 
<?php

foreach($result as $expense){
    ?>
<tr>
    <td><?php echo $expense['expenseAmount']?></td>
    <td><?php echo $expense['expenseDate']?></td>
    <td><?php echo $expense['expensetext']?></td>
    <td><?php echo $expense['Pymentexpense']?></td>
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
    <link rel="stylesheet" href="css/searchexpense.css">
    <title>Search Expense</title>
</head>
<body>
<form method="POST">
        <div class="main">
            <h1 class="logo">Search Expense</h1>
            <h3>Date from:</h3>
            <input type="date" name="date1" placeholder="Enter Your date" required><br>
            <h3>to:</h3>
            <input type="date" name="date2" placeholder="Enter Your date" required><br>
            
                <h3>category:</h3>
            <input type="text" name="categoryname" placeholder="category search"><br>
            <input type="submit" name="submit" value="Search"><br>
            
            
        </div>
        <form>
</body>
</html>