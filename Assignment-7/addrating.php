  <?php
  session_start();
  $flag=false;
  require_once('config.php');
  if(!isset($_SESSION["Name"])&&empty($_SESSION["Name"])){
      header('location:login.php');
  }
  echo"User Name ->".$_SESSION["Name"]."<br><br>";
  if(isset($_POST['submit'])){
      $rating=$_POST['rating'];
      $comment=$_POST['comment'];
      $userid=$_SESSION["userId"];
    $sql="SELECT userId FROM rating WHERE userId ='$userid'";
    $q=$conn->prepare($sql);
    $q->execute();
    $data=$q->fetch();
    try{
      if($data){
    $flag=true;
    throw new Exception("<br>You can not rate because you have already evaluated<br>");
  }
    }
    catch(Exception $e){echo $e->getMessage();}
  if($flag===false){
  $insert="INSERT INTO rating(ratingText,userId,ratingfrom1_5)
  VALUES('$comment','$userid','$rating')";
  $result=mysqli_query($conn,$insert);
  if($result)
  {
    echo"<h3>Rating added successfully</h3>";
  }
  }
  }
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="css/addrating.css">
      <title>add rating</title>
  </head>
  <body>
  <h1 >add rating</h1>
  <form method="POST">
    <label for="rating">Rate the website from 1-5:</label>
    <input type="number" id="rating" name="rating" min="1" max="5">
    <label for="comment">Add your comments:</label>
    <textarea id="comment" name="comment"></textarea>
    <input type="submit" value="Submit" name="submit">
  </form>
  </body>
  </html>