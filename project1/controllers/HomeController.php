<?php 
 include "models/HomeModel.php";

 ?>


<?php 

class HomeController {
	use HomeModel;

	public function index(){
		$hotProduct = $this->modelHotProduct();
		// lấy các danh mục
		$categories = $this->modelCategories();

		return View::make("HomeView.php",["hotProduct"=>$hotProduct,"categories"=>$categories]);
	}
}

 ?>