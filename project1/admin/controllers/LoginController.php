<?php 

include "models/LoginModel.php";
 ?>
 <?php 
/**
 * 
 */
class LoginController
{

	use LoginModel;
	public function index(){
		return view::make("LoginView.php");
	}
	public function login(){
		// goji hàm modellogin trong class LoginModel
		$this->modellogin();

	}
	public function logout(){
		// hủy biến session
		unset($_SESSION['email']);
		// di chuyển đén url khác
		header('location:index.php');
	}
		
}

  ?>
 