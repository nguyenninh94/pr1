<?php
$file_path = realpath(dirname(__FILE__));
 include_once ($file_path.'/../lib/Database.php');
  include_once ($file_path.'/../helpers/Format.php');

?>
<?php 

class User{
  private $db;
  private $fm;

  public function __construct(){
  	$this->db=new Database();
  	$this->fm=new Format();
  }

  public function insertUser($userName,$city, $zipcode,$email,$address,$country,$phone,$password){
      $username=$this->fm->validation($userName);
      $city=$this->fm->validation($city);
      $zipcode=$this->fm->validation($zipcode);
      $email=$this->fm->validation($email);
      $address=$this->fm->validation($address);
      $country=$this->fm->validation($country);
      $phone=$this->fm->validation($phone);
      $password=$this->fm->validation($password);

      $username=mysqli_real_escape_string($this->db->conn,$userName);
      $city=mysqli_real_escape_string($this->db->conn,$city);
      $zipcode=mysqli_real_escape_string($this->db->conn,$zipcode);
      $email=mysqli_real_escape_string($this->db->conn,$email);
      $address=mysqli_real_escape_string($this->db->conn,$address);
      $country=mysqli_real_escape_string($this->db->conn,$country);
      $phone=mysqli_real_escape_string($this->db->conn,$phone);
      $password=mysqli_real_escape_string($this->db->conn,$password);

      if(empty($username) || empty($city) || empty($zipcode) || empty($email) || empty($address) || empty($country) || empty($phone) || empty($password)){
      	$msg="<span class='danger'>User field must not be empty!</span>";
      	return $msg;
      }else{
      	$query="INSERT INTO tbl_user(username,password,email,phone,address,zip-code,city,country) VALUES('$username','$password','$email','$phone','$address','$zipcode','$city','$country')";
      	$result=$this->db->insert($query);
      	if($result){
      		if($result->num_rows>0){
      			$msg="<span class='danger'>This Username Is Exist!</span>";
      			return $msg;
      		}else{
      			$msg="<span class='success'>Register Successfully!</span>";
      			header("Location:index.php");
				return $msg;
      		}
      	}else{
      		$msg="<span class='success'>Register Failed !</span>";
			return $msg;
      	}
      }
  }

}

?>