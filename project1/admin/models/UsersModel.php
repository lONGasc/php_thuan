<?php 
/*
1			tin tức 1
2			tin tức 2
3			tin tức 3
4			tin tức 4
5			tin tức 5
6			tin tức 6
7			tin tức 7
index.php?controller=users 
-> lấy biến p truyền từ url, nếu url k có biến p thì mặc định bằng 0
							- nếu biến p có trên url thì p = $_GET['p']-1
 - từ biến p có thể tính ra được lấy từ bản ghi nào
 	- quy định số bản ghi trên  1 trang : $recordPerPage = 3;
 	- tổng số bản ghi $total = 7;
 	- số trang hiển thị ceil($total/$recordPerPage)=ceil(7/3) = 3
 - trang 1 : index.php?controller=users&p=1
  	- p = 1 -1 =0
  	- lấy từ bản ghi $from = $p * $recordPerPage = 0 *3 = 0
  	- select * from users order by id desc limit 0 , 3


- trang 2 : index.php?controller=users&p=2
  	- p = 2 -1 =1
  	- lấy từ bản ghi $from = $p * $recordPerPage = 1 *3 = 3
  	- select * from users order by id desc limit 3 , 3


  - trang 3 : index.php?controller=users&p=3
  	- p = 3 -1 =2
  	- lấy từ bản ghi $from = $p * $recordPerPage = 2 *3 = 6
  	- select * from users order by id desc limit 6 , 3




*/

 ?>
 <?php 
 /*
- có 2 kiểu truy vấn
		- truy vấn có truyền tham số
			$query=$data->prepare("...");
			$query->execute([các tham số truyền vào sql]);
			->sử dụng khi  có biến truyền từ url hoặc form
		- truy vấn k truyền tham số
			$query=$data->query("..."); -> sử dụng khi k có biến truyền từ url hoặc form

 */

  ?>
<?php 

trait UsersModel {
	//lấy về danh sách các bản ghi
	 public function modelRead($recordPerPage){
	 	//lấy biến từ url 
	 	$p = isset($_GET['p']) && $_GET['p'] > 0 ? $_GET['p']-1 : 0;
	 	//lấy từ bản ghi nào
	 	$from = $p * $recordPerPage;
	 	// lấy biến kêt nối csdl
	 	$data = Connection::getInstance();
	 	// thực hiện truy vấn
	 	$query=$data->query("select * from users order by id desc limit $from ,$recordPerPage");

	
	 	// Trả về nhiều bản ghi
	 	$result = $query->fetchALL(PDO::FETCH_OBJ);
	 	return $result;

	 }
	 // tính tổng số bản ghi
	 public function modelTotalRecord(){
	
	 	// lấy biến kêt nối csdl
	 	$data = Connection::getInstance();
	 	// thực hiện truy vấn
	 	$query=$data->query("select * from users");
	 	
	 	//trả về số bản ghi
	 	$data = $query->rowCount();
	 	return $data;
	 }

	 // lấy một bản ghi tương ứng với id truyền vào
	 public function modelGetRecord($id){
	 		// lấy biến kêt nối csdl
	 	$data = Connection::getInstance();
	 	// thực hiện truy vấn
	 	$query = $data->prepare("select * from users where id =:_id");
	 	$query->execute(["_id"=>$id]);
	 	// trả về 1 bản ghi
	  return	$query->fetch(PDO::FETCH_OBJ);
	 }

	 public function modelUpdate($id){
	 	$name = $_POST["name"];
			$password = $_POST["password"];
			$email = $_POST["email"];
			//update name
			//lay bien ket nio csdl
			$conn = Connection::getInstance();
			$query = $conn->prepare("update users set name = :_name , email = :_email  where id=:var_id");
			//thuc thi truy van, co truyen tham so vao cau lenh sql
			$query->execute(["var_id"=>$id,"_name"=>$name,"_email"=>$email]);
		
			//neu password khong rong thi update password
			if($password != ""){
				//ma hoa password
				
				$query = $conn->prepare("update users set password = :var_password where id=:var_id");
				//thuc thi truy van, co truyen tham so vao cau lenh sql
				$query->execute(["var_id"=>$id,"var_password"=>$password]);
			}

	 }
	 public function modelCreate(){
	 		$name = $_POST["name"];
			$password = $_POST["password"];
			$email = $_POST["email"];
			//lay bien ket nio csdl
			$conn = Connection::getInstance();
			$query = $conn->prepare("insert into users set name = :_name , email = :_email, password =:_password ");
			//thuc thi truy van, co truyen tham so vao cau lenh sql
			$query->execute(["_password"=>$password,"_name"=>$name,"_email"=>$email]);
		
	 }

	 	 public function modelDelete($id){
	 		
			//lay bien ket nio csdl
			$conn = Connection::getInstance();
			$query = $conn->prepare("delete from users where id = :_id ");
			//thuc thi truy van, co truyen tham so vao cau lenh sql
			$query->execute(["_id"=>$id]);
		
	 }
}

 ?>
