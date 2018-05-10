<?php
session_start();
include_once('inc/konnect.php');
$status='';	

if(isset($_GET['completed'])){unset($_SESSION['myCart']);unset($_SESSION['cart_total']);} 

if(isset($_SESSION['memberemail']) && isset($_SESSION['memberid']) && isset($_SESSION['memberpassword'])){
$memberID = $_SESSION['memberid'];
$memberEmail = $_SESSION['memberemail'];
$memberPassword = $_SESSION['memberpassword'];

	$sql= "SELECT fullname FROM members WHERE email='$memberEmail' AND pass1='$memberPassword' AND id='$memberID' LIMIT 1"; 
		$query=mysqli_query($dbConx, $sql) or die(mysqli_error($dbConx));
			while($row = mysqli_fetch_array($query)){
			$memberFullname = $row[0];
			}
  
}else{header('location: login.php');exit();}


if(isset($_POST['fullname'])){
	$fullname = mysqli_real_escape_string($dbConx,$_POST['fullname']);//for security to avoid hackers inserting msql injections....waka
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
	$username = mysqli_real_escape_string($dbConx,$_POST['username']);//for security to avoid hackers inserting msql injections....waka
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
  //CREATE session that shows thAT YOU ARE A REGISTERED MEMBER OF EXAM TUSKY
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

<?php include_once('header.php');?>
<!-- products-breadcrumb -->
	<div class="products-breadcrumb">
		<div class="container">
			<ul>
				<li><i class="fa fa-home" aria-hidden="true"></i><a href="home">Home</a><span>|</span></li>
				<li>Checkout</li>
			</ul>
		</div>
	</div>
<!-- //products-breadcrumb -->
<!---728x90--->
<!-- banner -->
	<div class="banner">
		<?php include('side.php');?>
		<div class="w3l_banner_nav_right">
<!-- login -->
		<div class="w3_login">
			<h3>Checkout!</h3>
<!---728x90--->
			<div class="w3_login_module">
				<div class="module form-module">
				<div class="toggle">
				  </div>
				  
				  <?php if(!isset($_SESSION['myCart']) || count($_SESSION['myCart'])<1) {?>
				  <div class="form">
				  
					<h2>Hi <?php echo $memberFullname;?> <a href="logout.php" class="btn btn-warning btn-sm pull-right">Logout</a></h2>
					<h1 align="center"><i class="fa fa-shopping-cart"></i></h1>
					 <p style="margin:10px"> <input type="submit" onclick="payNow()" value="Checkout Complete"></p>
				  </div>
				  <?php } else {?>
				  <div class="form">
					<h2>Hi <?php echo $memberFullname;?> <a href="logout.php" class="btn btn-warning btn-sm pull-right">Logout</a></h2>
					<h1 align="center"><small>Total</small><br> <?php echo $_SESSION['cart_total']?></h1>
					 <p style="margin:10px"> <input type="submit" onclick="payNow()" value="Pay Now"></p>
					 <p style="margin:10px"> <a href="home.php" class="btn btn-warning">Continue Shopping</a></p>
				  </div>
				  <?php }?>
				  <div class="cta"><a href="cart.php"><i class="fa fa-shopping-cart"></i> Back to Cart</a></div>
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
<?php include_once('footer.php');?>
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
<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
  function payNow(){
    var handler = PaystackPop.setup({
      key: 'pk_test_77848e5d09c29a5a2a77a7601fb4141be19671eb',
      email: '<?php echo $memberEmail;?>',
      amount: <?php echo $_SESSION['cart_total']*100?>,
      ref: ''+Math.floor((Math.random() * 1000000000) + 1),
      metadata: {
         custom_fields: [
            {
                display_name: "Mobile Number",
                variable_name: " <?php echo $memberFullname?>",
                value: " <?php echo $memberFullname?>"
            }
         ]
      },
      callback: function(response){
          alert('Payment Successful.\n transaction ref is ' + response.reference);
		  window.location.href='checkout.php?completed';
      },
      onClose: function(){
          alert('payment ended');
      }
    });
    handler.openIframe();
  }
</script>
</body>

</html>