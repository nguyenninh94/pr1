<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php'; ?>
<?php
 if(!isset($_GET['brandid']) || $_GET['brandid']==NULL){
 	echo "<script>window.location='brandlist.php'</script>";
 }else{
 	$id=preg_replace('/[^-a-zA-Z0-9_]/', '' , $_GET['brandid']);
 }

 $brand=new Brand();
 if($_SERVER['REQUEST_METHOD']=='POST'){
 	$brandName=$_POST['brandName'];
 	$brandUpdate=$brand->updateBrand($brandName,$id);
 }
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Brand</h2>
               <div class="block copyblock">
               <span style="color:green;font-size:18px;">
                 <?php
                   if(isset($brandUpdate)){
                   	echo $brandUpdate;
                   }  
                 ?>
               </span>
                <?php
                  $getbrand=$brand->getBrandById($id);
                  if($getbrand){
                  	while($result=$getbrand->fetch_assoc()){

                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="brandName" value="<?php echo $result['brandName']; ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php
                    }
                    }
                    ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>