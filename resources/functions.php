<?php
function setMessage($msg) {
	if (!empty($msg)) {
		$_SESSION['message'] = $msg;
	} else {
		$msg = "";
	}
}
//

function displayMessage() {
	if (isset($_SESSION['message'])) {
		echo $_SESSION['message'];
		unset($_SESSION['message']);
	}
}
//

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
	$dir = __DIR__;
	$product = <<<DELIMITER
		<div class="col-sm-4 col-lg-4 col-md-4">
		    <div class="thumbnail">
		        <a href="item.php?id={$row['product_id']}"><img src="{$row['product_image']}" alt=""></a>
		        <div class="caption">
		            <h4 class="pull-right">&#36;{$row['product_price']}</h4>
		            <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
		            </h4>
		            <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
				<a class="btn btn-primary" href="cart.php?add={$row['product_id']}">ADD TO CART</a>
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

function loginUser() {
	global $connection;
	if (isset($_POST['submit'])) {
		$username = escapeString($_POST['username']);
		$posted_password = escapeString($_POST['password']);
		$query = query("SELECT * FROM users WHERE user_name = '{$username}'");
		confirm($query);
		// In case the query returns nothing
		if (mysqli_num_rows($query) == 0) {
			setMessage("Username or Password was incorrect");
			redirect("login.php");
		}
		while ($row = fetchArray($query)) {
			$user_name = $row['user_name'] ;
			$user_email = $row['user_email'];
			$user_password = $row['user_password'];
			if (!password_verify($posted_password, $user_password)) {
				setMessage("Username or Password was incorrect");
				redirect("login.php");
			} else {
				$_SESSION['username'] = $username;
				setMessage("Welcome to Admin" . $user_name);
				redirect("/admin");
			}
		}
	}
}
//

function sendContactmsg() {
	if (isset($_POST['submit'])) {
		global $connect;
		$name = $_POST['name'];
		$email = $_POST['email'];
		$subject = $_POST['subject'];
		$message =  $_POST['message'];

		$from = new SendGrid\Email($name, $email);    
		$subject = $subject;
		$to = new SendGrid\Email("New Contact", "ecom_chx@mailinator.com");    
		$content = new SendGrid\Content("text/plain", $message);    
		
		$mail = new SendGrid\Mail($from, $subject, $to, $content);    
		
		$apiKey = getenv('SENDGRID_API_KEY');    
		$sg = new \SendGrid($apiKey);    
		
		$response = $sg->client->mail()->send()->post($mail);    
		if ($response->statusCode() == 202) {    
			setMessage("Your message has been sent");
			redirect("contact.php");
		} else {    
			setMessage("Error trying to send message...please try again");
			redirect("contact.php");
		}
	}
}
//

function lastId() {
	global $connection;
	return mysqli_insert_id($connection);
}
//

function displayOrders() {
	$query = query("SELECT * FROM orders");
	confirm($query);
	while($row = fetchArray($query)) {
		echo "<tr>";
		echo "<td>{$row['order_id']}</td>";
		echo "<td>&#36;{$row['order_amount']}</td>";
		echo "<td>{$row['order_transaction']}</td>";
		echo "<td>{$row['order_currency']}</td>";
		echo "<td>{$row['order_status']}</td>";
		echo "<td><a class='btn btn-danger' href='/admin/delete_order.php?id={$row['order_id']}'><span class='glyphicon glyphicon-remove'></span></a></td>";
		echo "</tr>";
	}
}
//

function getProductsinAdmin() {
	$query = query("SELECT * FROM products");
	confirm($query);
	while($row = fetchArray($query)) {
		echo "<tr>";
		echo "<td>{$row['product_id']}</td>";
		echo "<td>{$row['product_title']}</td>";
		echo "<td><a href='/admin/index.php?edit_product&id={$row['product_id']}'><img src='{$row['product_image']}' alt='product image' width='62' height='62'></img></a></td>";
		echo "<td>CATEGORY</td>";
		echo "<td>&#36;{$row['product_price']}</td>";
		echo "<td>{$row['product_qty']}</td>";
		echo "<td><a class='btn btn-danger' href='/admin/delete_product.php?id={$row['product_id']}'><span class='glyphicon glyphicon-remove'></span></a></td>";
		echo "</tr>";
	}
}
//

function addProduct() {
	if (isset($_POST['publish'])) {
		$product_title = escapeString($_POST['product_title']);
		$product_category_id = escapeString($_POST['product_category_id']);
		$product_price = escapeString($_POST['product_price']);
		$product_qty = escapeString($_POST['product_qty']);
		$product_description = escapeString($_POST['product_description']);
		$product_short_desc = escapeString($_POST['product_short_desc']);
		$product_image = escapeString($_FILES['file']['name']);
		$image_tmp = escapeString($_FILES['file']['tmp_name']);

		move_uploaded_file($image_tmp, IMAGES_DIR . DS . $product_image);
		$image_fullpath = IMAGES_DIR . DS . $product_image;

		// $query = query("INSERT INTO products(product_title, product_category_id, product_price, product_qty, product_description, product_short_desc, product_image) VALUES('{$product_title}', '{$product_category_id}', '{$product_price}', '{$product_qty}', '{$product_description}', '{$product_short_desc}', '{$image_fullpath}') ");
		$query = query("INSERT INTO products(product_title, product_category_id, product_price, product_qty, product_description, product_short_desc, product_image) VALUES('{$product_title}', '77', '{$product_price}', '{$product_qty}', '{$product_description}', '{$product_short_desc}', '{$image_fullpath}') ");
		confirm($query);
		$last_id = lastId();
		setMessage("New Product with ID {$last_id} added");
		redirect("/admin/index.php?products");
	}
}
//
?>
