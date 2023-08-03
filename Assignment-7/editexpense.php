<?php

require_once('config.php');
$idexpense='';
$idexpense=$_GET['id'];

session_start();

echo"User Name ->".$_SESSION["Name"]."<br><br>";

$subcategory='';
if(isset($_POST['Update'])){
  
  $userid=$_SESSION["userId"];
  $coment=$_POST['comment'];
  $amount=$_POST['number'];
  $date=$_POST['date'];
  $payment=$_POST['pymenttipe'];
  
   $sql = "SELECT * FROM `expense` WHERE expenseId='" .$idexpense. "';";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
       if ($row = $result->fetch_assoc()) {
          $_SESSION["categoryId"] = $row["categoryId"];
     }  
 }
 $categoryedit=$_SESSION["categoryId"];
 $sql = "SELECT * FROM `category` WHERE categoryId ='" .$categoryedit. "';";
 $result = $conn->query($sql);
 if ($result->num_rows > 0) {
      if ($row = $result->fetch_assoc()) {
         $_SESSION["categoryAmount"] = $row["categoryAmount"];
    }  
}
//  echo"categoryAmount =".$_SESSION["categoryAmount"]  ;
  $totalcategory=$_SESSION["categoryAmount"];
  
  $subcategory=$totalcategory-$amount;

    if($subcategory<0){
      echo("<br>The value of the category total is less than 0<br>");
    }
    else{
      $categoryId=$_SESSION["categoryId"];
      //لتعديل الاجمالي الفئه
      $updatetotalcategory="UPDATE category SET categoryAmount='$subcategory' WHERE categoryId ='$categoryId'";
      $update=$conn->query($updatetotalcategory);
      if($update){
        echo"<br>The category total value has been modified successfully<br>";
        $updateexpense="UPDATE expense SET expenseAmount='$amount',expenseDate='$date',
        expensetext='$coment',Pymentexpense='$payment' WHERE expenseId=$idexpense";
        $update_expense=mysqli_query($conn,$updateexpense);
        if($update_expense){
            echo"Expense data has been modified successfully<br>";
        }else {
            echo"Expense data modification failed<br>";
        }
      }
    }
  } 
  //لطباعه الاجمالي للفئه
  if($subcategory>=0)
  {  
    echo"total Amount ".$subcategory;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/addexpenss.css">
    <title>Expense Tracker App</title>
</head>
<body>
<header>
        <nav>
            <li><a href="showexpense.php">show expense</a></li>
            <li><a href="abouttheexpense.php">about the expense</a></li>
        </ul>
</header>
 </nav>
    <h1 class="logo">Expense Tracker 
      update expense 
    </h1>
    <div class="input-section">
        <form method="POST">
          <label for="comment">comment</label>
        <textarea  name="comment" placeholder="Comment" class="text"></textarea>
        <label for="amount-input">Amount:</label>
        <input type="number" id="amount-input" name="number">
        <label for="date-input">Date:</label>
        <input type="date" id="date-input" name="date">
        <label for="amount-input">Payment:</label>
        <select name="pymenttipe" class="py">
          <option value="card">card</option>
          <option value="check">check</option>
          <option value="cash">cash</option>
        </select>
        <button id="add-btn" name="Update">Update</button>
        </form>
    </div>
    </nav>
</body>
</html>