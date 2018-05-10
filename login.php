<?php
include_once('inc/konnect.php');
$status='';	

if(isset($_POST['fullname'])){
	$fullname = mysqli_real_escape_string($dbConx,$_POST['fullname']);//for security to avoid hackers inserting msql injections
	$email = mysqli_real_escape_string($dbConx,$_POST['email']);
	$pass1 = mysqli_real_escape_string($dbConx,$_POST['pass1']);
	$phone = mysqli_real_escape_string($dbConx,$_POST['phone']);
	
	if($fullname==''||$email==''||$pass1==''||$phone==''){$status = '<div class="alert alert-danger">Fill all fields</div>';}
	//else if($pass1!=$pass2){$status = '<div class="alert alert-danger">Passwords dont match</div>';}
	else{
		$hashPassword = md5($pass1);
	$sql = "INSERT INTO members (fullname,email,pass1,phone,reg_date) VALUES ('$fullname','$email','$hashPassword','$phone',now())";
	$query = mysqli_query($dbConx,$sql) or die(mysqli_error($dbConx));
	if($query){$status = '<div class="alert alert-success ">Great! Registration Successful! Go to Login</div>';}else {$status = '<div class="alert alert-warning ">There was an error!</div>';}
		}
	}

	
	
	
if(isset($_POST['username'])){
	$username = mysqli_real_escape_string($dbConx,$_POST['username']);//for security to avoid hackers inserting msql injections
	$password = mysqli_real_escape_string($dbConx,$_POST['password']);
	
	if($username==''||$password==''){$status = '<div class="alert alert-danger">Fill all fields</div>';}
	else{
		$hpassword= md5($password);
		$sql= "SELECT id,email,pass1 FROM members WHERE email='$username' AND pass1='$hpassword' LIMIT 1"; 
		$query=mysqli_query($dbConx, $sql) or die(mysqli_error($dbConx));
		if(mysqli_num_rows($query)<1){$status = '<div class="alert alert-danger ">Invalid login details</div>';}
		else{
			while($row = mysqli_fetch_array($query)){
  $memberid = $row[0];
  $memberemail= $row[1];
  $memberpassword = $row[2];
  //CREATE session that shows thAT YOU ARE A REGISTERED MEMBER OF E-COMMERCE site
  session_start();
  $_SESSION['memberid'] = $memberid;
  $_SESSION['memberemail'] = $memberemail;
  $_SESSION['memberpassword'] = $memberpassword;
  header('location:checkout.php'); exit();
 
  }
		}
		
	}
	}
?>

<!DOCTYPE html>
<html>

<head>
<title>ACE CHARITY E-COMMERCE WEBSITE</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet" type="text/css" media="all" /> 
<!-- //font-awesome icons -->
<!-- js -->
<script src="js/jquery-1.11.1.min.js"></script>
<!-- //js -->
<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->
</head>
	
<body>

	<div class="agileits_header">
		
		<div class="product_list_header">  
			<form action="#" method="post" class="last">
                <fieldset>
                    <input type="hidden" name="cmd" value="_cart" />
                    <input type="hidden" name="display" value="1" />
                    <input type="submit" name="submit" value="View your cart" class="button" />
                </fieldset>
            </form>
		</div>
		<div class="w3l_header_right">
			<ul>
				<li class="dropdown profile_details_drop">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user" aria-hidden="true"></i><span class="caret"></span></a>
					<div class="mega-dropdown-menu">
						<div class="w3ls_vegetables">
							<ul class="dropdown-menu drp-mnu">
								<li><a href="login.php">Login</a></li> 
								<li><a href="login.php">Sign Up</a></li>
							</ul>
						</div>                  
					</div>	
				</li>
			</ul>
		</div>
		<div class="w3l_header_right1">
			<h2><a href="mail.php">Contact Us</a></h2>
		</div>
		<div class="clearfix"> </div>
	</div>
<!-- script-for sticky-nav -->
	<script>
	$(document).ready(function() {
		 var navoffeset=$(".agileits_header").offset().top;
		 $(window).scroll(function(){
			var scrollpos=$(window).scrollTop(); 
			if(scrollpos >=navoffeset){
				$(".agileits_header").addClass("fixed");
			}else{
				$(".agileits_header").removeClass("fixed");
			}
		 });
		 
	});
	</script>
<!-- //script-for sticky-nav -->
	<div class="logo_products">
		<div class="container">
			<div class="w3ls_logo_products_left">
				<h1><a href="home.php"><span>ACE</span> STORE</a></h1>
			</div>
			<div class="w3ls_logo_products_left1">
				<ul class="special_items">
					
					<li><a href="about.php">About Us</a><i>/</i></li>
					<li><a href="products.php">Best Deals</a><i>/</i></li>
					<li><a href="services.php">Services</a></li>
				</ul>
			</div>
			<div class="w3ls_logo_products_left1">
				<ul class="phone_email">
					<li><i class="fa fa-phone" aria-hidden="true"></i>+2348096555710</li>
					<li><i class="fa fa-envelope-o" aria-hidden="true"></i><a href="mailto:info@acecharityafrica.org">info@acecharityafrica.org</a></li>
				</ul>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
<!-- //header -->
<!-- products-breadcrumb -->
	<div class="products-breadcrumb">
		<div class="container">
			<ul>
				<li><i class="fa fa-home" aria-hidden="true"></i><a href="home.php">Home</a><span>|</span></li>
				<li>Sign In & Sign Up</li>
			</ul>
		</div>
	</div>
<!-- //products-breadcrumb -->
<!---728x90--->
<!-- banner -->
	<div class="banner">
		<div class="w3l_banner_nav_left">
			<nav class="navbar nav_bottom">
			 <!-- Brand and toggle get grouped for better mobile display -->
			  <div class="navbar-header nav_2">
				  <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
			   </div> 
			   <!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
					<ul class="nav navbar-nav nav_1">
						
						<li><a href="household.php">Households</a></li>
						<li class="dropdown mega-dropdown active">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Veggies & Fruits<span class="caret"></span></a>				
							<div class="dropdown-menu mega-dropdown-menu w3ls_vegetables_menu">
								<div class="w3ls_vegetables">
									<ul>	
										<li><a href="vegetables.php">Vegetables</a></li>
										<li><a href="vegetables.php">Fruits</a></li>
									</ul>
								</div>                  
							</div>				
						</li>
						<li><a href="kitchen.php">Kitchen</a></li>
						
						
						
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Frozen Foods<span class="caret"></span></a>
							<div class="dropdown-menu mega-dropdown-menu w3ls_vegetables_menu">
								<div class="w3ls_vegetables">
									<ul>
										<li><a href="frozen.php">Frozen Snacks</a></li>
										<li><a href="frozen.php">Frozen Nonveg</a></li>
									</ul>
								</div>                  
							</div>	
						</li>
						<li><a href="bread.php">Bread & Bakery</a></li>
					</ul>
				 </div><!-- /.navbar-collapse -->
			</nav>
		</div>
		<div class="w3l_banner_nav_right">
<!-- login -->
		<div class="w3_login">
			<h3>Sign In & Sign Up</h3>
<!---728x90--->
			<div class="w3_login_module">
				<div class="module form-module">
				  <div class="toggle"><i class="fa fa-times fa-pencil"></i>
					<div class="tooltip">Click Me</div>
				  </div>
				  
				  <div class="form">
				  
					<h2>Login to your account</h2>
					<?php echo $status;?>
					<form action="#" method="post">
					  <input type="text" name="username" placeholder="Username" required=" ">
					  <input type="password" name="password" placeholder="Password" required=" ">
					  <input type="submit" value="Login">
					</form>
				  </div>
				  <div class="form">
					<h2>Create an account</h2>
					<?php echo $status?>
					<form action="#" method="post">
					  <input type="text" name="fullname" placeholder="Username" required=" ">
					  <input type="password" name="pass1" placeholder="Password" required=" ">
					  <input type="email" name="email" placeholder="Email Address" required=" ">
					  <input type="text" name="phone" placeholder="Phone Number" required=" ">
					  <input type="submit" value="Register">
					</form>
				  </div>
				  <div class="cta"><a href="#">Forgot your password?</a></div>
				</div>
			</div>
			<script>
				$('.toggle').click(function(){
				  // Switches the Icon
				  $(this).children('i').toggleClass('fa-pencil');
				  // Switches the forms  
				  $('.form').animate({
					height: "toggle",
					'padding-top': 'toggle',
					'padding-bottom': 'toggle',
					opacity: "toggle"
				  }, "slow");
				});
			</script>
		</div>
<!-- //login -->
		</div>
		<div class="clearfix"></div>
	</div>
<!-- //banner -->
<!---728x90--->
<!-- newsletter-top-serv-btm -->
	<div class="newsletter-top-serv-btm">
		<div class="container">
			<div class="col-md-4 wthree_news_top_serv_btm_grid">
				<div class="wthree_news_top_serv_btm_grid_icon">
					<i class="fa fa-shopping-cart" aria-hidden="true"></i>
				</div>
				<h3>Shopping info of the week</h3>
				<p>Healthy foodstuff and items at affordable prices.</p>
			</div>
			<div class="col-md-4 wthree_news_top_serv_btm_grid">
				<div class="wthree_news_top_serv_btm_grid_icon">
					<i class="fa fa-bar-chart" aria-hidden="true"></i>
				</div>
				<h3>Statistics</h3>
				<p>Most Busy hours and most purchased items.</p>
			</div>
			<div class="col-md-4 wthree_news_top_serv_btm_grid">
				<div class="wthree_news_top_serv_btm_grid_icon">
					<i class="fa fa-truck" aria-hidden="true"></i>
				</div>
				<h3>Delivery</h3>
				<p>Want your item delivered to you ? We do express delivery nationwide!</p>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
<!-- //newsletter-top-serv-btm -->
<?php include_once('footer.php')?>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
            $(this).toggleClass('open');       
        }
    );
});
</script>
<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
<!-- //here ends scrolling icon -->
<script src="js/minicart.min.js"></script>
<script>
	// Mini Cart
	paypal.minicart.render({
		action: '#'
	});

	if (~window.location.search.indexOf('reset=true')) {
		paypal.minicart.reset();
	}
</script>
</body>

</html>