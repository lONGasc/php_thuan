<?php 
include "models/AccountModel.php";
 ?>

<?php 


class AccountController
{
	
	 use AccountModel;
	 // hiển thị form đăng kí
	 public function register(){
	 	return View::make("RegisterView.php");
	 }
	 // khi submit đăng kí
	 public function registerPost(){
	 	$this->modelRegister();
	 }
	 // hiển thị form login
	 public function login(){
	 	 return View::make("LoginView.php");
	 }
	 // khi submit login
	 public function loginPost(){
	 	$this->modelLogin();
	 }
	 // đăng xuất
	 public function logout(){
	 	$this->modelLogout();
	 }
}
 ?>