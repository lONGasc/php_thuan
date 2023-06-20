<?php 
//include file model
include "models/NewsModel.php";


 ?>
 <?php 
/**
 * 
 */
class NewsController
{
	
	use NewsModel;

   	
	public function index(){
		// quy định số bản ghi trên 1 trang
		$recordPerPage = 20;
		// tính số trang 
		$numPage = ceil($this->modelTotalRecord()/$recordPerPage);
		// lấy dữ lieju từ model
		$data = $this->modelRead($recordPerPage);
		//gọi ra view
		return View::make("NewsView.php",["data"=>$data,"numPage"=>$numPage]);
	}
	
	public function detail(){
			$id = isset($_GET["id"]) ? $_GET["id"] : 0;
			$record = $this->modelGetRecord($id);
			//goi view, truyen du lieu ra view
			return View::make("NewsDetailView.php",["record"=>$record,"id"=>$id]);
		}


	
}

  ?>