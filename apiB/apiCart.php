<?php
require_once "method.php";
$cart = new Cart();
$request_method = $_SERVER["REQUEST_METHOD"];
switch ($request_method) {
   case 'GET':
      if (!empty($_GET["id"])) {
         $id = intval($_GET["id"]);
         $cart->get_cart_by_id($id);
      } else {
         $cart->get_cart();
      }
      break;
   case 'POST':
      if (!empty($_GET["id"])) {
         $id = intval($_GET["id"]);
         $cart->update_cart($id);
      } else {
         $cart->insert_cart();
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
