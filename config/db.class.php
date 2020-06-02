<?php 
class Db
{
	//Biến kết nối CSDL
	protected static $connection;

	//Hàm khởi tạo kết nối
	public function connect(){
		if(!isset(self::$connection)){
			$config = parse_ini_file("config.ini");
			self::$connection = new mysqli("localhost", $config["username"], $config["password"], $config["databasename"]);
		}
		// Check connection
		if(self::$connection==false){
			return false;
		}

		return self::$connection;
	}
	
	//Hàm thực hiện xử lý câu lệnh truy vấn
	public function query_execute($queryString){
		//Khởi tạo kết nối
		$connection = $this -> connect();
		//Thực hiện execute truy vấn, query là hàm của thư viện mysqli
		$result = $connection -> query($queryString);
		$connection -> close();
		return $result;
	}

	
	public function select_to_array($queryString){
		$rows = array();
		$result = $this -> query_execute($queryString);
		if($result==false) return false;
		
		while($item = $result -> fetch_assoc()){
			$rows[] = $item;
		}
		return $rows;
	}
}
?>