<?php 
//include file model
include "models/UsersModel.php";


 ?>
 <?php 
/**
 * 
 */
class UsersController
{
	
	use UsersModel;

		public function __construct()
   	{
   		// kiểm tra user đăng nhập ch
   		if(isset($_SESSION['email']) == false){
   			header('location:index.php?controller=login');
   		}
				
   	}
   	
	public function index(){
		// quy định số bản ghi trên 1 trang
		$recordPerPage = 3;
		// tính số trang 
		$numPage = ceil($this->modelTotalRecord()/$recordPerPage);
		// lấy dữ lieju từ model
		$data = $this->modelRead($recordPerPage);
		//gọi ra view
		return view::make("UsersView.php",["data"=>$data,"numPage"=>$numPage]);
	}
	//sửa bản ghi
	/*
	<form action="" method="post" >
	action update : index.php?controller=users&action=update&id=..
	action create : index.php?controller=users&action=create
			<input type="text" name="txt" >
			<input type="submit" value ="submit" >
	</form>
	*/
	public function update(){
		// lấy id từ url
		$id = isset($_GET['id'])? $_GET['id'] : 0;
		//tạo biến action để dựa vào thuộc tính action của form
		$action = "index.php?controller=users&action=updatePost&id=$id";
		// lấy 1 bản ghi
		$record = $this->modelGetRecord($id);

		//gọi view, truyền biến ra view
		return view::make("UsersForm.php",["action"=>$action,"record"=>$record]);
	}
	//khi ấn submit bản ghi(update)
	public function updatePost(){
			// lấy id từ url
		$id = isset($_GET['id'])? $_GET['id'] : 0;
		// gọi hàm modelUpdate để update bản ghi
		$this->modelUpdate($id);
		// quay laji trang users
		header("location:index.php?controller=users");
	}

	public function create(){
		// lấy id từ url
		$id = isset($_GET['id'])? $_GET['id'] : 0;
		//tạo biến action để dựa vào thuộc tính action của form
		$action = "index.php?controller=users&action=createPost";
		// lấy 1 bản ghi
		$record = $this->modelGetRecord($id);

		//gọi view, truyền biến ra view
		return view::make("UsersForm.php",["action"=>$action,"record"=>$record]);
	}
	//khi ấn submit bản ghi(update)
	public function createPost(){
	
		// gọi hàm modelUpdate để update bản ghi
		$this->modelCreate($id);
		// quay laji trang users
		header("location:index.php?controller=users");
	}

		public function delete(){
		$id = isset($_GET['id'])? $_GET['id'] : 0;
		// gọi hàm modelUpdate để update bản ghi
		$this->modelDelete($id);
		// quay laji trang users
		header("location:index.php?controller=users");
	}
}

  ?>