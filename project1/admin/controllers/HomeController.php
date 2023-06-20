<?php 

/**
 * 
 */
class HomeController
{
	
		public function __construct()
   	{
   		// kiểm tra user đăng nhập ch
   		if(isset($_SESSION['email']) == false){
   			header('location:index.php?controller=login');
   		}
				
   	}
	public function index(){
		return view::make("HomeView.php");
	}
}
 ?>

