



<?php 

trait NewsModel {
	//lấy về danh sách các bản ghi
	 public function modelRead($recordPerPage){
	 	//lấy biến từ url 
	 	$p = isset($_GET['p']) && $_GET['p'] > 0 ? $_GET['p']-1 : 0;
	 	//lấy từ bản ghi nào
	 	$from = $p * $recordPerPage;
	 	// lấy biến kêt nối csdl
	 	$data = Connection::getInstance();
	 	// thực hiện truy vấn
	 	$query=$data->query("select * from news order by id desc limit $from ,$recordPerPage");

	
	 	// Trả về nhiều bản ghi
	 	$result = $query->fetchALL(PDO::FETCH_OBJ);
	 	return $result;

	 }

	 // tính tổng số bản ghi
	 public function modelTotalRecord(){
	
	 	// lấy biến kêt nối csdl
	 	$data = Connection::getInstance();
	 	// thực hiện truy vấn
	 	$query=$data->query("select * from news");
	 	
	 	//trả về số bản ghi
	 	$data = $query->rowCount();
	 	return $data;
	 }

	 // lấy một bản ghi tương ứng với id truyền vào
	 public function modelGetRecord($id){
	 		// lấy biến kêt nối csdl
	 	$data = Connection::getInstance();
	 	// thực hiện truy vấn
	 	$query = $data->prepare("select * from news where id =:_id");
	 	$query->execute(["_id"=>$id]);
	 	// trả về 1 bản ghi
	  return	$query->fetch(PDO::FETCH_OBJ);
	 

	
		
	 }
}

 ?>
