<html>
<?php  
	try{            
	$stmt =  new PDO("mysql:host=localhost;dbname=nits", "root", "");
	$stmt->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
			echo $e->getMessage();
			
		}
if ($_SERVER["REQUEST_METHOD"] === "POST"){

	
	$Pword = trim(isset($_POST['word']) ? strtolower($_POST['word']) : null );
	$md = md5(strtolower($Pword));
	
	
	
	$result = $stmt->query("SELECT word FROM enc where word = '$Pword'");
	$result = $result->fetch(PDO::FETCH_ASSOC);

	if($result['word'] == ""){
		$resultt = $stmt->exec("INSERT INTO enc(id,word,encrypted) VALUES(null,'$Pword','$md')");	
		$last_id = $stmt->lastInsertId();
		echo $last_id;
	}
	

} else if ($_GET) {
	$md = trim($_GET['mdd']);
	$result = $stmt->query("SELECT word FROM enc where encrypted = '$md'");
	$result = $result->fetch(PDO::FETCH_ASSOC);
} 

?>


	<head>
	<head>
    <meta charset="UTF-8">
    <!--IE Compatibility modes-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--Mobile first-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>MD5</title>
    
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


        <link rel="stylesheet" href="/assets/lib/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.min.css">
        <link rel="stylesheet" href="/assets/lib/pagedown-bootstrap/css/jquery.pagedown-bootstrap.css">
		
		
		<script>
        less = {
            env: "development",
            relativeUrls: false,
            rootpath: "/assets/"
        };
    </script>
    <link rel="stylesheet" href="assets/css/style-switcher.css">
    <link rel="stylesheet/less" type="text/css" href="assets/less/theme.less">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/less.js/2.7.1/less.js"></script>

	</head>

        <body class="  ">
            <div class="bg-dark dk" id="wrap">
                <div id="top">
                    <!-- .navbar -->
                    <nav class="navbar navbar-inverse navbar-static-top">
                        <div class="container-fluid">
                    
                    
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <header class="navbar-header">
                    
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a href="index.html" class="navbar-brand"><img src="assets/img/logo.png" alt=""></a>
                    
                            </header>
                    
                    
                    
                            <div class="topnav">
                                <div class="btn-group">
                                    <a data-placement="bottom" data-original-title="Fullscreen" data-toggle="tooltip"
                                       class="btn btn-default btn-sm" id="toggleFullScreen">
                                        <i class="glyphicon glyphicon-fullscreen"></i>
                                    </a>
                                </div>
                                <div class="btn-group">
                                    <a data-placement="bottom" data-original-title="E-mail" data-toggle="tooltip"
                                       class="btn btn-default btn-sm">
                                        <i class="fa fa-envelope"></i>
                                        <span class="label label-warning">5</span>
                                    </a>
                                    <a data-placement="bottom" data-original-title="Messages" href="#" data-toggle="tooltip"
                                       class="btn btn-default btn-sm">
                                        <i class="fa fa-comments"></i>
                                        <span class="label label-danger">4</span>
                                    </a>
                                    <a data-toggle="modal" data-original-title="Help" data-placement="bottom"
                                       class="btn btn-default btn-sm"
                                       href="#helpModal">
                                        <i class="fa fa-question"></i>
                                    </a>
                                </div>
                                <div class="btn-group">
                                    <a href="login.html" data-toggle="tooltip" data-original-title="Logout" data-placement="bottom"
                                       class="btn btn-metis-1 btn-sm">
                                        <i class="fa fa-power-off"></i>
                                    </a>
                                </div>
                                <div class="btn-group">
                                    <a data-placement="bottom" data-original-title="Show / Hide Left" data-toggle="tooltip"
                                       class="btn btn-primary btn-sm toggle-left" id="menu-toggle">
                                        <i class="fa fa-bars"></i>
                                    </a>
                                    <a href="#right" data-toggle="onoffcanvas" class="btn btn-default btn-sm" aria-expanded="false">
                                        <span class="fa fa-fw fa-comment"></span>
                                    </a>
                                </div>
                    
                            </div>
                    
                    
                    
                    
                           <div class="collapse navbar-collapse navbar-ex1-collapse">
                    
                                <!-- .nav -->
                                <ul class="nav navbar-nav">
                                    <li class="active"><a href="dashboard.html">Dashboard</a></li>
                                    <!-- <li><a href="table.php">Tables</a></li> -->
                                    
									<li class='dropdown '>
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            Encryption-Decryption <b class="caret"></b>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="md5.php">MD5</a></li>
											   
                                            <li><a href="sha.php">SHA1</a></li>
                                        </ul>
                                    </li>
									
									
									
									
									<li class='dropdown '>
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            Binary Analysis <b class="caret"></b>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="filescan.php">Filescan</a></li>
											   
                                            <li><a href="url.php">URL</a></li>
											
											<li><a href="virus.php">Virus</a></li>
                                        </ul>
                                    </li>
									
									<li class='dropdown '>
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            Encoding-Decoding <b class="caret"></b>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="base64.php">Base64</a></li>
											   
                                            <li><a href="urlende.php">URLende</a></li>
                                        </ul>
                                    </li>
									
                                </ul>
                                <!-- /.nav -->
                            </div>
                        </div>
                        <!-- /.container-fluid -->
                    </nav>
                    <!-- /.navbar -->
                        <header class="head">
                                <div class="search-bar">
                                    <form class="main-search" action="">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Live Search ...">
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary btn-sm text-muted" type="button">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </form>
                                    <!-- /.main-search -->                                </div>
                                <!-- /.search-bar -->
                            <div class="main-bar">
                                <h3>
              <i class="fa fa-home"></i>&nbsp;
            
          </h3>
                            </div>
                            <!-- /.main-bar -->
                        </header>
                        <!-- /.head -->
                </div>
                <!-- /#top -->
                    <div id="left">
                        <div class="media user-media bg-dark dker">
                            <div class="user-media-toggleHover">
                                <span class="fa fa-user"></span>
                            </div>
                            <div class="user-wrapper bg-dark">
                                <a class="user-link" href="">
                                    <img class="media-object img-thumbnail user-img" alt="User Picture" src="assets/img/user.gif">
                                    <span class="label label-danger user-label">16</span>
                                </a>
                        
                                <div class="media-body">
                                    <h5 class="media-heading">Archie</h5>
                                    <ul class="list-unstyled user-info">
                                        <li><a href="">Administrator</a></li>
                                        <li>Last Access : <br>
                                            <small><i class="fa fa-calendar"></i>&nbsp;16 Mar 16:32</small>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- #menu -->
                        <ul id="menu" class="bg-blue dker">
                                  <li class="nav-header">Menu</li>
                                  <li class="nav-divider"></li>
                                  <li class="">
                                    <a href="dashboard.html">
                                      <i class="fa fa-dashboard"></i><span class="link-title">&nbsp;Dashboard</span>
                                    </a>
                                  </li>
                                  
                                    </a>
                                  </li>
                                  <li class="nav-divider"></li>
                                  <li>
                                    <a href="login.html">
                                      <i class="fa fa-sign-in"></i>
                                      <span class="link-title">
                            Login Page
                            </span>
                                    </a>
                                  </li>
                                 
                        <!-- /#menu -->
                    </div>
                    <!-- /#left -->
                <div id="content">
                    <div class="outer">
                        <div class="inner bg-light lter">
						
                 
		
		<title>Enc-Dec | Sha1 </title>
	</head>
<body><br /><br/>
<div class="conrainer">
	<form action="md5.php" method="POST" name="library">
		<div class="">
			<label for="word">Word</label>
			<input type="text" name="word" placeholder="Enter Word.." />
		</div>
		<div class="">
			<button type="submit" class="btn">Check</button>
		</div>
	</form>
</div><br /> 
	<?php 
		if($_POST){

			if($Pword != null || $Pword != ""){			
			echo "MD5 for word ". $Pword. " is   " . $md ;	
			}
		}
	 ?>
 <br /> <br />
<div class="container">
	<!-- For sha1 string -->
	<form action="md5.php" method="GET" name="library">
		<div class="">
			<label for="md5">MD5:</label>
			<input type="text" name="mdd" placeholder="Enter md5" />
		</div>
		<div class="">
			<button type="submit">Check MD5</button>
		</div>
	</form>
</div>

<p>
<?php 
if(isset($_GET['mdd'])){
if($result['word'] == ""){
		echo "No word found";
	} else{
		echo "word for " . $md. " is " . $result['word'];		
	}
}
?>
</p>
</body>
</html>

<!--
if(isset($_GET['mdd'])){
	$md = trim($_GET['mdd']);
	
	} 
	if(isset($_GET['sha1'])){
	$sha1 = trim($_GET['sha1']);
	
	}
	$md = trim($_GET['mdd']);
	-->	
