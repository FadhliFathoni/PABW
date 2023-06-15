<?php
require_once "method.php";
$spt = new Shoes();
$request_method=$_SERVER["REQUEST_METHOD"];
switch ($request_method) {
   case 'GET':
         if(!empty($_GET["id"]))
         {
            $id=intval($_GET["id"]);
            $spt->get_sptu($id);
         }
         else
         {
            $spt->get_spt();
         }
         break;
   case 'POST':
         if(!empty($_GET["id"]))
         {
            $id=intval($_GET["id"]);
            $spt->update_spt($id);
         }
         else
         {
            $spt->insert_spt();
         }     
         break; 
   case 'DELETE':
          $id=intval($_GET["id"]);
            $spt->delete_spt($id);
            break;
   default:
      // Invalid Request Method
         header("HTTP/1.0 405 Method Not Allowed");
         break;
      break;
}
 
 
 
 
?>