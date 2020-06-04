<?php 
require_once("config/db.class.php");

class Product{
	public $productID;
	public $productName;
	public $cateID;
	public $price;
	public $quantity;
	public $description;
	public $picture;

	public function __construct($pro_name, $cate_id, $price, $quantity, $desc, $picture){
		$this -> productName = $pro_name;
		$this -> cateID = $cate_id;
		$this -> price = $price;
		$this -> quantity = $quantity;
		$this -> description = $desc;
		$this -> picture = $picture;
	}
	//Lưu sản phẩm
	public function save(&$loi){
		// Khởi tạo đối tượng $db với class Db từ file db.class.php
		if($this->picture['name'] != null){
			$uploadOk = 1;
			$target_dir = "images/";
			$file_temp = $this->picture['tmp_name'];
			$file_name = $this->picture['name'];
			$timestamp = date("Y").date("m").date("d").date("h").date("i").date("s");
			$filepath = $target_dir.$timestamp.$file_name;
			$imageFileType = strtolower(pathinfo($filepath, PATHINFO_EXTENSION));

			if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jepg" && $imageFileType != "gif"){
				$uploadOk = 0 ;
				$loi[] = "Hình ảnh không đúng định dạng"; 
			}
			if(file_exists($filepath)){
				$loi[] = "Hình ảnh đã tồn tại";
				$uploadOk = 0 ;
			}
			if($this->picture['size'] > 500000){
				$loi[] = "Hình ảnh quá lớn"; 
				$uploadOk = 0 ;
			}
			if($uploadOk == 0 ){
				$loi[] = "Xin lỗi hình ảnh của bạn không thể tải lên.";
				return false; 
			}else{
				if(move_uploaded_file($file_temp, $filepath)==false){
					return false;
				}
			}
		}
		if($this->productName==null){
			$loi[] = "Chưa nhập tên sản phẩm.";
			return false;
		}
		$db = new Db();
		// Tạo biến $sql để insert sản phẩm, chạy biến này ở dưới
		$sql = "INSERT INTO product (ProductName, CateID, Price, Quantity, Description, Picture) VALUES
		('$this->productName', 
		'$this->cateID', 
		'$this->price', 
		'$this->quantity', 
		'$this->description', 
		'$filepath')";
		// query_execute là function từ class Db
		$result = $db -> query_execute($sql);
		// Trả về kết quả
		return $result;
	}
	// Danh sách sản phẩm
	public static function list_product(){
		$db = new Db();
		$sql = "SELECT * FROM product";
		$rs = $db -> select_to_array($sql);
		return $rs;
	}
	// Lấy danh sách sản phẩm theo loại sản phẩm
	public static function list_product_by_cateId($cate_id)
	{
		$db = new Db();
		$sql = "SELECT * FROM product WHERE CateId='$cate_id'";
		$result = $db->select_to_array($sql);
		return $result;
	}
}
?>