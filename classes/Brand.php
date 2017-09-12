<?php
include_once '../lib/Database.php';
include_once '../helpers/Format.php'; 
?>

<?php
class Brand{
    
    private $db;
    private $fm;

	public function __construct(){
		$this->db=new Database();
		$this->fm=new Format();
	}

	public function insertBrand($brandName){
		$brandName=$this->fm->validation($brandName);
		$brandName=mysqli_real_escape_string($this->db->conn,$brandName);
		if(empty($brandName)){
			$brandmsg="<span class='danger'>Brand Field must not be empty!</span>";
			return $brandmsg;
		}else{
			$query="INSERT INTO tbl_brand(brandName) VALUES('$brandName')";
			$result=$this->db->insert($query);
			if($result){
				$brandmsg="<span class='danger'>Add Brand Successfully!</span>";
			    return $brandmsg;
			}else{
				$brandmsg="<span class='danger'>Add Brand Failed!</span>";
			    return $brandmsg;
			}
		}
	}

	public function getAllBrand(){
		$query="SELECT * FROM tbl_brand ORDER BY brandId DESC";
		$result=$this->db->select($query);
		return $result;
	}

	public function getBrandById($id){
		$query="SELECT * FROM tbl_brand WHERE brandid='$id'";
		$result=$this->db->select($query);
		return $result;
	}
     

    public function updateBrand($brandName,$id) {
    	$brandName=$this->fm->validation($brandName);
    	$brandName=mysqli_real_escape_string($this->db->conn,$brandName);
    	$id=mysqli_real_escape_string($this->db->conn,$id);
    	if(empty($brandName)){
    		$msg="<span class='danger'>Brand Field must not be empty!</span>";
    		return $msg;
    	}else{
    		$query="UPDATE tbl_brand SET brandName='$brandName' WHERE brandid='$id'";
    		$result=$this->db->update($query);
    		if($result){
                $msg="<span class='success'>Brand Updated Successfully!</span>";
    		    return $msg;
    		}else{
    			$msg="<span class='danger'>Brand Updated Failed!</span>";
    		    return $msg;
    		}
    	}
    }

    public function delBrandById($id){
    	$query="DELETE FROM tbl_brand WHERE brandid='$id'";
    	$result=$this->db->delete($query);
    	if($result){
    		$msg="<span class='success'>Brand Deleted Successfully!</span>";
    		return $msg;
    	}else{
    		$msg="<span class='danger'>Brand Deleted Failed!</span>";
    		return $msg;
    	}
    }

}

?>