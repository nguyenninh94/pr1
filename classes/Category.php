<?php
$file_path=realpath(dirname(__FILE__));
include_once ($file_path.'/../lib/Database.php');
include_once ($file_path.'/../helpers/Format.php'); 
?>

<?php
class Category{
	private $db;
	private $fm;

	function __construct(){
       $this->db=new Database();
       $this->fm=new Format();
	}

	public function insertCat($catName){
		$catName=$this->fm->validation($catName);
		$catName=mysqli_real_escape_string($this->db->conn,$catName);
		if(empty($catName)){
			$catmsg="<span class='danger'>Category field must not be empty!</span>";
			return $catmsg;
		}else{
			$query="INSERT INTO tbl_category(catName) VALUES('$catName')";
			$result=$this->db->insert($query);
			if($result){
				if($result->num_rows>0){
					$catmsg="<span class='danger'>This Category Is Exist!</span>";
				    return $catmsg;
				}else{
					$catmsg="<span class='success'>Add Category Successfully!</span>";
					return $catmsg;
				}	
			}else{
                $catmsg="<span class='danger'>Add Category failed!</span>";
                return $catmsg;
			}
		}
	}
    
    //show data base in catlist
	public function getAllCat(){
		$query="SELECT * FROM tbl_category ORDER BY catId DESC";
		$result=$this->db->select($query);
		return $result;
	}
    
    //lay item muon sua qua id
	public function getCatById($id){
		$query="SELECT * FROM tbl_category WHERE catId='$id'";
		$result=$this->db->select($query);
		return $result;
	}


	public function updateCat($catName,$id){
      $catName=$this->fm->validation($catName);
      $catName=mysqli_real_escape_string($this->db->conn,$catName);
      $id=mysqli_real_escape_string($this->db->conn,$id);

      if(empty($catName)){
      	$msg="<span class='danger'>Category field must not be empty!</span>";
      	return $msg;
      }else{
      	$query="UPDATE tbl_category SET catName='$catName' WHERE catId='$id'";
      	$update_row=$this->db->update($query);
      	if($update_row){
      		$msg="<span class='success'>Category Updated Successfully!</span>";
      		return $msg;
      	}else{
      		$msg="<span class='danger'>Category Updated Failed!</span>";
      		return $msg;
      	}
      }
	}

	public function delCatById($id){
		$query="DELETE FROM tbl_category WHERE catId='$id'";
		$result=$this->db->delete($query);
		if($result){
			$msg="<span class='success'>Category Deleted Successfully!</span>";
			return $msg;
		}else{
            $msg="<span class='danger'>Category Deleted Failed!</span>";
			return $msg;
		}
	}
}
?>