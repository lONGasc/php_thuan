<?php 
//include file model
include "models/SearchModel.php";


 ?>
 <?php 
/**
 * 
 */
class SearchController
{
	
	use SearchModel;


   	
	public function name(){
			 	$key = isset($_GET['key']) ? $_GET['key'] : "";
		// quy định số bản ghi trên 1 trang
		$recordPerPage = 20;
		// tính số trang 
		$numPage = ceil($this->modelTotalRecord()/$recordPerPage);
		// lấy dữ lieju từ model
		$data = $this->modelRead($recordPerPage);
		//gọi ra view
		return view::make("SearchNameView.php",["data"=>$data,"numPage"=>$numPage,"key"=>$key]);
	}
	function ajaxSearch(){
			$data = $this->modelAjaxSearch();
			$strResult = "";
			foreach($data as $rows){
				$strResult = $strResult."<li><img src='assets/upload/products/{$rows->photo}'><a href='index.php?controller=products&action=detail&id={$rows->id}'>{$rows->name}</a></li>";
			}
			echo $strResult;
		}
			public function price(){
			 	$fromPrice = isset($_GET['fromPrice']) ? $_GET['fromPrice'] : "";
	 	$toPrice = isset($_GET['toPrice']) ? $_GET['toPrice'] : "";
		// quy định số bản ghi trên 1 trang
		$recordPerPage = 20;
		// tính số trang 
		$numPage = ceil($this->modelTotalRecordSearchPrice()/$recordPerPage);
		// lấy dữ lieju từ model
		$data = $this->modelReadSearchPrice($recordPerPage);
		//gọi ra view
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		return view::make("SearchPriceView.php",["data"=>$data,"numPage"=>$numPage,"fromPrice"=>$fromPrice,"toPrice"=>$toPrice]);
	}
	
}

  ?>