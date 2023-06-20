<?php 
session_start();
include "../application/Connection.php";
include "../application/View.php";


 ?>
 <?php 
 $controller = isset($_GET['controller']) ? $_GET['controller'] : "Home";
 $action = isset($_GET['action']) ? $_GET['action'] : "index";
 // tạo đường dẫn vật lí file controller
 $controllerFile = "controllers/".ucfirst($controller)."Controller.php";
 //kiểm tra đường dẫn có tồ n tại hay k
 if(file_exists($controllerFile)){
 	include "$controllerFile";
 	// khởi tạo class
 	$controllerClass = ucfirst($controller)."Controller";
 	// khởi tạo obj class

 	$obj = new $controllerClass();
 	// gọi đến hàm action

 	$data = $obj->$action();
 	//xuất dữ liệu lên trình duyệt
 	echo $data;
 }else die("file $controllerFile k tồn tại");

  ?>