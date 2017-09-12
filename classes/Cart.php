<?php
  $file_path=realpath(dirname(__FILE__));
 include_once ($file_path.'/../lib/Database.php');
 include_once ($file_path.'/../helpers/Format.php');

?>
<?php 

class Cart{
  private $db;
  private $fm;

  public function __construct(){
  	$this->db=new Database();
  	$this->fm=new Format();
  }

  public function addToCart($quantity,$id){
  	$quantity=$this->fm->validation($quantity);
  	$quantity=mysqli_real_escape_string($this->db->conn,$quantity);
  	$productId=mysqli_real_escape_string($this->db->conn,$id);
  	$sId=session_id();//session cua id

  	$squery="SELECT * FROM tbl_product WHERE productId='$productId'";
  	$result=$this->db->select($squery)->fetch_assoc();
  	
  	$productName=$result['productName'];
  	$price=$result['price'];//gia cua san pham trong ban product
  	$image=$result['image'];
    
  	$chquery="SELECT * FROM tbl_cart WHERE productId='$productId' AND sId='$sId'";
  	$result=$this->db->select($chquery);
       if($result){
       	    $msg="Product Aleady Added";
       	    return $msg;
          }else{
             $query="INSERT INTO tbl_cart(sId,productId,productName,price,quantity,image) VALUES('$sId',$productId,'$productName','$price','$quantity','$image')";
               $inserted_row=$this->db->insert($query);
                if($inserted_row){
                	header("Location:cart.php");
                }else{
                	header("Location:404.php");
                }
           }
   }

   public function getCartBysId(){
   	$sId=session_id();
   	$query="SELECT * FROM tbl_cart WHERE sId='$sId' ORDER BY cartId DESC";
   	$result=$this->db->select($query);
   	return $result;
   }

   public function updateToCart($quantity,$cartId){
   	 $quantity=mysqli_real_escape_string($this->db->conn,$quantity);
  	 $cartId=mysqli_real_escape_string($this->db->conn,$cartId);
  	 $query="UPDATE tbl_cart SET 
  	         quantity='$quantity'
  	         WHERE cartId='$cartId'";
  	  $update_row=$this->db->update($query); 
  	  if($update_row){
  	  	$msg="<span class='success'>Quantity Updated Successfully!</span>";
  	  	return $msg;
  	  }else{
  	  	$msg="<span class='success'>Quantity Updated Failed!</span>";
  	  	return $msg;
  	  }    
   }

   public function delProductByCart($delId){
   	   $delId =mysqli_real_escape_string($this->db->conn,$delId);
   	   $query="DELETE FROM tbl_cart WHERE cartId='$delId'";
  	  $delete_row=$this->db->delete($query); 
  	  if($delete_row){
  	  	 echo "<script>window.location='cart.php</script>";
  	  }else{
  	  	$msg="<span class='success'>Product Delete Failed!</span>";
  	  	return $msg;
   }
}

    public function checkCartTable(){
    	$sId=session_id();
    	$query="SELECT * FROM tbl_cart WHERE sId='$sId'";
    	$result=$this->db->select($query);
    	return $result;
    }
}

?>