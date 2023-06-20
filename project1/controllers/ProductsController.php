<?php 
	//include file model vao day
	include "models/ProductsModel.php";
	class ProductsController{
		//ke thua class ProductsModel
		use ProductsModel;
		public function category(){
			$category_id = isset($_GET["id"]) ? $_GET["id"] : 0;
			//quy dinh so ban ghi tren mot trang
			$recordPerPage = 20;
			//tinh so trang
			$numPage = ceil($this->modelTotalRecord($category_id)/$recordPerPage);
			//lay du lieu tu model
			$data = $this->modelRead($recordPerPage);
			//goi view, truyen du lieu ra view
			return View::make("ProductsView.php",["data"=>$data,"numPage"=>$numPage,"category_id"=>$category_id]);
		}
		//chi tiet san pham
		public function detail(){
			$id = isset($_GET["id"]) ? $_GET["id"] : 0;
			$record = $this->modelGetRecord($id);
			//goi view, truyen du lieu ra view
			return View::make("ProductsDetail.php",["record"=>$record,"id"=>$id]);
		}
		//danh gia so sao (rating)
		public function rating(){
			$id = isset($_GET["id"]) ? $_GET["id"] : 0;
			$this->modelRating();
			//do chuyen den trang chi tiet san pham
			header("location:index.php?controller=products&action=detail&id=$id");
		}
		
	}
 ?>