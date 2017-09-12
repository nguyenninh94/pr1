<?php include 'inc/header.php'; ?>
<!-- xoa cart-->
<?php
 if(isset($_GET['delcart'])){
    $delId=preg_replace('/[^-a-zA-Z0-9_]/', '' , $_GET['delcart']);
    $delCart=$cart->delProductByCart($delId);
      }
?>
 <!-- update cart-->
 <?php
 if($_SERVER['REQUEST_METHOD']=='POST'){
 	$cartId=$_POST['cartId'];
  	$quantity=$_POST['quantity'];
  	$updateCart=$cart->updateToCart($quantity,$cartId);
  	//kiem tra de khong cho nguoi mua nhap so luong < 0
  	if($quantity<=0){
         $delCart=$cart->delProductByCart($cartId);
  	}
  }
  ?>
  <?php
    if(!isset($_GET['id'])){
    	echo "<meta http-equiv='refresh' content='0;URL=?id=live'/>";
    }
  ?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
			    	<span style="color:red;font-size:18px;">
			    	<?php  
                      if(isset($updateCart) ){
                      	echo $updateCart;
                      	}
                      if(isset($delCart)){
                      	echo $delCart;
                      }	
			    	?>
			    	</span>
						<table class="tblone">
							<tr>
								<th width="20%">Number</th>
								<th width="10%">Product Name</th>
								<th width="15%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Money</th>
								<th width="10%">Action</th>
							</tr>
							<?php
                              $getCart=$cart->getCartBysId();
                              if($getCart){
                              	$i=0;
                              	$sum=0;
                              	$quantity=0;
                              	while($result=$getCart->fetch_assoc()){
                                   $i++;
							?>
							<tr>
							    <td><?php echo $i ; ?></td>
								<td><?php echo $result['productName'] ; ?></td>
								<td><img src="admin/<?php echo $result['image']; ?>"  alt=""/></td>
								<td>$ <?php echo $result['price']; ?></td>
								<td>
									<form action="" method="post">
									   <input type="hidden" name="cartId" value="<?php echo $result['cartId'] ; ?>"/>
										<input type="number" name="quantity" value="<?php echo $result['quantity'] ; ?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
 								</td>
								<td> $
									<?php
                                     $total=$result['price'] * $result['quantity'];
                                     echo $total;
									?>
								</td>
								<td><a onclick="return confirm('Are you sure to delete?')" href="?delcart=<?php echo $result['cartId'] ; ?>">X</a></td>
							</tr>
							<?php 
							$sum=$sum + $total; 
							$quantity=$quantity + $result['quantity'];
                            //tinh tong tien trong cart 
                            //Session::set('gTotal', $gTotal);
                            //Session::set('quantity',$quantity);
							?>
							<?php } } ?>
						</table>
						<?php 
                           $getData=$cart->checkCartTable();
                           if($getData){
						 ?>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td>$ <?php echo $sum ; ?></td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>10%</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>$ 
                                   <?php
                                     $vat=$sum * 0.1;
                                     $gTotal=$sum + $vat;
                                     echo $gTotal;

                                     //tinh tong tien trong cart 
                                    Session::set('gTotal', $gTotal);
                                    Session::set('quantity',$quantity);
                                   ?>
								</td>
							</tr>
					   </table>
					<?php }else{
						header("Location:index.php");
                        //echo"<span style='color:green;font-size:18px'>Cart Empty ! Please Shop Now</span>";
					} ?>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="login.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>