<?php 
	require_once("entities/product.class.php");
	require_once('entities/category.class.php');
	if(isset($_POST["btnsubmit"])){
	$productName = $_POST["txtName"];
	$cateID = $_POST["txtCateID"];
	$price = $_POST["txtprice"];
	$quantity = $_POST["txtquantity"];
	$description = $_POST["txtdesc"];
	$picture = $_FILES["txtpic"];
	$newProduct = new  Product($productName, $cateID, $price, $quantity, $description, $picture);
	$loi = array();
	$loi_str = "";
	$result = $newProduct -> save($loi);
	if(!$result){
		foreach ($loi as $item) $loi_str = $loi_str.$item."<br/>"; 
	}else{
		header("Location: add_product.php?inserted");
	}
}
?>
<?php include_once("header.php"); ?>
<?php 
	if(isset($_GET["status"])){
		if($_GET["status"] == 'inserted'){
			echo "<h2>Thêm sản phẩm thành công.</h2>";
		}else{
			echo "<h2>Thêm sản phẩm thất bại.</h2>";
		}
	}
?>
<?php if ($loi_str = ""){?>
	<div class="alert alert-danger"><?php echo $loi_str ?></div>
<?php } ?>
<div class="container form-text">
	<div class="row">
		<div class="col-sm-12">
			<h1>Thêm Sản Phẩm</h1>
		</div>
		<div class="col-sm-12">
			<form method="post" enctype="multipart/form-data">
		<!-- Tên sản phẩm -->
				<div class="form-group">
						<label for="txtName">Tên sản phẩm</label>		
						<input class="form-control" type="text" name="txtName" value="<?php echo isset($_POST["txtName"]) ? $_POST["txtName"] : "" ?>">
				</div>
				<!-- Mô tả sản phẩm -->
				<div class="form-group">
					<label for="txtdesc">Mô tả sản phẩm</label>
					<textarea class="form-control" type="text" id="txtdesc" name="txtdesc" rows="3" value="<?php echo isset($_POST["txtdesc"]) ? $_POST["txtdesc"] : "" ?>"></textarea>
				</div>
				<!-- Số lượng sản phẩm -->
				<div class="form-group">
					<label for="txtquantity">Số lượng sản phẩm</label>
					<input class="form-control" type="number" id="txtquantity" name="txtquantity" value="<?php echo isset($_POST["txtquantity"]) ? $_POST["txtquantity"] : "" ?>">
				</div>
				<!-- Giá sản phẩm -->
				<div class="form-group">
					<label for="txtprice">Giá sản phẩm</label>
					<input class="form-control" type="number" id="txtprice" name="txtprice" value="<?php echo isset($_POST["txtprice"]) ? $_POST["txtprice"] : "" ?>">
				</div>
				<!-- Loại sản phẩm -->
				<div class="form-group">
					<label>Loại sản phẩm</label>
					<select class="form-control" name="txtCateID">
						<option value="" selected>-- Chọn loại --</option>
						<?php $cates = Category::list_category() ?>
						<?php 	foreach ($cates as $item) { ?>
						<option value="<?php echo $item['CateID'] ?>"><?php echo $item['CategoryName'] ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
						<label for="txtpic">Url Hình ảnh</label>
					<div class="custom-file">
						<input type="file" id="txtpic" name="txtpic" accept=".png,.gif,.jpg,.jpeg">
						<!-- <label class="custom-file-label" for="txtpic">Chọn hình</label> -->
					</div>
				</div>
				<button type="submit" class="btn btn-primary" name="btnsubmit">Thêm sản phẩm</button>
	</form>
		</div>
	</div>
</div>


<!-- Footer -->
<?php require 'footer.php'; ?>	