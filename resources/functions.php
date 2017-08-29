<?php
function redirect($location) {
	header("Location: {$location}");
}
//

function query($sql) {
	global $connection;
	return mysqli_query($connection, $sql);
}
//

function confirm($result) {
	global $connection;
	if (!$result){
		die ("DB Error: " . mysqli_error($connection));
	}
}
//

function escapeString($string) {
	global $connection;
	return mysqli_real_escape_string($connection, $string);
}
//

function fetchArray($result) {
	global $connection;
	return mysqli_fetch_array($result);
}
//

function getProducts() {
	$query = query("SELECT * FROM products");
	confirm($query);
	while ($row = fetchArray($query)) {
	$product = <<<DELIMITER
		<div class="col-sm-4 col-lg-4 col-md-4">
		    <div class="thumbnail">
		        <a href="item.php?id={$row['product_id']}"><img src="{$row['product_image']}" alt=""></a>
		        <div class="caption">
		            <h4 class="pull-right">&#36;{$row['product_price']}</h4>
		            <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
		            </h4>
		            <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
				<a class="btn btn-primary" href="#">ADD TO CART</a>
		        </div>
		    </div>
		</div>
DELIMITER;
	echo $product;
	}
	
}
//

function getProductsfromCategories($catid) {
	$query = query("SELECT * FROM products WHERE product_category_id = " . escapeString($catid));
	confirm($query);
	while ($row = fetchArray($query)) {
	$product = <<<DELIMITER
            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="{$row['product_image']}" alt="">
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>{$row['product_short_desc']}</p>
                        <p> 
                            <a href="#" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>
DELIMITER;
	echo $product;
	}
	
}
//

function getProductsShop() {
	$query = query("SELECT * FROM products ");
	confirm($query);
	while ($row = fetchArray($query)) {
	$product = <<<DELIMITER
            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="{$row['product_image']}" alt="">
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>{$row['product_short_desc']}</p>
                        <p> 
                            <a href="#" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>
DELIMITER;
	echo $product;
	}
	
}
//

function getCategories() {
	global $connection;
	$query = "SELECT * FROM categories";
	confirm($query);
	$send_query = mysqli_query($connection, $query);
	while ($row = mysqli_fetch_array($send_query)) {
		$category_links = <<<DELIMITER
		<a href="category.php?id={$row['cat_id']}" class="list-group-item">{$row['cat_title']}</a>
DELIMITER;
		echo $category_links;
	}
}
//
?>
