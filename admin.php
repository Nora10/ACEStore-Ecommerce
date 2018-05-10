<?php 
include_once('engine/ourClass.php');
$aceClass =  new aceClass();
$dbConx = $aceClass->connectDB();

$status = '';
if(isset($_POST['cat_title'])){
	$cat_title = mysqli_real_escape_string($dbConx,$_POST['cat_title']);
if($cat_title==''){$status='<div class="alert alert-danger"> Pls fill all fields</div>';}
else {
	$sql="INSERT INTO categories (title) VALUES ('$cat_title')";
	$query=mysqli_query($dbConx,$sql)or die (mysqli_error($dbConx));
	$status='<div class="alert alert-success"> Thank you</div>';
}

}

$catList = '';
$query="SELECT id,title FROM categories";
$query = mysqli_query($dbConx,$query)or die(mysqli_error($dbConx));
while($row = mysqli_fetch_array($query)){
	$catID=$row[0];
	$catTitle=$row[1];
	$catList.='<option value="'.$catID.'">'.$catTitle.'</option>';
}



$status2 = '';
if(isset($_POST['title'])){
	$title = mysqli_real_escape_string($dbConx,$_POST['title']);
	$price = mysqli_real_escape_string($dbConx,$_POST['price']);
	$qty = mysqli_real_escape_string($dbConx,$_POST['qty']);
	$info = mysqli_real_escape_string($dbConx,$_POST['info']);
	$cat = mysqli_real_escape_string($dbConx,$_POST['category']);
	$pix = $_FILES['pix'];
		
if($title==''|| $price=='' || $qty=='' || $info=='' || $cat=='' || $pix ==''){$status2='<div class="alert alert-danger"> Pls fill all fields</div>';}
else {
	$fileName = $_FILES['pix']['name'];
	$fileTmpLoc = $_FILES['pix']['tmp_name'];
	$fileType = $_FILES['pix']['type'];
	$fileSize = $_FILES['pix']['size'];
	$fileErrorMessage= $_FILES['pix']['error'];
	$xplode = explode(".",$fileName);
	$fileExt = strtolower(end($xplode));
	$randomName=time().rand(1,10000000).'.'.$fileExt;
	
	$uploadAction = move_uploaded_file($fileTmpLoc,"pictures/$randomName");
	if($uploadAction){
		$ref = 'ACE'.rand(100,9999);
		$wql="INSERT INTO items (title,price,info,qty,ref,pix,cat_id) VALUES ('$title','$price','$info','$qty','$ref','$randomName','$cat')";
	$wuery=mysqli_query($dbConx,$wql)or die (mysqli_error($dbConx));
	if ($wuery){$status2='<div class="alert alert-success">Item  Posted</div>';
	}
	else{$status2='<div class="alert alert-danger">Item NOT Post</div>';}
	
}

}	
}
?>


<!DOCTYPE html>
<html lang="zxx">

<head>
<meta name="author" content="">
<meta name="description" content="">
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin</title>

<!--  favicon -->
<link rel="shortcut icon" href="assets/img/favicon.png">
<!-- FontAwesome CSS -->
<link href="assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<!-- Material Icons CSS -->
<link href="assets/fonts/iconfont/material-icons.css" rel="stylesheet">
<!-- magnific-popup -->
<link href="assets/magnific-popup/magnific-popup.css" rel="stylesheet">
<!-- flexslider -->
<link href="assets/flexSlider/flexslider.css" rel="stylesheet">
<!-- owl.carousel -->
<link href="assets/owl.carousel/assets/owl.carousel.css" rel="stylesheet">
<link href="assets/owl.carousel/assets/owl.theme.default.min.css" rel="stylesheet">
<!-- materialize -->
<link href="assets/materialize/css/materialize.min.css" rel="stylesheet">
<!-- Bootstrap -->
<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!-- Style CSS -->
<link href="assets/css/stylesheet.css" rel="stylesheet">
<!-- Google Font -->
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700,800" rel="stylesheet" type="text/css">
</head>

<body id="top" class="has-header-search">

<!--header start-->


<!-- header ends-->

<!--page title start-->
<section class="utf_page_title utf_page_title-bg fixed-bg overlay dark-3 ptb-50">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="white-text text-medium">Admin</h1>
        
      </div>
    </div>
  </div>
</section>
<!--page title end--> 

<!-- blog section start -->
<section class="utf_blog_section utf_section_padding">
  <div class="container">
    <div class="row">
      
      <div class=" col-md-offset-3 col-md-6">
		  <form method="post" >
			<?php echo $status;?>
			<h2>Category Section</h2>
			<div class="col-md-12"><input type="text" class="form-control" placeholder="Category Title" name="cat_title"></div><br>
			<div class="input-group"><button type="submit" class="form-control btn-primary"><h5>Submit</h5></button></div>
		  </form><br><br>

	<div style="padding:15px; border:1px #666 solid">
        <form method="post" enctype="multipart/form-data">
		<?php echo $status2;?>
		<h2>Item Section</h2>
        <div class="col-md-12"><input type="text" class="form-control" placeholder="Product Title" name="title"></div><br>
        <div class="col-md-6"><input type="price" class="form-control" placeholder="Enter Price" name="price"></div>
        <div class="col-md-6"><input type="qty" class="form-control" placeholder="Enter Quantity" name="qty"></div><br><br>

        <div class="col-md-12"><textarea class="form-control" rows="7" placeholder="Enter Details" name="info"></textarea></div><br><br>
        <div class="col-md-12"><input type="file" class="form-control" name="pix"></div><br><br>
        <div class="col-md-12">
        <select class="form-control" name="category">
        <option value="">Select Category</option>
        <?php echo $catList ?>
        </select>        
        </div><br><br><br>
        <div class="input-group"><button type="submit" class="form-control btn-primary"><h5>Submit</h5></button></div>
        </form>
       </div>
      </div>
    </div>
  </div>
</section>
<!-- blog section end --> 

<!--footer start -->


<!--footer ends-->
<div id="preloader">
  <div class="preloader-position"> <img src="assets/img/preloader.gif" alt="logo"></div>
</div>
<div class="scrollup"><i class="fa-chevron-up topup"></i></div>

<!-- jQuery --> 
<script src="assets/js/jquery-2.1.3.min.js"></script> 
<script src="assets/bootstrap/js/bootstrap.min.js"></script> 
<script src="assets/materialize/js/materialize.min.js"></script> 
<script src="assets/js/menuzord.js"></script> 
<script src="assets/js/bootstrap-tabcollapse.min.js"></script> 
<script src="assets/js/imagesloaded.js"></script> 
<script src="assets/magnific-popup/jquery.magnific-popup.min.js"></script> 
<script src="assets/js/custom_script.js"></script>
</body>

</html>