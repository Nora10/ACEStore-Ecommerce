<?php
include_once('inc/konnect.php');

$categoryList='';
$sql="SELECT id,title FROM categories"; 
 $query = mysqli_query($dbConx,$sql) or die(mysqli_error($dbConx));
 while($row = mysqli_fetch_array($query)){
  $catID = $row[0];
  $catTitle = $row[1];

   $categoryList .='<li><a href="products.php?cat='.$catID.'">'.$catTitle.'</a></li>';
  }
?>

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
<?php echo $categoryList?>
</ul>					
				</div><!-- /.navbar-collapse -->
			</nav>
		</div>
		