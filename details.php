<?php include 'inc/header.php'; ?>

<?php
//lay id chi tiet san pham
  if(!isset($_GET['proid']) || $_GET['proid']==NULL){
  	echo "<script>window.location='404.php';</script>";
  }else{
    $id=preg_replace('/[^-a-zA-Z0-9_]/', '' , $_GET['proid']);
  }

//them sp vao cart
  if($_SERVER['REQUEST_METHOD']=='POST'){
  	$quantity=$_POST['quantity'];
  	$addCart=$cart->addToCart($quantity,$id);
  }

?>
 <div class="main">
    <div class="content">
    	<div class="section group">
			<div class="cont-desc span_1_of_2">	
			<?php
               $getPd=$product->getDetailProduct($id);
               if($getPd){
               	while($result=$getPd->fetch_assoc()){

			?>		
					<div class="grid images_3_of_2">
						<img src="admin/<?php echo $result['image'] ; ?> " width="200px" alt="" />
					</div>
				<div class="desc span_3_of_2">
				    <h2 style="font-size:22px;"><?php echo $result['productName'] ; ?></h2>
					<div class="price">
						<p style="font-size:16px;">Price: <span>$ <?php echo $result['price'] ; ?></span></p>
						<p style="font-size:16px;">Category: <span><?php echo $result['catName'] ; ?></span></p>
						<p style="font-size:16px;">Brand:<span><?php echo $result['brandName'] ; ?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="number" name="quantity" value="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
					</form>				
				</div>
                <span style="color:red;font-size:18px;">
                	<?php
                       if(isset($addCart)){
                       	echo $addCart;
                       }
                	?>
                </span>

			</div>
			<div class="product-desc">
			<h2>Product Details</h2>
			<p><?php echo $result['body'] ; ?></p>
	    </div>	
	    <?php  } } ?>		
	</div>
	         
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					 <?php 
                     $getCat=$cat->getAllCat();
                     if($getCat){
                	    while($result=$getCat->fetch_assoc()){

	                 ?>
					  <ul>
				        <li><a href="productbycat.php"><?php echo $result['catName']; ?></a></li>
				      <?php } } ?>  
    				  </ul>
 				</div>

 		</div>
 	</div>
	</div>
   <?php include 'inc/footer.php'; ?>