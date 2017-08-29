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
				setMessage("Welcome to Admin" . $user_name);
				redirect("/admin");
			}
		}
	}
}
//

function sendContactmsg() {
		if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['subject']) && !empty($_POST['message'])) {
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
?>
