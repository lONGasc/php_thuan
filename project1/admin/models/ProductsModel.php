<?php 
/*
index.php?controller=products&action=category&id=4
controller = ProductsController.php
action = category ->truyen id vào category
*/
 ?>



<?php 

trait ProductsModel {
	//lấy về danh sách các bản ghi
	 public function modelRead($recordPerPage){
	 	//lấy biến từ url 
	 	$p = isset($_GET['p']) && $_GET['p'] > 0 ? $_GET['p']-1 : 0;
	 	//lấy từ bản ghi nào
	 	$from = $p * $recordPerPage;
	 	// lấy biến kêt nối csdl
	 	$data = Connection::getInstance();
	 	// thực hiện truy vấn
	 	$query=$data->query("select * from products order by id desc limit $from ,$recordPerPage");

	
	 	// Trả về nhiều bản ghi
	 	$result = $query->fetchALL(PDO::FETCH_OBJ);
	 	return $result;

	 }
	 // tính tổng số bản ghi
	 public function modelTotalRecord(){
	
	 	// lấy biến kêt nối csdl
	 	$data = Connection::getInstance();
	 	// thực hiện truy vấn
	 	$query=$data->query("select * from products");
	 	
	 	//trả về số bản ghi
	 	$data = $query->rowCount();
	 	return $data;
	 }

	 // lấy một bản ghi tương ứng với id truyền vào
	 public function modelGetRecord($id){
	 		// lấy biến kêt nối csdl
	 	$data = Connection::getInstance();
	 	// thực hiện truy vấn
	 	$query = $data->prepare("select * from products where id =:_id");
	 	$query->execute(["_id"=>$id]);
	 	// trả về 1 bản ghi
	  return	$query->fetch(PDO::FETCH_OBJ);
	 }

	public function modelUpdate($id){
	 	$name = $_POST["name"];
	 	$hot = isset($_POST['hot']) ? 1 : 0;
	 	$price = $_POST['price'];
	 	$description=$_POST['description'];
	 	$content =$_POST['content'];
		$category_id = $_POST['category_id'];
		$discount = $_POST['discount'];
			//update name
			//lay bien ket nio csdl
			$conn = Connection::getInstance();
			$query = $conn->prepare("update products set name = :_name , category_id = :_category_id,hot =:_hot, price =:_price,discount=:_discount,content=:_content,description=:_description  where id=:var_id");
			//thuc thi truy van, co truyen tham so vao cau lenh sql
			$query->execute(["var_id"=>$id,"_name"=>$name,"_category_id"=>$category_id ,"_price"=>$price,"_hot"=>$hot,"_discount"=>$discount,"_content"=>$content,"_description"=>$description]);

			/////////photo
			$photo ="";
			if($_FILES['photo']['name'] != ""){
				//lấy ảnh cũ để xóa
				$oldPhoto = $conn->query("select photo from products where id =$id");
				if($oldPhoto->rowCount()>0){
					$record = $oldPhoto->fetch(PDO::FETCH_OBJ);
					// xoa anh
					if($record->photo != ""&& file_exists("../assets/upload/products/".$record->photo));
					unlink("../assets/upload/products/".$record->photo);

				}
				$photo = time()."_".$_FILES['photo']["name"];
				move_uploaded_file($_FILES['photo']["tmp_name"], "../assets/upload/products/".$photo);
				$query = $conn->prepare("update products set photo =:_photo where id =:var_id");
				$query->execute(["_photo"=>$photo,"var_id"=>$id]);
			}
				

	 }
	 public function modelCreate(){
	 		$name = $_POST["name"];
	 	$hot = isset($_POST['hot']) ? 1 : 0;
	 	$price = $_POST['price'];
	 	$description=$_POST['description'];
	 	$content =$_POST['content'];
		$category_id = $_POST['category_id'];
		$discount = $_POST['discount'];
		$photo ="";
				/////////photo
			
			if($_FILES['photo']['name'] != ""){
				
				$photo = time()."_".$_FILES['photo']["name"];
				move_uploaded_file($_FILES['photo']["tmp_name"], "../assets/upload/products/".$photo);
				
			}
			//lay bien ket nio csdl
			$conn = Connection::getInstance();
			$query = $conn->prepare("insert into products set name = :_name , category_id = :_category_id,hot =:_hot, price =:_price,discount=:_discount,content=:_content,description=:_description  ,photo=:_photo");
			//thuc thi truy van, co truyen tham so vao cau lenh sql
			$query->execute(["_name"=>$name,"_category_id"=>$category_id ,"_price"=>$price,"_hot"=>$hot,"_discount"=>$discount,"_content"=>$content,"_description"=>$description,"_photo"=>$photo]);

		
		
	 }

	 	 public function modelDelete($id){
	 	 
			//lay bien ket nio csdl
			$conn = Connection::getInstance();
$oldPhoto = $conn->query("select photo from products where id =$id");
				if($oldPhoto->rowCount()>0){
					$record = $oldPhoto->fetch(PDO::FETCH_OBJ);
					// xoa anh
					if($record->photo != ""&& file_exists("../assets/upload/products/".$record->photo));
					unlink("../assets/upload/products/".$record->photo);

				}
			

			$query = $conn->prepare("delete from products where id = :_id or category_id =:_id ");
			//thuc thi truy van, co truyen tham so vao cau lenh sql
			$query->execute(["_id"=>$id]);
		
	 }
}

 ?>
