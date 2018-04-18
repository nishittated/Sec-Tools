<?php

$servername="localhost";
$username="root";
$password="";
$dbname = "nits";
/*
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);

}
*/

if($_SERVER['REQUEST_METHOD'] === "POST"){
try{
$con = new PDO('mysql:host=localhost;dbname=nits',$username,$password);
} catch (PDOException $e){
	echo $e -> getMessage();
	die();
}


					$msg = '';            
            if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
				
                $username = $_POST['username'];
				$password = $_POST['password'];
				
				$result = $con -> prepare("SELECT * FROM login WHERE Username='" .$username . "' AND Password='".$password ."'");
				$result ->execute();
				$result = $result -> fetchAll(PDO::FETCH_ASSOC); 
				
				
				if($result ){
					$_SESSION['valid'] = true;
                  $_SESSION['timeout'] = time();
                  $_SESSION['username'] = $result["Username"];
					
					Header('Location:dashboard.html');
				} else {
					
					echo 'error';
					die();
				}
			   
			   
			     
            }
			
			if(isset($_POST['signup']) && !empty($_POST['susername']) &&!empty($_POST['spass'])){
				$username = $_POST['susername'];
				$password = $_POST['spass'];
				$email = $_POST['semail'];
				$result = $con->exec("INSERT INTO login VALUES('$username','$password','$email')");
				//$result->execute();
				//$result = $result ->fetch();
			
				
			}
			
			if(isset($_POST['fsubmit']) && !empty($_POST['femail'])){
				$email = $_POST['femail'];
				
				$sth = $con->query("SELECT * FROM login WHERE email ='".$email."'");
				$sth = $sth ->fetchAll(PDO::FETCH_ASSOC);
				
				var_dump($sth);
				die();
				$fpassword = $sth['Password'];
				
				
			}
			
}
         ?>
	




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!--IE Compatibility modes-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--Mobile first-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Login Page</title>
    
    <meta name="description" content="Free Admin Template Based On Twitter Bootstrap 3.x">
    <meta name="author" content="">
    
    <meta name="msapplication-TileColor" content="#5bc0de" />
    <meta name="msapplication-TileImage" content="assets/img/metis-tile.png" />
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/lib/bootstrap/css/bootstrap.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/lib/font-awesome/css/font-awesome.css">
    
    <!-- Metis core stylesheet -->
    <link rel="stylesheet" href="assets/css/main.css">
    
    <!-- metisMenu stylesheet -->
    <link rel="stylesheet" href="assets/lib/metismenu/metisMenu.css">
    
    <!-- onoffcanvas stylesheet -->
    <link rel="stylesheet" href="assets/lib/onoffcanvas/onoffcanvas.css">
    
    <!-- animate.css stylesheet -->
    <link rel="stylesheet" href="assets/lib/animate.css/animate.css">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="login">

      <div class="form-signin">
    <div class="text-center">
        <img src="assets/img/Logo.png" >
    </div>
    <hr>
    <div class="tab-content">
        <div id="login" class="tab-pane active">
			
            <form action="login.php" method="POST">
                <p class="text-muted text-center">
                    Enter your username and password
                </p>
				<p>
					<?php if(isset($fpassword)){
						echo $fpassword;
					} ?>
				</p>
                <input type="text" placeholder="username" name="username" class="form-control top">
                <input type="password" placeholder="password" name="password" class="form-control bottom">
                <div class="checkbox">
		  <label>
		    <input type="checkbox"> Remember Me
		  </label>
		</div>
                <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Sign in</button>
            </form>
        </div>
        <div id="forgot" class="tab-pane">
            <form action="login.php" method="POST">
                <p class="text-muted text-center">Enter your valid e-mail</p>
                <input type="email" name="femail" placeholder="mail@domain.com" class="form-control">
                <br>
                <button class="btn btn-lg btn-danger btn-block" name="fsubmit" type="submit">Recover Password</button>
            </form>
        </div>
        <div id="signup" class="tab-pane">
            <form action="login.php" name="signup" method="POST">
                <input type="text" placeholder="username" name="susername" class="form-control top">
                <input type="email" placeholder="mail@domain.com" name="semail" class="form-control middle">
                <input type="password" placeholder="password" name="spass" class="form-control middle">
                <input type="password" placeholder="re-password" name="srepass" class="form-control bottom">
                <button class="btn btn-lg btn-success btn-block" type="submit" name="signup">Register</button>
            </form>
        </div>
    </div>
    <hr>
    <div class="text-center">
        <ul class="list-inline">
            <li><a class="text-muted" href="#login" data-toggle="tab">Login</a></li>
            <li><a class="text-muted" href="#forgot" data-toggle="tab">Forgot Password</a></li>
            <li><a class="text-muted" href="#signup" data-toggle="tab">Signup</a></li>
        </ul>
    </div>
  </div>


    <!--jQuery -->
    <script src="assets/lib/jquery/jquery.js"></script>

    <!--Bootstrap -->
    <script src="assets/lib/bootstrap/js/bootstrap.js"></script>


    <script type="text/javascript">
        (function($) {
            $(document).ready(function() {
                $('.list-inline li > a').click(function() {
                    var activeForm = $(this).attr('href') + ' > form';
                    //console.log(activeForm);
                    $(activeForm).addClass('animated fadeIn');
                    //set timer to 1 seconds, after that, unload the animate animation
                    setTimeout(function() {
                        $(activeForm).removeClass('animated fadeIn');
                    }, 1000);
                });
            });
        })(jQuery);
    </script>
	
	
</body>
</html>
