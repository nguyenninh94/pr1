<?php
  $file_path=realpath(dirname(__FILE__));
  include_once ($file_path.'/../lib/Database.php');
  include_once ($file_path.'/../helpers/Format.php');
?>
<?php

class Product{
   
   private $db;
   private $fm;

   public function __construct(){
   	$this->db=new Database();
   	$this->fm=new Format();
   }

   public function productInsert($data, $file){
   		$productName=mysqli_real_escape_string($this->db->conn,$data['productName']);
      $catId=mysqli_real_escape_string($this->db->conn,$data['catId']);
      $brandId=mysqli_real_escape_string($this->db->conn,$data['brandId']);
      $body=mysqli_real_escape_string($this->db->conn,$data['body']);
      $price=mysqli_real_escape_string($this->db->conn,$data['price']);
      $type=mysqli_real_escape_string($this->db->conn,$data['type']);
        
        $permited=array('jpg','jepg','png','gif');
        $file_name=$file['image']['name'];
        $file_size=$file['image']['size'];
        $file_temp=$file['image']['tmp_name'];

        $div=explode('.', $file_name);
        $file_ext=strtolower(end($div));
        $unique_image=substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image="uploads/".$unique_image;

        if($productName=="" || $catId=="" || $brandId=="" || $body=="" || $price==""  || $type==""){
          $msg="<span class='danger'>Fields must not be empty!</span>";
          return $msg;
        }elseif($file_size>1048567){
              echo "<span class='danger'>Image Size should be less than 1MB!</span>";
        }elseif(in_array($file_ext,$permited)=== false){
            echo "<span class='danger'>You can upload only:-".implode(', ', $permited)."</span>";
        }else{
          move_uploaded_file($file_temp, $uploaded_image);
          $query="INSERT INTO tbl_product(productName,catId,brandId,body,price,image,type) VALUES('$productName','$catId','$brandId','$body','$price','$productQty',$uploaded_image','$type')";
          $inserted_row=$this->db->insert($query);
          if($inserted_row){
            $msg="<span class='success'>Product Added Successfully!</span>";
        return $msg;
          }else{
            $msg="<span class='danger'>Product Added Failed!</span>";
        return $msg;
          }
        }
        }

   public function getAllProduct(){
   	 $query="SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName     FROM tbl_product
   	          INNER JOIN tbl_category
   	          ON tbl_product.catId=tbl_category.catId
   	          INNER JOIN tbl_brand
   	          ON tbl_product.brandId=tbl_brand.brandid
   	          ORDER bY tbl_product.productId DESC";
   	 $result=$this->db->select($query);
   	 return $result;
   }

   public function getProById($id){
     $query="SELECT * FROM tbl_product WHERE productId='$id'";
     $result=$this->db->select($query);
     return $result;
   }

   public function productUpdate($data,$file,$id){
      $productName=mysqli_real_escape_string($this->db->conn,$data['productName']);
      $catId=mysqli_real_escape_string($this->db->conn,$data['catId']);
      $brandId=mysqli_real_escape_string($this->db->conn,$data['brandId']);
      $body=mysqli_real_escape_string($this->db->conn,$data['body']);
      $price=mysqli_real_escape_string($this->db->conn,$data['price']);
      $type=mysqli_real_escape_string($this->db->conn,$data['type']);
        
        $permited=array('jpg','jepg','png','gif');
        $file_name=$file['image']['name'];
        $file_size=$file['image']['size'];
        $file_temp=$file['image']['tmp_name'];

        $div=explode('.', $file_name);
        $file_ext=strtolower(end($div));
        $unique_image=substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image="uploads/".$unique_image;

        if($productName=="" || $catId=="" || $brandId=="" || $body=="" || $price==""  || $type==""){
          $msg="<span class='danger'>Fields must not be empty!</span>";
          return $msg;
        }else{
           if(!empty($file_name)){
               if($file_size>1048567){
                    echo "<span class='danger'>Image Size should be less than 1MB!</span>";
                }elseif(in_array($file_ext,$permited)=== false){
                    echo "<span class='danger'>You can upload only:-".implode(', ', $permited)."</span>";
                }else{
                   move_uploaded_file($file_temp, $uploaded_image);
                   $query="UPDATE tbl_product SET 
                         productName='$productName',
                         catId='$catId',
                         brandId='$brandId',
                         body='$body',
                         price='$price',
                         image='$uploaded_image',
                         type='$type'
                        WHERE productId='$id' ";
                       $update_row=$this->db->update($query);
                   if($update_row){
                         $msg="<span class='success'>Product Updated Successfully!</span>";
                         return $msg;
                   }else{
                          $msg="<span class='danger'>Product Updated Failed!</span>";
                          return $msg;
                    }
                }
            }else{
                  move_uploaded_file($file_temp, $uploaded_image);
                   $query="UPDATE tbl_product SET 
                         productName='$productName',
                         catId='$catId',
                         brandId='$brandId',
                         body='$body',
                         price='$price',
                         type='$type'
                        WHERE productId='$id' ";
                       $update_row=$this->db->update($query);
                   if($update_row){
                         $msg="<span class='success'>Product Updated Successfully!</span>";
                         return $msg;
                   }else{
                          $msg="<span class='danger'>Product Updated Failed!</span>";
                          return $msg;
                    }
            }
       } 
    }

    public function delProductById($id){
      //xoa anh trong thu muc upload
       $query="SELECT * FROM tbl_product WHERE productId='$id'";
       $result=$this->db->select($query);
       if($result){
        while($delImg=$result->fetch_assoc()){
          $dellink=$delImg['image'];
          unlink($dellink);
        }
       }

       $delquery="DELETE FROM tbl_product WHERE productId='$id' ";
        $deldata=$this->db->delete($delquery);
         if($deldata){
             $msg="<span class='success'>Product Deleted Successfully!</span>";
            return $msg;
         }else{
             $msg="<span class='danger'>Product Deleted Failed!</span>";
             return $msg;
      }
    }

    public function getFeaturedProduct(){
        $query="SELECT * FROM tbl_product WHERE type='0' ORDER BY productId DESC LIMIT 4";
        $result=$this->db->select($query);
        return $result;
    }

    public function getNewProduct(){
      $query="SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 4";
      $result=$this->db->select($query);
      return $result;
    }

    public function getDetailProduct($id){
      $query="SELECT p.*, c.catName, b.brandName
              FROM tbl_product as p, tbl_category as c, tbl_brand as b WHERE p.catId=c.catId AND p.brandId=b.brandid AND p.productId='$id'";
      $result=$this->db->select($query);
      return $result;        
    }

    public function latestFromIphone(){
      $query="SELECT p.*, b.brandName FROM tbl_product as p, tbl_brand as b WHERE p.brandId=b.brandid AND p.brandId='3' ORDER BY productId DESC LIMIT 1";
      $result=$this->db->select($query);
      return $result;
    }

    public function latestFromSamsung(){
      $query="SELECT p.*, b.brandName FROM tbl_product as p, tbl_brand as b WHERE p.brandId=b.brandid AND p.brandId='2' ORDER BY productId DESC LIMIT 1";
      $result=$this->db->select($query);
      return $result;
    }

    public function latestFromAcer(){
      $query="SELECT p.*, b.brandName FROM tbl_product as p, tbl_brand as b WHERE p.brandId=b.brandid AND p.brandId='1' ORDER BY productId DESC LIMIT 1";
      $result=$this->db->select($query);
      return $result;
    }

    public function latestFromCanon(){
      $query="SELECT p.*, b.brandName FROM tbl_product as p, tbl_brand as b WHERE p.brandId=b.brandid AND p.brandId='5' ORDER BY productId DESC LIMIT 1";
      $result=$this->db->select($query);
      return $result;
    }


}
?>