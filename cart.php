<?php
session_start();
include('inc/konnect.php');

if (isset($_GET['empty'])){unset($_SESSION['myCart']);}

if (isset($_POST['addcart'])){
	$productID = mysqli_real_escape_string($dbConx,$_POST['addcart']);
	$selectedQty = mysqli_real_escape_string($dbConx,$_POST['qty']);
if(!isset($_SESSION['myCart'])){$_SESSION['myCart']=array();}
//ADD TO Cart
$it_exists = false;
foreach($_SESSION['myCart'] as $eachItem){
	if($eachItem['id']==$productID){
		$eachItem['qty'] = $eachItem['qty']+$selectedQty;
		
		$it_exists = true;
	}
}
if($it_exists==false){array_push($_SESSION['myCart'], array('id'=>$productID,'qty'=>$selectedQty));}
	
	// 
	
	}
	
// print_r($_SESSION['myCart']); exit();
//var_dump($_SESSION['myCart']); exit();

//---------------------------------------
//GET CONTENT OF SHOPPING CHART
if(isset($_SESSION['myCart']) && count($_SESSION['myCart']>0)){
	$cartList = ""; $cartTotal=0;
	$i=1;
	foreach($_SESSION['myCart']as $eachItem){
		$itemID = $eachItem['id'];
		$itemQty = $eachItem['qty'];
		
		$sql="SELECT title,pix,price FROM items WHERE id='$itemID'"; 
		 $query  = mysqli_query($dbConx,$sql) or die(mysqli_error($dbConx));
	 while($row = mysqli_fetch_array($query)){
		 $productTitle = $row[0];
		 $productPix = $row[1];
		 $productPrice = $row[2];
		 $cartList .= '			<tr>
				<td>'.$i++.'</td>
				<th><img src="pictures/'.$productPix.'" height=120px>'.$productTitle.'</th>
				<th>N'.number_format($productPrice).'</th>
				<th>'.$itemQty.'</th>
				<th>N'.number_format($itemQty*$productPrice).'</th>
			</tr>';
			$cartTotal +=($itemQty*$productPrice);
	 }
	}
	
	$_SESSION['cart_total']=$cartTotal;
	 $cartList .='<tr><td colspan=2 cellpadding=3><h3>Total</h3></td><td colspan=3 cellpadding=3><h1>N'.number_format($cartTotal).'</h1></td></tr>';
	$checkOutDiv = '<div style="margin-top:20px">
	<a href="checkout.php" class="btn btn-success btn-lg">CHECKOUT</a>
	<a href="cart.php?empty" class="btn btn-success btn-lg">Empty Cart</a>
	</div>';
}


$similarList='';
$wql="SELECT id,title,pix,price,qty,ref,cat_id FROM items ORDER BY RAND() LIMIT 4"; 
 $wuery = mysqli_query($dbConx,$wql) or die(mysqli_error($dbConx));
 while($row = mysqli_fetch_array($wuery)){
  $sID = $row[0];
  $sTitle = $row[1];
  $sPix = $row[2];
  $sPrice = $row[3];
  $sQty = $row[4];
  $sRef = $row[5];
  

  $similarList .='<div class="col-md-3 top_brand_left" style="margin-bottom:10px">
					<div class="hover14 column">
						<div class="agile_top_brand_left_grid">
							<div class="agile_top_brand_left_grid1">
								<figure>
									<div class="snipcart-item block">
										<div class="snipcart-thumb">
											<a href="details.php?id='.$sID.'"><img title=" " alt=" " src="pictures/'.$sPix.'" height="120px"></a>		
											<p>'.$sTitle.'</p>
											<h4>N'.number_format($sPrice).' <span>'.number_format($sPrice*1.3).'</span></h4>
										</div>
										<div class="snipcart-details top_brand_home_details">
											<form action="cart.php" method="post">
												<fieldset>
												<input type=hidden name="qty" value="1">
												<input type=hidden name="addcart" value="'.$sID.'">
													<input type="submit" name="submit" value="Add to Cart" class="button">
												</fieldset>
											</form>
										</div>
									</div>
								</figure>
							</div>
						</div>
					</div>
				</div>';

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
 <script src='js/okzoom.js'></script>
  <script>
    $(function(){
      $('#example').okzoom({
        width: 150,
        height: 150,
        border: "1px solid black",
        shadow: "0 0 5px #000"
      });
    });
  </script>
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
<?php include('header.php');?>
<!-- products-breadcrumb -->
	<div class="products-breadcrumb">
		<div class="container">
			<ul>
				<li><i class="fa fa-home" aria-hidden="true"></i><a href="home.php">Home</a><span>|</span></li>
				<li>Shopping Cart</li>
			</ul>
		</div>
	</div>
<!-- //products-breadcrumb -->
<!---728x90--->
<!-- banner -->
	<div class="banner">
		<?php include('side.php')?>
		<div class="w3l_banner_nav_right">
<!---728x90--->
		  <?php if(!isset($_SESSION['myCart'])) {?>
	  <div>
	  <h1  align="center"><i class="fa fa-shopping-cart fa-2x"></i><br>Your Cart is Empty :(</h1>
	  </div>
	  <?php } else {?>
	  
	  <div style="width:80%; padding:70px; margin:50px; margin-right:auto; margin-left:auto; background:#FFF">
		<table style="width:100%" style="border: 2px #999 solid" border=1>
		<thead>
			<tr>
				<th>S/N</th>
				<th>Item</th>
				<th>Price</th>
				<th>Quantity</th>
				<th>Total</th>
			</tr>
			<thead>
			<tbody>
			
			</tbody>
			<?php echo $cartList?>
		</table> 
			<?php echo $checkOutDiv?>
	  <?php }?>
		</div>
		
		
		<div class="clearfix"></div>
	</div>
<!-- //banner -->
<!---728x90--->
<!-- brands -->
	<div class="w3ls_w3l_banner_nav_right_grid w3ls_w3l_banner_nav_right_grid_popular">
		<div class="container">
				<div class="w3ls_w3l_banner_nav_right_grid1">
					<?php echo $similarList?>
						<div class="clearfix"> </div>
				</div>
				</div>
	</div>
<!-- //brands -->
<?php include('footer.php')?>
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