<?php 

/**
 * 
 */
class View
{
		
	public static $dataLayout = null;// dữ liệu file LayoutView.php sẽ lưu trữ ở đây
	public static $dataMVC = NULL; // dữ liệu mvc lưu trữ ở đây
	public static $fileLayout = NULL; // đường dẫn file LayoutView.php
	public static $FileViewMVC = NULL; // đường dẫn file view trong mvc

	public static function make($FileViewMVC,$data = null){
		if($data != null){
			extract($data);
		}
		// kiểm tra đường dẫn tồn tại k
		if(file_exists("views/$FileViewMVC")){
			//đọc nội dung bên trong đường dẫn
			ob_start();
			include "views/$FileViewMVC";
			self::$dataMVC = ob_get_contents();
			ob_get_clean();

			// kiểm tra xem biến $fileLayout có null k , k nul thì include nó, ngược lại include $FileViewMVC
			if(self::$fileLayout != null){
				ob_start();
				include "views/".self::$fileLayout;
				self::$dataLayout = ob_get_contents();
				ob_get_clean();
				return self::$dataLayout;

			}else 
				return self::$dataMVC;


		}else die("đường dẫn views/$FileViewMVC không tồn tại");
	}
	public static function renderBody(){
			echo self::$dataMVC;
		} 
}
 ?>