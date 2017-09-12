<?php
 class Session{

 	public static function init(){
 		session_start();
 	}
    
    //luu mang session
 	public static function set($key, $val){
 		$_SESSION[$key] = $val;
 	}
    
    //echo mang session
 	public static function get($key){
 		if(isset($_SESSION[$key])){
 			return $_SESSION[$key];
 		}else{
 			return false;
 		}
 	}
    
    //kiem tra xem cos ton tai session khong
 	public static function checkSession(){
        self::init();
        if(self::get("adminlogin")==false){
           //self::destroy();
           header("Location:login.php");
        }
 	}

    //kiem tra xem da dang nhap chua
 	public static function checkLogin(){
 		self::init();
 		if(self::get("adminlogin")==true){
 			header("Location:dashboard.php");
 		}
 	}
    
    //huy session
 	public static function destroy(){
 		session_destroy();
 		header("Location:../index.php");
 	}
 }
?>