<?php 
	trait ProductsModel{
		//lay ve danh sach cac ban ghi
		public function modelRead($recordPerPage){
			$category_id = isset($_GET["id"]) ? $_GET["id"] : 0;
			//lay bien truyen tu url
			$page = isset($_GET["p"]) && $_GET["p"] > 0 ? $_GET["p"]-1 : 0;
			//lay tu ban ghi nao
			$from = $page * $recordPerPage;
			//---
			$sqlOrder = "";
			$order = isset($_GET["order"]) ? $_GET["order"] : "";
			switch ($order) {
				case 'priceAsc':
					$sqlOrder = "order by price asc";
					break;
				case 'priceDesc':
					$sqlOrder = "order by price desc";
					break;
				case 'nameAsc':
					$sqlOrder = "order by name asc";
					break;
				case 'nameDesc':
					$sqlOrder = "order by name desc";
					break;
				default:
					$sqlOrder = "order by id desc";
					break;
			}
			//---
			//lay bien ket nio csdl
			$conn = Connection::getInstance();
			//thuc hien truy van
			$query = $conn->query("select * from products where category_id in (select id from categories where id = $category_id or parent_id = $category_id) $sqlOrder limit $from,$recordPerPage");
			//tra ve nhieu ban ghi
			//neu $query->fetchAll() thi ket qua tra ve la mot array
			//neu $query->fetchAll(PDO::FETCH_OBJ) thi ket qua tra ve la mot object
			return $query->fetchAll(PDO::FETCH_OBJ);
		}
		//tinh tong so ban ghi
		public function modelTotalRecord($category_id){
			//lay bien ket nio csdl
			$conn = Connection::getInstance();
			//thuc hien truy van
			$query = $conn->query("select * from products where category_id in (select id from categories where id = $category_id or parent_id = $category_id)");
			//tra ve so luong ban ghi
			return $query->rowCount();
		}
		//lay mot ban ghi tuong ung voi id truyen vao
		public function modelGetRecord($id){
			//lay bien ket nio csdl
			$conn = Connection::getInstance();
			//thuc hien truy van -> do co bien truyen tu url vao nen thuc hien prepare de truyen tham so
			$query = $conn->prepare("select * from products where id=:var_id");
			//thuc thi truy van, co truyen tham so vao cau lenh sql
			$query->execute(["var_id"=>$id]);
			//tra ve mot ban ghi
			return $query->fetch(PDO::FETCH_OBJ);
		}
		//danh so sao luu vao csdl
		public function modelRating()
		{
			$id = isset($_GET["id"]) ? $_GET["id"] : 0;
			$star = isset($_GET["star"]) ? $_GET["star"] : 0;
			if($star > 0 && $id > 0){
				//lay bien ket noi csdl
				$conn = Connection::getInstance();
				$query = $conn->query("insert into rating set product_id=$id,star=$star");
				return $query->fetch(PDO::FETCH_OBJ);
			}
		}
				
	}
 ?>