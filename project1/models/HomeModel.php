<?php 

trait HomeModel {
	//sản phẩm nổi bật
	public function modelHotProduct(){
		$data = Connection::getInstance();
		$query = $data->query("select * from products where hot = 1 order by id desc limit 0,6");
		return $query->fetchAll(PDO::FETCH_OBJ);
	}
	// liệt kê danh mục sản phẩm chỉ lấy các danh mục có sản phẩm bên trong
	public function modelCategories(){
		$data = Connection::getInstance();
		//$query = $data->query("select * from categories where id in (select category_id from products) ");// truy vấn cả bậc 1, bậc 2
		$query = $data->query("select * from categories where parent_id =0 ");
		return $query->fetchAll(PDO::FETCH_OBJ);
	}
	// liệt kê sản phẩm thuộc danh mục
	public function modelProduct($category_id){
		$data = Connection::getInstance();
		$query = $data->prepare("select * from products where category_id =:_category_id order by id desc limit 0,6");
		$query->execute(["_category_id"=>$category_id]);
		return $query->fetchAll(PDO::FETCH_OBJ);
	}

}

 ?>