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


    <section class="ftco-section">
			<div class="container">
				<div class="row">
					<div class="col-md-9">
						<div class="row mb-4">
							<div class="col-md-12 d-flex justify-content-between align-items-center">
								<h4 class="product-select">Select Types of Products</h4>
								<select class="selectpicker" multiple>
				          <option>Brandy</option>
				          <option>Gin</option>
				          <option>Rum</option>
				          <option>Tequila</option>
				          <option>Vodka</option>
				          <option>Whiskey</option>
				        </select>
							</div>
						</div>
						<div class="row">
                        			<?php 
				                        foreach ($prods as $item) {
					                        ?>
							<div class="col-md-4 d-flex">
								<div class="product ftco-animate">
									<div class="img d-flex align-items-center justify-content-center" style="background-image: url(<?php echo $item['Picture'];?>);">
										<div class="desc">
											<p class="meta-prod d-flex">
												<a href="#" class="d-flex align-items-center justify-content-center"><span class="flaticon-shopping-bag"></span></a>
											</p>
										</div>
									</div>
									<div class="text text-center">
										<h2><?php echo $item['ProductName'];?></h2>
										<p class="mb-0"><span class="price"><?php echo $item['Price'];?></span></p>
									</div>
								</div>
							</div>
                            <?php } ?>
						</div>
						
						<div class="row mt-5">
							<div class="col text-center">
								<div class="block-27">
								<ul>
									<li><a href="#">&lt;</a></li>
									<li class="active"><span>1</span></li>
									<li><a href="#">2</a></li>
									<li><a href="#">3</a></li>
									<li><a href="#">4</a></li>
									<li><a href="#">5</a></li>
									<li><a href="#">&gt;</a></li>
								</ul>
								</div>
							</div>
						</div>
						
					</div>

					<div class="col-md-3">
						<div class="sidebar-box ftco-animate">
              <div class="categories">
                <h3>Product Types</h3>
                <ul class="p-0">
					<?php 
						foreach($cates as $item) {
						echo "<li><a href=/Lab3+4/list_product.php?cateid=".$item["CateID"].">".$item["CategoryName"]."<span class='fa fa-chevron-right'></a></li>";
					}?>
                </ul>
              </div>
            </div>
            
		</section>


	<?php include_once('footer.php');?>

    
</body>
<?php include_once('scripts.php');?>
</html>