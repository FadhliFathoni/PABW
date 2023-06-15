<?php
require_once "method.php";
$cart = new Cart();
$request_method = $_SERVER["REQUEST_METHOD"];
switch ($request_method) {
   case 'GET':
      if (!empty($_GET["product_code"])) {
         $product_code = intval($_GET["product_code"]);
         $cart->update_cart($product_code);
      } else {
         $cart->get_cart();
      }
      break;
   case 'POST':
      if (!empty($_POST["product_code"]) && !empty($_POST["qty"])) {
         $cart->insert_cart();
      } else {
         $product_code = intval($_POST["product_code"]);
         $cart->update_cart($product_code);
      }
      break;
   case 'DELETE':
      $product_code = intval($_GET["product_code"]);
      $cart->delete_cart($product_code);
      break;
   default:
      // Invalid Request Method
      header("HTTP/1.0 405 Method Not Allowed");
      break;
}
?>
