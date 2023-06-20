<?php 
/*
index.php?controller=products&action=category&id=4
controller = ProductsController.php
action = category ->truyen id vào category
*/
 ?>



<?php 

trait SearchModel {
	//lấy về danh sách các bản ghi
	 public function modelRead($recordPerPage){
	 	$key = isset($_GET['key']) ? $_GET['key'] : "";
	 	//lấy biến từ url 
	 	$p = isset($_GET['p']) && $_GET['p'] > 0 ? $_GET['p']-1 : 0;
	 	//lấy từ bản ghi nào
	 	$from = $p * $recordPerPage;
	 	// lấy biến kêt nối csdl
	 	$data = Connection::getInstance();
	 	// thực hiện truy vấn
	 	$query=$data->query("select * from products where name like '%$key%' order by id desc limit $from ,$recordPerPage");

	
	 	// Trả về nhiều bản ghi
	 	$result = $query->fetchALL(PDO::FETCH_OBJ);
	 	return $result;

	 }
	 // tính tổng số bản ghi
	 public function modelTotalRecord(){
		 	$key = isset($_GET['key']) ? $_GET['key'] : "";

	 	// lấy biến kêt nối csdl
	 	$data = Connection::getInstance();
	 	// thực hiện truy vấn
	 	$query=$data->query("select * from products  where name like '%$key%'");
	 	
	 	//trả về số bản ghi
	 	$data = $query->rowCount();
	 	return $data;
	 }
	 public function modelAjaxSearch(){
			$key = isset($_GET["key"]) ? $_GET["key"] : "";
			//lay bien ket nio csdl
			$conn = Connection::getInstance();
			//thuc hien truy van
			$query = $conn->query("select * from products where name like '%$key%'");
			//tra ve tat ca cac ban ghi
			return $query->fetchAll(PDO::FETCH_OBJ);
		}

		public function modelReadSearchPrice($recordPerPage){
	 	$fromPrice = isset($_GET['fromPrice']) ? $_GET['fromPrice'] : "";
	 	$toPrice = isset($_GET['toPrice']) ? $_GET['toPrice'] : "";
	 	//lấy biến từ url 
	 	$p = isset($_GET['p']) && $_GET['p'] > 0 ? $_GET['p']-1 : 0;
	 	//lấy từ bản ghi nào
	 	$from = $p * $recordPerPage;
	 	// lấy biến kêt nối csdl
	 	$data = Connection::getInstance();
	 	// thực hiện truy vấn
	 	$query = $data->query("select * from products where (price - (price * discount)/100) >= $fromPrice and (price - (price * discount)/100) <= $toPrice order by id asc limit $from,$recordPerPage");

	
	 	// Trả về nhiều bản ghi
	 	$result = $query->fetchALL(PDO::FETCH_OBJ);
	 	return $result;

	 }
	 // tính tổng số bản ghi
	 public function modelTotalRecordSearchPrice(){
			$fromPrice = isset($_GET['fromPrice']) ? $_GET['fromPrice'] : "";
	 	$toPrice = isset($_GET['toPrice']) ? $_GET['toPrice'] : "";
	 	// lấy biến kêt nối csdl
	 	$data = Connection::getInstance();
	 	// thực hiện truy vấn
	 	$query = $data->query("select * from products where (price - (price * discount)/100) >= $fromPrice and (price - (price * discount)/100) <= $toPrice");
	 	
	 	//trả về số bản ghi
	 	$data = $query->rowCount();
	 	return $data;
	 }

	 
}

 ?>
