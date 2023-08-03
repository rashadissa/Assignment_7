<?php
session_start();
$category=false;
require_once('config.php');
if(!isset($_SESSION["Name"])&&empty($_SESSION["Name"])){  
    header('location:login.php');
}
echo"User Name ->".$_SESSION["Name"];?><br><br>
<?php
if(isset($_POST['add'])){
    
    $categoryname=$_POST['category-name'];
    $userid=$_SESSION["userId"];
    //لتجاهل اعطاء المستخدم نفس الفئه مرتان
    $sql="SELECT categoryName FROM category WHERE 	categoryName='$categoryname' AND userId='$userid'";
    $q=$conn->prepare($sql);
        $q->execute();
        $data=$q->fetch();
    if($data){
        $category=true;
        echo"The category name already exists";
        
    }else {
        echo"The category has been added successfully";
    }
    $categoryAmount=$_POST['number'];
    $categoryDate=$_POST['date'];
    $userid=$_SESSION["userId"];
    if($category===false){
        $adddata="INSERT INTO category(categoryName,categoryAmount,categoryDate,userId)
        VALUES('$categoryname','$categoryAmount','$categoryDate','$userid')";
        $add=mysqli_query($conn,$adddata);
    }
}        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/addcategory.css">
    <title>Expense Tracker App</title>
</head>
<body>
    <h1 class="logo">Expense Tracker Add category
    </h1>
    <form method="POST">
        <div class="input-section">
        <label for="category-select">Category:</label>
        <select id="category-select" name="category-name" required class ="category-name">
            <div class="option">
            <option value="Food & Beverage">Food & Beverage</option>
            <option value="Rent">Rent</option>
            <option value="Transport">Transport</option>
            <option value="Relaxing">Relaxing</option>
            <option value="gift">gift</option>
            <option value="house">house</option>
            <option value="tickets">tickets</option>
            </div>
        </select>
        <label for="amount-input">Amount:</label>
        <input type="number" id="amount-input" name="number" required>
        <label for="date-input">Date:</label>
        <input type="date" id="date-input" name="date" required>
        <input type="submit" value="add" name="add">
    </div>
    </form>
</body>
</html>