<?php 
require_once('entities/product.class.php');
require_once('entities/category.class.php');
?>

<?php 
include_once('header.php');
if (!isset($_GET["id"])) {
    // đường dẫn xem chi tiết sản phẩm không đúng
    // -> 404 page
    header('Location: /Lab3+4/views/error/404.html');
} else{
    $id = $_GET["id"];
    $prod = reset(Product::get_product($id));
    $prods_relate = Product::list_product_relate($prod["CateId"],$id);
}
$cates = Category::list_category();
?>


    <section class="ftco-section">
            <div class="container">
                <div class="row">
                <div class="col-lg-6 mb-5 ftco-animate">
                    <a href="<?php echo $prod['Picture'];?>" class="image-popup prod-img-bg"><img src="<?php echo $prod['Picture'];?>" class="img-fluid" alt="Colorlib Template"></a>
                </div>
                <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                    <h3><?php echo $prod["ProductName"];?></h3>
                    <p class="price"><span><?php echo number_format($prod['Price'], 0, '', ',');?> VNĐ</span></p>
                    <p><?php echo $prod["Description"];?></p>
                        <div class="row mt-4">
                            <div class="input-group col-md-6 d-flex mb-3">
                    <span class="input-group-btn mr-2">
                        <button type="button" class="quantity-left-minus btn"  data-type="minus" data-field="">
                       <i class="fa fa-minus"></i>
                        </button>
                        </span>
                    <input type="text" id="quantity" name="quantity" class="quantity form-control input-number" value="1" min="1" max="100">
                    <span class="input-group-btn ml-2">
                        <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                         <i class="fa fa-plus"></i>
                     </button>
                    </span>
                </div>
            </div>
            <p><a href="cart.html" class="btn btn-primary py-3 px-5 mr-2">Add to Cart</a><a href="cart.html" class="btn btn-primary py-3 px-5">Buy now</a></p>
                </div>

                <div class="col-md-3">
                    <div class="sidebar-box ftco-animate">
                        <div class="categories">
                        <h3>Product Types</h3>
                            <ul class="p-0">
                                <?php foreach($cates as $item) {
                                    echo "<li><a href=/Lab3+4/list_product.php?cateid=".$item["CateID"].">".$item["CategoryName"]."<span class='fa fa-chevron-right'></a></li>";
                                }?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="sidebar-box ftco-animate">
                        <div class="categories">
                        <h3>Related Product</h3>
                            <ul class="p-0">
                                                        			<?php 
				                        foreach ($prods_relate as $item) {
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
										<h2><a href="detail_product.php?id=<?php echo $item['ProductId']?>"><?php echo $item['ProductName'];?></a></h2>
										<p class="mb-0"><span class="price"><?php echo number_format($item['Price'], 0, '', ',');?> VNĐ</span></p>
									</div>
								</div>
							</div>
                            <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                </div>
            </div>         
    </section>


<?php include_once('footer.php');?>

    
</body>
<?php include_once('scripts.php');?>
</html>
