<?php 
require_once('entities/product.class.php');
require_once('entities/category.class.php');
?>

<?php 
include_once('header.php');
if (!isset($_GET["cateid"])) {
	$prods = Product::list_product();
} else{
	$cateid = $_GET["cateid"];
	$prods = Product::list_product_by_cateId($cateid);
}
$cates = Category::list_category();

?>
<div class="container text-center">
	<div class ="col-sm-3">
		<h3>Danh mục</h3>
		<ul class="list-group">
			<?php 
				foreach($cates as $item) {
					echo "<li class = 'list-group-item'><a 
					href=/Lab3+4/list_product.php?cateid=".$item["CateID"].">".$item["CategoryName"]."</a></li>";
			}?>
		</ul>
	</div>
	<div class="col-sm-10">
		<h3>Sản phẩm cửa hàng</h3>
		<div class="row">
			<?php 
				foreach ($prods as $item) {
					?>
					<div class="col-sm-4" style="margin-top:30px">
						<img src="<?php echo $item['Picture'];?>" class="img-responsive" style="width:340px; height:340px" alt="Image">
						<p class="text-danger"><?php echo $item['ProductName'];?></p>
						<p class="text-info"><?php echo $item['Price'];?></p>
						<p>
							<button type="button" class="btn btn-primary">Buy</button>
						</p>
					</div>
				<?php } ?>
		</div>
	</div>
</div>

<?php 
include_once('footer.php');
?>
