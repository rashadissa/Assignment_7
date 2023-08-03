<?php

session_start();

require_once('config.php');

if(!isset($_SESSION["Name"])&&empty($_SESSION["Name"])){
    header('location:login.php');
}

echo"User Name ->".$_SESSION["Name"]."<br><br>";
$subcategory='';
if(isset($_POST['add'])){
  $userid=$_SESSION["userId"];
  $coment=$_POST['comment'];
  $amount=$_POST['number'];
  $date=$_POST['date'];
  $payment=$_POST['pymenttipe'];
  $categoryname=$_POST['category-name'];
  //للبحت عن الفئه التي يريد المستخدم اضافه مصروف اليها 
  $sql = "SELECT * FROM `category` WHERE categoryName='" . $categoryname . "'
  AND userId='".$userid."';";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      if ($row = $result->fetch_assoc()) {
          $_SESSION["categoryId"] = $row["categoryId"];
          $_SESSION["categoryName"] = $row["categoryName"];
          $_SESSION["categoryAmount"] = $row["categoryAmount"];
      }  
  } 
  $totalcategory=$_SESSION["categoryAmount"];
  
  $subcategory=$totalcategory-$amount;
try{
    if($subcategory<0){
      throw new Exception("<br>The value of the category total is less than 0<br>");
    }
  } 
  catch(Exception $q){
    echo $q->getMessage();
    
}
    if($subcategory>=0){
      $categoryId=$_SESSION["categoryId"];
      //لتعديل الاجمالي الفئه
      $updatetotalcategory="UPDATE category SET categoryAmount='$subcategory' WHERE categoryId ='$categoryId'";
      $update=$conn->query($updatetotalcategory);
      if($update){
        echo"The category total value has been modified successfully<br>";
        $adddata="INSERT INTO expense(expenseAmount,expenseDate,categoryId ,userId,expensetext,Pymentexpense)
        VALUES('$amount','$date','$categoryId','$userid','$coment','$payment')";
        $add=mysqli_query($conn,$adddata);
      }
  } 
  //لطباعه الاجمالي للفئه
  if($subcategory>=0){
    $_SESSION["categoryTotal"]=$subcategory;
    echo"total Amount ".$_SESSION["categoryTotal"];
  }
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
            <li><a href="searchexpense.php">Search the expense</a></li>
            <li><a href="logout.php">log out</a></li>
        </ul>
</header>
</nav>
    <h1 class="logo">Expense Tracker 
      add expense 
    </h1>
    <div class="input-section">
        <form method="POST">
          <label for="comment">comment</label>
        <textarea  name="comment" placeholder="Comment" class="text"></textarea>
        <label for="amount-input">Amount:</label>
        <input type="number" id="amount-input" name="number" min="1">
        <label for="date-input">Date:</label>
        <input type="date" id="date-input" name="date">
        <label for="amount-input">Payment:</label>
        <select name="pymenttipe" class="py">
          <option value="card">card</option>
          <option value="check">check</option>
          <option value="cash">cash</option>
        </select>
        <label for="amount-input">categoryName:</label>
        <select id="category-select" name="category-name" required class="category-name">
            <option value="Food & Beverage">Food & Beverage</option>
            <option value="Rent">Rent</option>
            <option value="Transport">Transport</option>
            <option value="Relaxing">Relaxing</option>
            <option value="gift">gift</option>
            <option value="house">house</option>
        </select><br><br>
        <button id="add-btn" name="add">Add</button>
        </form>
    </div>
    </nav>
</body>
</html>

