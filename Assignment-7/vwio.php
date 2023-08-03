<?php
require_once('config.php');
require_once('searchexpense.php');
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
