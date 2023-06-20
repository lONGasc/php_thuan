<?php 

trait AccountModel {
	public function modelRegister(){
		$name = $_POST['name'];
		$email = $_POST['email'];
		$address = $_POST['address'];
		$phone = $_POST['phone'];
		$password = $_POST['password'];
		$conn = Connection::getInstance();
		// kiểm tra email ch tồn tại thì insert bản ghi
		$queryCheck = $conn->prepare("select email from customers where email =:_email ");
		$queryCheck->execute(["_email"=>$email]);
		if($queryCheck->rowCount()>0)
			header("location:index.php?controller=account&action=register&notifi=error");
		else {
			// thêm bản ghi
			$query =$conn->prepare("insert into customers set name =:_name,email=:_email , address =:_address , phone =:_phone ,password =:_password ");
			$query->execute(["_name"=>$name,"_email"=>$email,"_address"=>$address,"_phone"=>$phone,"_password"=>$password]);
			header("location:index.php?controller=account&action=register&notifi=success");
	
		}
	}
	public function modellogin(){
		$email = $_POST['email'];
		$password = $_POST['password'];
		$conn = Connection::getInstance();
		// kiểm tra email ch tồn tại thì insert bản ghi
		$query = $conn->prepare("select * from customers where email =:_email ");
		$query->execute(["_email"=>$email]);
		if($query->rowCount()>0){
			//lấy 1 bản ghi
			$result = $query->fetch(PDO::FETCH_OBJ);
			if($password = $result->password){
				//đăng nhập thành công
				$_SESSION['customer_id'] = $result->id;
				$_SESSION['customer_email'] = $result->email;
				$_SESSION['customer_name'] = $result->name;
				header("location:index.php");
			}

			else {

			header("location:index.php?controller=account&action=login&notify=error");
			}
		}
	}
	public function modellogout(){
		unset($_SESSION['customer_id']);
		unset($_SESSION['customer_email']);
		unset($_SESSION['customer_name']);
		header("location:index.php?controller=account&action=login");

	}
}

 ?>