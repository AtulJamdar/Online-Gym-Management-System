<?php

include 'config1.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login1.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login1.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="assets\css\style3.css">

</head>
<body>
   
<div class="container">

   <div class="profile">
      <?php
         $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }
         if($fetch['image'] == ''){
            echo '<img src="images/default-avatar.png">';
         }else{
            echo '<img src="uploaded_img/'.$fetch['image'].'">';
         }
      ?>
      <h3><?php echo $fetch['name']; ?></h3>
      <a href="update_profile1.php" class="btn">update profile</a>
      <a href="BMI_Cal.html" class="btn">Calculate Your BMI</a>
      <a href="home1.php?logout=<?php echo $user_id; ?>" class="delete-btn">logout</a>
      <p>new <a href="login1.php">login</a> or <a href="register1.php">register</a></p>
   </div>

</div>

</body>
</html>