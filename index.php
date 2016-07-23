<?php 

define('LIB_DIR', realpath('./'));

set_include_path(get_include_path() . PATH_SEPARATOR . LIB_DIR);

include_once 'include/cart.php';
include_once 'include/product/down_product.php';
include_once 'include/product/qant_product.php';
include_once 'include/product/rest_product.php';
include_once 'include/function_Session.php';

// $products from array
$products = array();

$book1 = new Product_qant();
$book1->setDescription("Harry Potter");
$book1->setCost(20);
$products[] = $book1;

$Program = new Product_down();
$Program->setDescription("Window 10");
$Program->setCost(15);
$products[] = $Program;

$hotel = new Product_Rest();
$hotel->setDescription("Five Stars hotel");
$hotel->setCost(15);
$products[] = $hotel;



// load the product from array by id
foreach ($products as $id => $product) {
	$product->id = $id; 
}

// initialize shopping cart
$cart = Cart::getInstance();

// inject object in cart
$cart->setFunction(new function_Session());


// when submit the form
if (isset($_POST) && ! empty($_POST)) {
	
	// adding to cart
	if (isset($_POST['add'])) {
		if (isset($_POST['product_check'])) {
			foreach ($_POST['product_check'] as $productId) {
			$selectedProduct = $products[$productId];
			$cart->add($selectedProduct);
			}			
		}
	}
	
	// changing the cart contents
	if (isset($_POST['cart'])) {
		
		if (isset($_POST['empty'])) {
			$cart->removeAll();
		} elseif (isset($_POST['remove'])) { // removing the products
			if (isset($_POST['remove_product'])) {
				foreach ($_POST['remove_product'] as $k => $v) {
					$cart->remove($v);
				}
			}
		}
	}
}

// include display the form 
include 'template/product_from.php';
