
<?php
session_start();
error_reporting(0);
require_once('include/config.php');
$msg = ""; 
if(isset($_POST['submit'])) {
  $email = trim($_POST['email']);
  $password = md5(($_POST['password']));
  if($email != "" && $password != "") {
    try {
      $query = "select id, fname, lname, email, mobile, password, address, create_date from tbluser where email=:email and password=:password";
      $stmt = $dbh->prepare($query);
      $stmt->bindParam('email', $email, PDO::PARAM_STR);
      $stmt->bindValue('password', $password, PDO::PARAM_STR);
      $stmt->execute();
      $count = $stmt->rowCount();
      $row   = $stmt->fetch(PDO::FETCH_ASSOC);
      if($count == 1 && !empty($row)) {
        /******************** Your code ***********************/
        $_SESSION['uid']   = $row['id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['name'] = $row['fname'];
       header("location: index.php");
      } else {
        $msg = "Invalid username and password!";
      }
    } catch (PDOException $e) {
      echo "Error : ".$e->getMessage();
    }
  } else {
    $msg = "Both fields are required!";
  }
}
?>	<!-- 


	- Author Name: MH RONY.
	- GigHub Link: https://github.com/dev-mhrony
	- Facebook Link:https://www.facebook.com/dev.mhrony
	- Youtube Link: <a href = "https://www.youtube.com/@codecampbdofficial"> Code Camp BD</a>
	- for any PHP, Laravel, Python, Dart, Flutter work contact me at developer.mhrony@gmail.com
	- Visit My Website : https://dev-mhrony.com
	 -->
<!DOCTYPE html>
<html lang="zxx">
<head>
	<title>Gym Management System</title>
	<meta charset="UTF-8">
	<!-- Stylesheets -->
	<link rel="stylesheet" href="assets\css\bootstrap.min.css"/>
	<link rel="stylesheet" href="assets\font-awesome\css\fontawesome.min.css"/>
	<link rel="stylesheet" href="assets\css\owl.carousel.min.css"/>
	<link rel="stylesheet" href="assets\css\nice-select.css"/>
	<link rel="stylesheet" href="assets\css\magnific-popup.css"/>
	<link rel="stylesheet" href="assets\css\slicknav.css"/>
	<link rel="stylesheet" href="assets\css\animate.min.css"/>

	<!-- Main Stylesheets -->
	<link rel="stylesheet" href="assets\css\style4.css"/>

</head>
<body>
	<!-- Page Preloder -->
	
	<!-- 


	- Author Name: MH RONY.
	- GigHub Link: https://github.com/dev-mhrony
	- Facebook Link:https://www.facebook.com/dev.mhrony
	- Youtube Link: <a href = "https://www.youtube.com/@codecampbdofficial"> Code Camp BD</a>
	- for any PHP, Laravel, Python, Dart, Flutter work contact me at developer.mhrony@gmail.com
	- Visit My Website : https://dev-mhrony.com
	 -->
	<!-- Header Section -->
	<?php include 'include/header.php';?>
	<!-- Header Section end -->

	                                                                              
	<!-- Page top Section -->
	<section class="page-top-section set-bg" data-setbg="img/page-top-bg.jpg">
		<div class="container">
			<div class="row">
				<div class="col-lg-7 m-auto text-white">
					<h2>Login</h2>
					
				</div>
			</div>
		</div>
	</section>

	<!-- 


	- Author Name: MH RONY.
	- GigHub Link: https://github.com/dev-mhrony
	- Facebook Link:https://www.facebook.com/dev.mhrony
	- Youtube Link: <a href = "https://www.youtube.com/@codecampbdofficial"> Code Camp BD</a>
	- for any PHP, Laravel, Python, Dart, Flutter work contact me at developer.mhrony@gmail.com
	- Visit My Website : https://dev-mhrony.com
	 -->

	<!-- Pricing Section -->
	<section class="pricing-section spad">
		<div class="container">
			
			<div class="row">
				<div class="col-lg-3 col-sm-6">
					
				</div>
				<div class="col-lg-6 col-sm-6">
					<div class="pricing-item entermediate">
						<div class="pi-top">

						</div>
						<div class="pi-price">
							<h3>User</h3>
							<p>Login</p>
						</div>
						 <?php if($error){?><div class="errorWrap" style="color:red;"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap" style="color:red;"><strong>Error</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

						<form class="singup-form contact-form" method="post">
						<div class="row">
							<div class="col-md-12">
								<input type="text" name="email" id="email" placeholder="Your Email" autocomplete="off" required>
							</div>
							<div class="col-md-12">
								<input type="password" name="password" id="password" placeholder="Password" autocomplete="off" required>
							</div>
								<!-- 


	- Author Name: MH RONY.
	- GigHub Link: https://github.com/dev-mhrony
	- Facebook Link:https://www.facebook.com/dev.mhrony
	- Youtube Link: <a href = "https://www.youtube.com/@codecampbdofficial"> Code Camp BD</a>
	- for any PHP, Laravel, Python, Dart, Flutter work contact me at developer.mhrony@gmail.com
	- Visit My Website : https://dev-mhrony.com
	 -->
							
						</div>
						<div class="row">
					<div class="col-md-6">
					<input type="submit" id="submit" name="submit" value="Login" class="site-btn sb-gradient">
					</div>
<div class="col-md-6">
	
<a href="registration.php" class="site-btn sb-gradient">Registration</a>
					</div>
				</div>
	
</form>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					
				</div>
				
			</div>
		</div>
	</section>
		<!-- 


	- Author Name: MH RONY.
	- GigHub Link: https://github.com/dev-mhrony
	- Facebook Link:https://www.facebook.com/dev.mhrony
	- Youtube Link: <a href = "https://www.youtube.com/@codecampbdofficial"> Code Camp BD</a>
	- for any PHP, Laravel, Python, Dart, Flutter work contact me at developer.mhrony@gmail.com
	- Visit My Website : https://dev-mhrony.com
	 -->

	<?php include 'include/footer.php'; ?>
	<!-- Footer Section end -->

	<div class="back-to-top"><img src="img/icons/up-arrow.png" alt=""></div>

	<!-- Search model end -->

	<!--====== Javascripts & Jquery ======-->
	<script src="js/vendor/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.slicknav.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.nice-select.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/main.js"></script>
	<!-- 


	- Author Name: MH RONY.
	- GigHub Link: https://github.com/dev-mhrony
	- Facebook Link:https://www.facebook.com/dev.mhrony
	- Youtube Link: <a href = "https://www.youtube.com/@codecampbdofficial"> Code Camp BD</a>
	- for any PHP, Laravel, Python, Dart, Flutter work contact me at developer.mhrony@gmail.com
	- Visit My Website : https://dev-mhrony.com
	 -->
	</body>
</html>
