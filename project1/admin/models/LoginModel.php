<?php 
trait LoginModel{
	public function modellogin(){
		$email = $_POST['email'];
		$password = $_POST['password'];
		// lấy biến kết nối csdl
		$db = Connection::getInstance();
		$query = $db->prepare("select email from users where email = :_email and password =:_password ");
		$query->execute(["_email"=>$email,"_password"=>$password]);
		if($query->rowCount() > 0){
			// đăng nhập thành công
			$_SESSION['email'] = $email;
			header('location:index.php');
		}else header('location:index.php?controller=login');
		
	}


}

 ?>