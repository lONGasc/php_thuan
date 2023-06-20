



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

	public function modelUpdate($id){
	 	$name = $_POST["name"];
	 	$hot = isset($_POST['hot']) ? 1 : 0;
	 
	 	$description=$_POST['description'];
	 	$content =$_POST['content'];
	
			//update name
			//lay bien ket nio csdl
			$conn = Connection::getInstance();
			$query = $conn->prepare("update news set name = :_name , hot =:_hot, content=:_content,description=:_description  where id=:var_id");
			//thuc thi truy van, co truyen tham so vao cau lenh sql
			$query->execute(["var_id"=>$id,"_name"=>$name,"_hot"=>$hot,"_content"=>$content,"_description"=>$description]);

			/////////photo
			$photo ="";
			if($_FILES['photo']['name'] != ""){
				//lấy ảnh cũ để xóa
				$oldPhoto = $conn->query("select photo from news where id =$id");
				if($oldPhoto->rowCount()>0){
					$record = $oldPhoto->fetch(PDO::FETCH_OBJ);
					// xoa anh
					if($record->photo != ""&& file_exists("../assets/upload/news/".$record->photo));
					unlink("../assets/upload/news/".$record->photo);

				}
				$photo = time()."_".$_FILES['photo']["name"];
				move_uploaded_file($_FILES['photo']["tmp_name"], "../assets/upload/news/".$photo);
				$query = $conn->prepare("update news set photo =:_photo where id =:var_id");
				$query->execute(["_photo"=>$photo,"var_id"=>$id]);
			}
				

	 }
	 public function modelCreate(){
	 		$name = $_POST["name"];
	 	$hot = isset($_POST['hot']) ? 1 : 0;

	 	$description=$_POST['description'];
	 	$content =$_POST['content'];
		
		$photo ="";
				/////////photo
			
			if($_FILES['photo']['name'] != ""){
				
				$photo = time()."_".$_FILES['photo']["name"];
				move_uploaded_file($_FILES['photo']["tmp_name"], "../assets/upload/news/".$photo);
				
			}
			//lay bien ket nio csdl
			$conn = Connection::getInstance();
			$query = $conn->prepare("insert into news set name = :_name , hot =:_hot, content=:_content,description=:_description  ,photo=:_photo");
			//thuc thi truy van, co truyen tham so vao cau lenh sql
			$query->execute(["_name"=>$name,"_hot"=>$hot,"_content"=>$content,"_description"=>$description,"_photo"=>$photo]);

		
		
	 }

	 	 public function modelDelete($id){
	 	 
			//lay bien ket nio csdl
			$conn = Connection::getInstance();
$oldPhoto = $conn->query("select photo from news where id =$id");
				if($oldPhoto->rowCount()>0){
					$record = $oldPhoto->fetch(PDO::FETCH_OBJ);
					// xoa anh
					if($record->photo != ""&& file_exists("../assets/upload/news/".$record->photo));
					unlink("../assets/upload/news/".$record->photo);

				}
			

			$query = $conn->prepare("delete from news where id = :_id ");
			//thuc thi truy van, co truyen tham so vao cau lenh sql
			$query->execute(["_id"=>$id]);
		
	 }
}

 ?>
